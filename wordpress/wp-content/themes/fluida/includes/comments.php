<?php
/**
 * Comments related functions
 *
 * @package fluida
 */

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own fluida_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
if ( ! function_exists( 'fluida_comment' ) ) :
function fluida_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback'  :
		case 'trackback' :
		?>
			<li class="post pingback">
			<p><?php _e( 'Pingback: ', 'fluida' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'fluida' ), ' ' ); ?></p>
		<?php
		break;
		case '' :
		default :
		?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>"<?php cryout_schema_microdata( 'comment' ); ?>>

				<article>
					<header class="comment-header vcard">

						<div class="comment-author" <?php cryout_schema_microdata( 'comment-author' ); ?>>
							<?php echo get_avatar( $comment, 70, '', '', array( 'extra_attr' => cryout_schema_microdata('image', 0) )  ); ?>
							<?php printf(  '%s ', sprintf( '<span class="author-name fn"' . cryout_schema_microdata( 'author-name', 0) . '>%s</span>', get_comment_author_link() ) ); ?>
						</div> <!-- .comment-author -->

						<div class="comment-meta">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' );?>" <?php cryout_schema_microdata( 'time' );?>>

								<span class="comment-date">
									<?php /* translators: 1: date, 2: time */
									printf(  '%1$s ' . __( 'at', 'fluida' ) . ' %2$s', get_comment_date(),  get_comment_time() ); ?>
								</span>
								<span class="comment-timediff">
									<?php printf( _x( '%1$s ago', '%s = human-readable time difference', 'fluida' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
								</span>

							</time>
							</a>
							<?php edit_comment_link( __( '(Edit)', 'fluida' ), ' ' ); ?>
						</div><!-- .comment-meta -->

					</header><!-- .comment-header .vcard -->

					<div class="comment-body" <?php cryout_schema_microdata( 'text' ); ?>>
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<span class="comment-await"><em><?php _e( 'Your comment is awaiting moderation.', 'fluida' ); ?></em></span>
						<?php endif; ?>
						<?php comment_text(); ?>
					</div>

					<footer>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array(
									'reply_text' 	=> __( 'Reply', 'fluida' ),
									'depth'			=> $depth,
									'max_depth'		=> $args['max_depth'] ) ) );
							?>
						</div><!-- .reply -->
					</footer>
				</article>
		<?php
		break;
	endswitch;

	// </li><!-- #comment-##  -->  closed by wp_comments_list()
} // fluida_comment()
endif;

/** Number of comments on loop post if comments are enabled. */
if ( ! function_exists( 'fluida_comments_on' ) ) :
function fluida_comments_on() {
	$fluida_meta_comment = cryout_get_option( 'fluida_meta_comment' );
    // Only show comments if they're open, or are closed but with comments already posted, if the theme's meta comments are enabled and if it's not a single post
    if ( ( comments_open() || get_comments_number() ) && ! post_password_required() && $fluida_meta_comment && ! is_single() ) :
			echo '<span class="comments-link"><i class="icon-comments icon-metas"></i>';
			comments_popup_link(
				'<strong title="' . __( 'Leave a comment', 'fluida' ) . '">0</strong>',
				'<strong title="' .
                    sprintf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'fluida' ), number_format_i18n( get_comments_number() ) ) .
                 '">1</strong>',
				'<strong title="' .
                    sprintf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'fluida' ), number_format_i18n( get_comments_number() ) ) .
                '">%</strong>',
				'',
				''
			);
			echo '</span>';
		endif;
} // fluida_comments_on()
endif;

/** Adds microdata tags to comment link */
if ( ! function_exists( 'fluida_comments_microdata' ) ) :
function fluida_comments_microdata() {

	cryout_schema_microdata('comment-meta');

} // fluida_comments_microdata()
endif;
add_filter( 'comments_popup_link_attributes', 'fluida_comments_microdata' );


/* Edit comments form inputs: removed labels and replaced them with placeholders */
function fluida_comments_form( $arg ) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$arg =  array(

		'author' =>	'<p class="comment-form-author"><label for="author">' . __( 'Name', 'fluida' ) .  ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
					'<input id="author" placeholder="'. __( 'Name', 'fluida' ) .'*" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req . ' /></p>',

		'email' =>	'<p class="comment-form-email"><label for="email">' . __( 'Email', 'fluida' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
					'<input id="email" placeholder="'. __( 'Email', 'fluida' ) . '*" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' /></p>',

		'url' =>	'<p class="comment-form-url"><label for="url">' . __( 'Website', 'fluida' ) . '</label>' .
					'<input id="url" placeholder="'. __( 'Website', 'fluida' ) .'" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" /></p>',

	);

	return $arg;
} // fluida_comments_form()

/* Edit comments form textarea: removed label and replaced it with a placeholder */
function fluida_comments_form_textarea( $arg ) {
	$arg = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'fluida' ) .
			'</label><textarea placeholder="'. _x( 'Comment', 'noun', 'fluida' ) .'" id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
			'</textarea></p>';

	return $arg;
} // fluida_comments_form_textarea()

/* Hooks are located in cryout_master_hook() in core.php */

/* FIN */
