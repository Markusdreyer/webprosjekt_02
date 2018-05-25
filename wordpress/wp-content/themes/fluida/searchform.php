<?php
/**
 * The template for displaying the searchform
 *
 * @package Fluida
 */
?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _e( 'Search for:', 'fluida' ); ?></span>
		<input type="search" class="s" placeholder="<?php echo esc_attr_e( 'Search', 'fluida' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="searchsubmit"><span class="screen-reader-text"><?php echo _e( 'Search', 'fluida' ); ?></span><i class="blicon-magnifier"></i></button>
</form>
