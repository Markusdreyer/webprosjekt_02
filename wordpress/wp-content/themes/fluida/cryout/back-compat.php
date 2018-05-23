<?php
/**
 * Prevents the theme from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 *
 * @package Cryout Framework
 */

/**
 * Prevent switching to the theme on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Cryout Framework 0.5.1
 */
function cryout_compat_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'cryout_compat_upgrade_notice' );
}
add_action( 'after_switch_theme', 'cryout_compat_switch_theme' );

/**
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * the theme on WordPress versions prior to 4.1.
 *
 * @since Cryout Framework 0.5.1
 */
function cryout_compat_upgrade_notice() {
	$message = sprintf( __( '%1$s requires at least WordPress version 4.1. You are running version %2$s. Please upgrade and try again.', 'cryout' ), ucwords(_CRYOUT_THEME_NAME), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.1.
 *
* @since Cryout Framework 0.5.1
 */
function cryout_compat_customize_notice() {
	wp_die( sprintf( __( '%1$s requires at least WordPress version 4.1. You are running version %2$s. Please upgrade and try again.', 'cryout' ), ucwords(_CRYOUT_THEME_NAME), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'cryout_compat_customize_notice' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 *
* @since Cryout Framework 0.5.1
 */
function cryout_compat_preview_notice() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( '%1$s requires at least WordPress version 4.1. You are running version %2$s. Please upgrade and try again.', 'cryout' ), ucwords(_CRYOUT_THEME_NAME), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'cryout_compat_preview_notice' );
