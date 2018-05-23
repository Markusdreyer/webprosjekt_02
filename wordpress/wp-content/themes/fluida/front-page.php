<?php
/**
 * The template for displaying the landing page/blog posts
 * The functions used here can be found in includes/landing-page.php
 *
 * @package Fluida
 */
 
$fluida_landingpage = cryout_get_option( 'fluida_landingpage' );
 
if ( is_page() && ! $fluida_landingpage ) {
	load_template( get_page_template() );
	return true;
}

if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} else {

	get_header();
	?>

	<div id="container" class="fluida-landing-page one-column">
		<main id="main" role="main" class="main">
		<?php
		//cryout_before_content_hook();

		if ( $fluida_landingpage ) {
			get_template_part( apply_filters('fluida_landingpage_main_template', 'content/landing-page' ) );
		} else {
			fluida_lpindex();
		}

		//cryout_after_content_hook();
		?>
		</main><!-- #main -->
		<?php if ( ! $fluida_landingpage ) { fluida_get_sidebar(); } ?>
	</div><!-- #container -->

	<?php get_footer();
	
} //else !posts