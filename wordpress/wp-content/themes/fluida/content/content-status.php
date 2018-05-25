<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Fluida
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); cryout_schema_microdata( 'blogpost' );?>>
	<?php cryout_featured_hook(); ?>

	<div class="article-inner">
		<header class="entry-header">
			<?php cryout_post_title_hook(); ?>

			<?php the_title( sprintf( '<h2 class="entry-title"' . cryout_schema_microdata( 'entry-title', 0 )  . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php cryout_meta_format_hook(); ?>

			<div class="entry-meta">
				<?php cryout_post_meta_hook(); ?>
			</div><!-- .entry-meta -->

		</header><!-- .entry-header -->

		<?php cryout_before_inner_hook();  ?>
		<div class="entry-content"  <?php cryout_schema_microdata( 'entry-content' ); ?>>

			<div class="avatar-container">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'fluida_status_avatar', '65' ) ); ?>
			</div>

			<div>
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'fluida' ) ); ?>
			</div>

		</div><!-- .entry-content -->


		<?php cryout_after_inner_hook();  ?>
	</div><!-- .article-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
