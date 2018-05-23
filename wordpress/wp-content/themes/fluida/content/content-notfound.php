<?php
/**
 * The default template for the not found section
 *
 * @package Fluida
 */
?> 
<header class="content-search pad-container no-results" <?php cryout_schema_microdata( 'element' ); ?>>

	<h1 class="entry-title" <?php cryout_schema_microdata( 'entry-title' ); ?>><?php _e( 'Nothing Found', 'fluida' ); ?></h1>
	<p <?php cryout_schema_microdata( 'text' ); ?>><?php printf( __( 'No search results for: <em>%s</em>', 'fluida' ), '<span>' . get_search_query() . '</span>' ); ?></p>
	
	<?php get_search_form(); ?>
	
</header><!-- not-found -->