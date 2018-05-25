<?php
/**
 *
 * The template for displaying pages
 *
 * Used in page.php and page tempaltes
 *
 * @package Fluida
 */
?>
<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="schema-image">
			<?php cryout_featured_hook(); ?>
		</div>
		<div class="article-inner">
			<header>
				<?php $fluida_heading_tag = ( is_front_page() ) ? 'h2' : 'h1';
				 the_title( '<' . $fluida_heading_tag . ' class="entry-title" ' . cryout_schema_microdata( 'entry-title', 0 ) . '>', '</' . $fluida_heading_tag . '>' ); ?>
				<span class="entry-meta" >
					<?php edit_post_link( __( 'Edit', 'fluida' ) . '<em class="screen-reader-text">"' . get_the_title() . '"</em>', '<span class="edit-link"><i class="icon-edit"></i> ', '</span>' ); ?>
				</span>
			</header>

			<?php cryout_singular_before_inner_hook();  ?>

			<div class="entry-content" <?php cryout_schema_microdata( 'text' ); ?>>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'fluida' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->

			<?php  comments_template( '', true ); ?>
			<?php cryout_singular_after_inner_hook();  ?>
		</div><!-- .article-inner -->
	</article><!-- #post-## -->

<?php endwhile; ?>
