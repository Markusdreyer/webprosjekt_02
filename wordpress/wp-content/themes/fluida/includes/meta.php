<?php
/**
 * Custom Post metadata functions
 *
 * @package Fluida
 */

// Add Layout Meta Box
function fluida_add_meta_boxes( $post ) {
    global $wp_meta_boxes;

	$layout_context = apply_filters( 'fluida_layout_meta_box_context', 'side' ); // 'normal', 'side', 'advanced'
	$layout_priority = apply_filters( 'fluida_layout_meta_box_priority', 'default' ); // 'high', 'core', 'low', 'default'

    // Add page layouts
    add_meta_box(
		'fluida_layout',
		__( 'Static Page Layout', 'fluida' ),
		'fluida_layout_meta_box',
		'page',
		$layout_context,
		$layout_priority
	);
} // fluida_add_meta_boxes()

// Hook meta boxes into 'add_meta_boxes'
add_action( 'add_meta_boxes', 'fluida_add_meta_boxes' );

// Define Layout Meta Box
function fluida_layout_meta_box() {
	global $post;
    global $fluida_big;
	$option_parameters = $fluida_big['options'][0];
	$custom = ( get_post_custom( $post->ID ) ? get_post_custom( $post->ID ) : false );
	$layout = ( isset( $custom['_fluida_layout'][0] ) ? $custom['_fluida_layout'][0] : '0' );
    ?>
	<p>
    	<label id="fluida_layout_default">
            <input type="radio" name="_fluida_layout" <?php checked( '0' == $layout ); ?> value="0" />
            <span><em><?php _e( 'Default Theme Layout', 'fluida' ); ?></em></span>
        </label>
    	<?php foreach ($option_parameters['choices'] as $value => $data ) {
             $data['url'] = esc_url( sprintf( $data['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>

    		<label>
                <input type="radio" name="_fluida_layout" <?php checked( $value == $layout ); ?> value="<?php echo $value; ?>" />
                <span><img src="<?php echo  $data['url'] ?>" alt="<?php echo esc_html(  $data['label'] ) ?>" title="<?php echo esc_html(  $data['label'] ) ?>"/></span>
            </label>

    	<?php } ?>
	</p>
	<?php
} //fluida_layout_meta_box()

function fluida_meta_style( $hook ) {
    if ( 'post.php' != $hook && 'post-new.php' != $hook && 'page.php' != $hook ) {
        return;
    }
    wp_enqueue_style( 'fluida_meta_style', get_template_directory_uri() . '/admin/css/meta.css', NULL, _CRYOUT_THEME_VERSION );
}

add_action( 'admin_enqueue_scripts', 'fluida_meta_style' );

/**
 * Validate, sanitize, and save post metadata.
 *
 */
function fluida_save_custom_post_metadata() {
	// Don't break on quick edit
	global $post;
	if ( ! isset( $post ) || ! is_object( $post ) ) {
		return;
	}

    global $fluida_big;
    $valid_layouts = $fluida_big['options'][0]['choices'];
	$layout = ( isset( $_POST['_fluida_layout'] ) && array_key_exists( $_POST['_fluida_layout'], $valid_layouts ) ? $_POST['_fluida_layout'] : '0' );

	// Layout - Update
	update_post_meta( $post->ID, '_fluida_layout', $layout );
} //fluida_save_custom_post_metadata()

// Hook the save post custom meta data into
add_action( 'publish_page', 'fluida_save_custom_post_metadata' );
add_action( 'draft_page',   'fluida_save_custom_post_metadata' );
add_action( 'future_page',  'fluida_save_custom_post_metadata' );
