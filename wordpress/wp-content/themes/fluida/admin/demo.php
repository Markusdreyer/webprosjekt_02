<?php
/**
 * Adds random images to the demo preview
 *
 * @package Fluida
 */

// pseudo randomness array
$fluida_demo_randomness = array( 6, 8, 1, 5, 2, 9, 7, 3, 4, 10 );
// current element index
$fluida_demo_index = 0;

// Return URL of a random demo image
function fluida_demo_image_src(){
	global $fluida_demo_randomness;
	global $fluida_demo_index;

	if ( $fluida_demo_index >= count( $fluida_demo_randomness ) ) $fluida_demo_index=0; // reset when randomness array used up

	$filename = "{$fluida_demo_randomness[$fluida_demo_index]}.jpg";

	$fluida_demo_index++;

	return get_template_directory_uri() . '/resources/images/demo/' . $filename;
} // fluida_demo_image_src()

// Filter thumbnail image and return sample image if no thumbnail exists
function fluida_demo_thumbnail( $input ) {
	if ( empty( $input ) ) {
		return fluida_demo_image_src();
	}
	return $input;
} // fluida_demo_thumbnail()

// Check if running on the demo
function fluida_is_demo() {
	$current_theme = wp_get_theme();
	$theme_slug = $current_theme->Template;
	$active_theme = fluida_get_wp_option( 'template' );
	return apply_filters( 'fluida_is_demo', ( $active_theme != strtolower( $theme_slug ) && ! is_child_theme() ) );
} // fluida_is_demo()

// Read WordPress options
function fluida_get_wp_option( $opt_name ) {
	$alloptions = wp_cache_get( 'alloptions', 'options' );
	$alloptions = maybe_unserialize( $alloptions );
	return isset( $alloptions[ $opt_name ] ) ? maybe_unserialize( $alloptions[ $opt_name ] ) : false;
} // fluida_get_wp_option()

// Apply the filter
if ( fluida_is_demo() ) { add_filter( 'fluida_preview_img_src', 'fluida_demo_thumbnail' ); }


// FIN
