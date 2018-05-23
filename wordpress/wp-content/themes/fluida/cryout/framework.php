<?php
/**
 * @package Cryout Framework
 * @version 0.7.5
 * @revision 20180412
 * @author Cryout Creations - www.cryoutcreations.eu
 */

define('_CRYOUT_FRAMEWORK_VERSION', '0.7.5');

// Check if minimum supported WordPress version is used
if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) {
	require get_template_directory() . '/cryout/back-compat.php';
}

// Load everything
require_once(get_template_directory() . "/cryout/prototypes.php");
require_once(get_template_directory() . "/cryout/customizer.php");
require_once(get_template_directory() . "/cryout/ajax.php");

if( is_admin() ) {
	// Admin functionality
	require_once(get_template_directory() . "/cryout/admin-functions.php");
	require_once(get_template_directory() . "/cryout/tgmpa-class.php");
}

// Set up the Theme Customizer settings and controls
// Needs to be included in both dashboard and frontend
add_action( 'customize_register', 'cryout_customizer_extras' );
add_action( 'customize_register', array('Cryout_Customizer', 'register' ) );

// FIN!
