<?php
/**
 * Template Name: Category page with intro
  *
 * A custom page template for showing posts on a chosen category.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package Fluida
 */

get_header(); ?>

<div id="container" class="<?php echo fluida_get_layout_class(); ?>">
	<main id="main" role="main" class="main">
	<?php cryout_before_content_hook(); ?>

	 <?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'pad-container' ); ?>>
			<header>
				<?php the_title( '<h1 class="entry-title" ' . cryout_schema_microdata( 'entry-title', 0 ) . '>', '</h1>' ); ?>

				<span class="entry-meta" >
					<?php edit_post_link( __( 'Edit', 'fluida' ), '<span class="edit-link"><i class="icon-edit"></i> ', '</span>' ); ?>
				</span>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'fluida' ), 'after' => '</div>' ) ); ?>
			</div>
		</article>

		<?php
		$cryout_single = true;
		$cryout_slug = basename( esc_url( get_permalink() ) );
		$cryout_meta_slug = get_post_meta( get_the_ID(), "slug", $cryout_single ); // slug custom field
		$cryout_meta_catid = get_post_meta( get_the_ID(), "catid", $cryout_single ); // category_id custom field
		$cryout_key = get_post_meta( get_the_ID(), "key", $cryout_single ); // either slug or category_id custom field
		$cryout_slug = ( $cryout_key ? $cryout_key : ( $cryout_meta_catid ? $cryout_meta_catid : ( $cryout_meta_slug ? $cryout_meta_slug : ( $cryout_slug ? $cryout_slug : 0 ) ) ) ); // select one value out of the custom fields
		?>
	<?php endwhile; ?>

		<div id="content-masonry" <?php cryout_schema_microdata( 'blog' ); ?>>
			<?php
			
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : $paged;
			if ( is_numeric( $cryout_slug ) && ( $cryout_slug > 0 ) ) {
				$cryout_needle = 'cat=' . $cryout_slug;
			} else {
				$cryout_needle = 'category_name=' . $cryout_slug;
			};
			
			$cryout_saved_query = $wp_query;
			$wp_query = NULL;
			$wp_query = new WP_Query( $cryout_needle . '&post_status=publish&orderby=date&order=desc&posts_per_page=' . get_option( 'posts_per_page' ) . '&paged=' . $paged );
			/* Start the Loop */
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
				global $more; $more=0; // more gets lost inside page templates
				get_template_part( 'content/content', get_post_format() );
			endwhile; 
			?>
			
		</div><!-- #content-masonry -->
		<?php 
		fluida_pagination();

		wp_reset_query();	

		$wp_query = NULL;
		$wp_query = $cryout_saved_query; 
		?>

	<?php cryout_after_content_hook(); ?>
	</main><!-- #main -->

	<?php fluida_get_sidebar(); ?>
</div><!-- #container -->

<?php get_footer(); ?>
