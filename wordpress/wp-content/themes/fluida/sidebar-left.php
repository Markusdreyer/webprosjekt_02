<?php
/**
 * The Sidebar that is normally displayed on the left side (Primary).
 *
 * @package Fluida
 */
?>

<?php if ( is_active_sidebar( 'sidebar-2' ) || current_user_can( 'edit_theme_options' ) ): ?>
<aside id="primary" class="widget-area sidey" role="complementary" <?php cryout_schema_microdata( 'sidebar' );?>>
	<?php cryout_before_primary_widgets_hook(); ?>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ): 
				dynamic_sidebar( 'sidebar-2' );
		  else:
			if ( current_user_can( 'edit_theme_options' ) ) { ?>
		  
			<section class="widget-container widget-placeholder">
				<h3 class="widget-title"><?php _e( 'Left Sidebar', 'fluida' ); ?></h3>
				<p>
					<?php
						printf( __( 'You currently have no widgets set in the left sidebar. You can add widgets via the <a href="%s" target="_blank">Dashboard</a>.', 'fluida' ), esc_url( admin_url() . "widgets.php" ) ); echo "<br/>";
						printf( __( 'To hide this sidebar, switch to a different Layout via the <a href="%s" target="_blank">Theme Customizations</a>.', 'fluida' ), esc_url( admin_url() . "customize.php" ) );
					?>
				</p>
			</section>
			
			<?php }
		  endif; ?>

	<?php cryout_after_primary_widgets_hook(); ?>
</aside>
<?php endif;