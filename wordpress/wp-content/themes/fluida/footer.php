<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of #main and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package Fluida
 */

?>
		<?php cryout_absolute_bottom_hook(); ?>

		<aside id="colophon" role="complementary" <?php cryout_schema_microdata( 'sidebar' );?>>
			<div id="colophon-inside" <?php fluida_footer_colophon_class();?>>
				<?php get_sidebar( 'footer' );?>
			</div>
		</aside><!-- #colophon -->

	</div><!-- #main -->

	<footer id="footer" class="cryout" role="contentinfo" <?php cryout_schema_microdata( 'footer' );?>>
		<?php cryout_master_footer_hook(); ?>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
