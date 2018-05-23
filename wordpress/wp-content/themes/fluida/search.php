<?php
/**
 * The template for displaying Search results pages.
 *
 * @package Fluida
 */

get_header(); ?>

	<div id="container" class="<?php echo fluida_get_layout_class(); ?>">
		<main id="main" role="main" class="main">
			<?php cryout_before_content_hook(); ?>

			<?php if ( have_posts() ) : ?>

				<header class="content-search pad-container" <?php cryout_schema_microdata( 'element' ); ?>>
					<h1 class="page-title" <?php cryout_schema_microdata( 'entry-title' ); ?>>
						<?php printf( __( 'Search Results for: %s', 'fluida' ), '<strong>' . get_search_query() . '</strong>' ); ?>
					</h1>
					<?php get_search_form(); ?>
				</header>

				<div id="content-masonry" class="content-masonry" <?php cryout_schema_microdata( 'blog' ); ?>>
					<?php /* Start the Loop */
					while ( have_posts() ) : the_post();
						get_template_part( 'content/content', get_post_format() );
					endwhile;
					?>
				</div><!--content-masonry-->
				<?php

				fluida_pagination();

			else :

				get_template_part( 'content/content', 'notfound' ); 
				?> <div id="content-masonry"></div> <?php 
				
				cryout_empty_page_hook();

			endif; ?>

			<?php cryout_after_content_hook(); ?>
		</main><!-- #main -->

		<?php fluida_get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>
