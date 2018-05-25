<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to fluida_comment() which is
 * located in the includes/theme-comments.php file.
 *
 * @package Fluida
 */

if ( post_password_required() ) {
	return;
}
?>
<section id="comments">
	<?php if ( have_comments() ) : ?>

		<h3 id="comments-title">
			<span><?php  printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'fluida' ),
					number_format_i18n( get_comments_number() )); ?>
			</span>
		</h3>

		<ol class="commentlist">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 70,
				'callback' => 'fluida_comment',
			) );
			?>
		</ol><!-- .commentlist -->

		<?php if ( function_exists( 'the_comments_navigation' ) ) the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'fluida' ); ?></p>
	<?php endif; ?>

	<?php if ( comments_open() ) comment_form();  ?>
</section><!-- #comments -->
