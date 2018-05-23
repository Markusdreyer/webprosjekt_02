<?php
/*
 * Theme setup functions. Theme initialization, add_theme_support(), widgets, navigation
 *
 * @package Fluida
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
add_action( 'template_redirect', 'fluida_content_width' );

/** Tell WordPress to run fluida_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'fluida_setup' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function fluida_setup() {
	
	add_filter( 'fluida_theme_options_array', 'fluida_lpbox_width' );

	$options = cryout_get_option();

	// This theme styles the visual editor with editor-style.css to match the theme style.
	if ($options['fluida_editorstyles']) add_editor_style( 'resources/styles/editor-style.css' );

	// Support title tag since WP 4.1
	add_theme_support( 'title-tag' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Add HTML5 support
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Add post formats
	add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'audio', 'video' ) );

	// Make theme available for translation
	load_theme_textdomain( 'fluida', get_template_directory() . '/languages' );
	load_textdomain( 'cryout', '' );

	// This theme allows users to set a custom backgrounssd
	add_theme_support( 'custom-background' );

	// This theme supports WordPress 4.5 logos
	add_theme_support( 'custom-logo', array( 'height' => (int) $options['fluida_headerheight'], 'width' => 240, 'flex-height' => true, 'flex-width'  => true ) );
	add_filter( 'get_custom_logo', 'fluida_filter_wp_logo_img' );

	// This theme uses wp_nav_menu() in 3 locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'fluida' ),
		'sidebar' => __( 'Left Sidebar', 'fluida' ),
		'footer'  => __( 'Footer Navigation', 'fluida' ),
		'socials' => __( 'Social Icons', 'fluida' ),
	) );

	$fheight = $options['fluida_fheight'];
	$falign = (bool)$options['fluida_falign'];
	if (false===$falign) {
		$fheight = 0;
	} else {
		$falign = explode( ' ', $options['fluida_falign'] );
		if (!is_array($falign) ) $falign = array( 'center', 'center' ); //failsafe
	}

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(
		// default Post Thumbnail dimensions
		apply_filters( 'fluida_thumbnail_image_width', fluida_featured_width() ),
		apply_filters( 'fluida_thumbnail_image_height', $options['fluida_fheight'] ),
		false
	);
	// Custom image size for use with post thumbnails
	add_image_size( 'fluida-featured',
		apply_filters( 'fluida_featured_image_width', fluida_featured_width() ),
		apply_filters( 'fluida_featured_image_height', $fheight ),
		$falign
	);
	
	// In Fluida subtract sidebars from site width for landing page featured image width
	$lp_width = (int)$options['fluida_sitewidth'];
	if ( $options['fluida_lplayout'] && in_array( $options['fluida_sitelayout'], array('2cSr', '3cSr', '3cSs' ) ) ) $lp_width -= (int)$options['fluida_primarysidebar'];
	if ( $options['fluida_lplayout'] && in_array( $options['fluida_sitelayout'], array('2cSl', '3cSl', '3cSs' ) ) ) $lp_width -= (int)$options['fluida_secondarysidebar'];

	// Additional responsive image sizes
	add_image_size( 'fluida-featured-lp',
		apply_filters( 'fluida_featured_image_lp_width', ceil($lp_width / apply_filters( 'fluida_lppostslayout_filter', $options['fluida_magazinelayout'] ) ) ),
		apply_filters( 'fluida_featured_image_lp_height', $options['fluida_fheight'] ),
		$falign
	);
	add_image_size( 'fluida-featured-half',
		apply_filters( 'fluida_featured_image_half_width', 800 ),
		apply_filters( 'fluida_featured_image_falf_height', $options['fluida_fheight'] ),
		$falign
	);
	add_image_size( 'fluida-featured-third',
		apply_filters( 'fluida_featured_image_third_width', 512 ),
		apply_filters( 'fluida_featured_image_third_height', $options['fluida_fheight'] ),
		$falign
	);

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the same size as the header.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	$fluida_headerwidth = apply_filters( 'fluida_header_image_width',	(int) $options['fluida_sitewidth'] );
	$fluida_headerheight = apply_filters( 'fluida_header_image_height',	(int) $options['fluida_headerheight'] );
	add_image_size( 'fluida-header', $fluida_headerwidth, $fluida_headerheight,	true );

	// Boxes image sizes
	add_image_size( 'fluida-lpbox-1', $options['fluida_lpboxwidth1'], $options['fluida_lpboxheight1'], true );
	add_image_size( 'fluida-lpbox-2', $options['fluida_lpboxwidth2'], $options['fluida_lpboxheight2'], true );

	// Add support for flexible headers
	add_theme_support( 'custom-header', array(
		// for later: 'flex-height' => true,
		// for later: 'flex-width' => true,
		'height'		=> $fluida_headerheight,
		'width'			=> $fluida_headerwidth,
		'default-image'	=> get_template_directory_uri() . '/resources/images/headers/glows.jpg',
		'video'			=> true,
	));

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'glows' => array(
			'url' => '%s/resources/images/headers/glows.jpg',
			'thumbnail_url' => '%s/resources/images/headers/glows.jpg',
			'description' => __( 'Glows', 'fluida' )
		),
		'rainy' => array(
			'url' => '%s/resources/images/headers/rainy.jpg',
			'thumbnail_url' => '%s/resources/images/headers/rainy.jpg',
			'description' => __( 'Rainy', 'fluida' )
		),

		'droplets' => array(
			'url' => '%s/resources/images/headers/droplets.jpg',
			'thumbnail_url' => '%s/resources/images/headers/droplets.jpg',
			'description' => __( 'Droplets', 'fluida' )
		),

		'underwater' => array(
			'url' => '%s/resources/images/headers/underwater.jpg',
			'thumbnail_url' => '%s/resources/images/headers/underwater.jpg',
			'description' => __( 'Underwater', 'fluida' )
		),

		'waterfall' => array(
			'url' => '%s/resources/images/headers/waterfall.jpg',
			'thumbnail_url' => '%s/resources/images/headers/waterfall.jpg',
			'description' => __( 'Waterfall', 'fluida' )
		),

		'window' => array(
			'url' => '%s/resources/images/headers/window.jpg',
			'thumbnail_url' => '%s/resources/images/headers/window.jpg',
			'description' => __( 'Window', 'fluida' )
		),
	) );

	// WooCommerce compatibility
	add_theme_support( 'woocommerce' );
	// WooCommerce 3.0 gallery changes
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

} // fluida_setup()

/*
 * Have two textdomains work with translation systems.
 * https://gist.github.com/justintadlock/7ac29ae26c78d0
 */
function fluida_override_load_textdomain( $override, $domain ) {
	// Check if the domain is our framework domain.
	if ( 'cryout' === $domain ) {
		global $l10n;
		// If the theme's textdomain is loaded, assign the theme's translations
		// to the framework's textdomain.
		if ( isset( $l10n[ 'fluida' ] ) )
			$l10n[ $domain ] = $l10n[ 'fluida' ];
		// Always override.  We only want the theme to handle translations.
		$override = true;
	}
	return $override;
}
add_filter( 'override_load_textdomain', 'fluida_override_load_textdomain', 10, 2 );

/*
 * Remove inline logo styling
 */
function fluida_filter_wp_logo_img ( $input ) {
	return preg_replace( '/(height=".*?"|width=".*?")/i', '', $input );
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function fluida_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'fluida_page_menu_args' );

/** Main menu */
function fluida_main_menu() { ?>
	<div class="skip-link screen-reader-text">
		<a href="#main" title="<?php esc_attr_e( 'Skip to content', 'fluida' ); ?>"> <?php _e( 'Skip to content', 'fluida' ); ?> </a>
	</div>
	<?php
	wp_nav_menu( array(
		'container'		=> '',
		'menu_id'		=> 'prime_nav',
		'menu_class'	=> '',
		'theme_location'=> 'primary',
		'link_before'	=> '<span>',
		'link_after'	=> '</span>',
		'items_wrap'	=> '<div><ul id="%s" class="%s">%s</ul></div>'

	) );
} // fluida_main_menu()
add_action ( 'cryout_access_hook', 'fluida_main_menu' );

/** Mobile menu */
function fluida_mobile_menu() {
	wp_nav_menu( array(
		'container'		=> '',
		'menu_id'		=> 'mobile-nav',
		'menu_class'	=> '',
		'theme_location'=> 'primary',
		'link_before'	=> '<span>',
		'link_after'	=> '</span>',
		'items_wrap'	=> '<div><ul id="%s" class="%s">%s</ul></div>'
	) );
} // fluida_mobile_menu()
add_action ( 'cryout_mobilemenu_hook', 'fluida_mobile_menu' );

/** Left sidebar menu */
function fluida_sidebar_menu() {
	if ( has_nav_menu( 'sidebar' ) )
		wp_nav_menu( array(
			'container'			=> 'nav',
			'container_class'	=> 'sidebarmenu',
			'theme_location'	=> 'sidebar',
			'depth'				=> 1
		) );
} // fluida_sidebar_menu()
add_action ( 'cryout_before_primary_widgets_hook', 'fluida_sidebar_menu' , 10 );

/** Footer menu */
function fluida_footer_menu() {
	if ( has_nav_menu( 'footer' ) )
		wp_nav_menu( array(
			'container' 		=> 'nav',
			'container_class'	=> 'footermenu',
			'theme_location'	=> 'footer',
			'after'				=> '<span class="sep">|</span>',
			'depth'				=> 1
		) );
} // fluida_footer_menu()
add_action ( 'cryout_footer_hook', 'fluida_footer_menu' , 10 );

/** SOCIALS MENU */
function fluida_socials_menu( $location ) {
	if ( has_nav_menu( 'socials' ) )
		echo strip_tags(
			wp_nav_menu( array(
				'container' => 'nav',
				'container_class' => 'socials',
				'container_id' => $location,
				'theme_location' => 'socials',
				'link_before' => '<span>',
				'link_after' => '</span>',
				'depth' => 0,
				'items_wrap' => '%3$s',
				'walker' => new Cryout_Social_Menu_Walker(),
				'echo' => false,
			) ),
		'<a><div><span><nav>'
		);
} //fluida_socials_menu()
function fluida_socials_menu_header() { fluida_socials_menu( 'sheader' ); }
function fluida_socials_menu_footer() { fluida_socials_menu( 'sfooter' ); }
function fluida_socials_menu_left()   { fluida_socials_menu( 'sleft' );   }
function fluida_socials_menu_right()  { fluida_socials_menu( 'sright' );  }

/* Socials hooks moved to master hook in core.php */

/**
 * Register widgetized areas defined by theme options.
 * Uses cryout_widgets_init() from cryout/widget-areas.php
 */
function cryout_widgets_init() {
	$areas = cryout_get_theme_structure( 'widget-areas' );
	if ( ! empty( $areas ) ):
		foreach ( $areas as $aid => $area ):
			register_sidebar( array(
				'name' 			=> $area['name'],
				'id' 			=> $aid,
				'description' 	=> ( isset( $area['description'] ) ? $area['description'] : '' ),
				'before_widget' => $area['before_widget'],
				'after_widget' 	=> $area['after_widget'],
				'before_title' 	=> $area['before_title'],
				'after_title' 	=> $area['after_title'],
			) );
		endforeach;
	endif;
} // cryout_widgets_init()
add_action( 'widgets_init', 'cryout_widgets_init' );

/**
 * Creates different class names for footer widgets depending on their number.
 * This way they can fit the footer area.
 */
function fluida_footer_colophon_class() {
	$opts = cryout_get_option( array( 'fluida_footercols', 'fluida_footeralign' ) );
	$class = '';
	switch ( $opts['fluida_footercols'] ) {
		case '0': 	$class = 'all';		break;
		case '1':	$class = 'one';		break;
		case '2':	$class = 'two';		break;
		case '3':	$class = 'three';	break;
		case '4':	$class = 'four';	break;
	}
	if ( !empty($class) ) echo 'class="footer-' . $class . ' ' . ( $opts['fluida_footeralign'] ? 'footer-center' : '' ) . '"';
} // fluida_footer_colophon_class()

/**
 * Set up widget areas
 */
function fluida_widget_header() {
	if ( is_active_sidebar( 'widget-area-header' ) ) { ?>
		<aside id="header-widget-area" <?php cryout_schema_microdata( 'sidebar' );?>>
			<?php dynamic_sidebar( 'widget-area-header' ); ?>
		</aside><?php
	}
} // fluida_widget_header()

function fluida_widget_before() {
	if ( is_active_sidebar( 'content-widget-area-before' ) ) { ?>
		<aside class="content-widget content-widget-before" <?php cryout_schema_microdata( 'sidebar' );?>>
			<?php dynamic_sidebar( 'content-widget-area-before' ); ?>
		</aside><!--content-widget--><?php
	}
} //fluida_widget_before()

function fluida_widget_after() {
	if ( is_active_sidebar( 'content-widget-area-after' ) ) { ?>
		<aside class="content-widget content-widget-after" <?php cryout_schema_microdata( 'sidebar' );?>>
			<?php dynamic_sidebar( 'content-widget-area-after' ); ?>
		</aside><!--content-widget--><?php
	}
} //fluida_widget_after()
add_action ('cryout_header_widget_hook',  'fluida_widget_header');
add_action ('cryout_before_content_hook', 'fluida_widget_before');
add_action ('cryout_after_content_hook',  'fluida_widget_after');

/**
 * Create a default social menu
 */
function fluida_socials_menu_preset() {
	$menu_name = 'Socials Menu';
	$menu_exists = wp_get_nav_menu_object( $menu_name );

	if( ! $menu_exists ) {
		$menu_id = wp_create_nav_menu( $menu_name );

		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'	=> 'Facebook',
			'menu-item-url'		=> 'http://www.facebook.com/profile',
			'menu-item-target'	=> '_blank',
			'menu-item-status'	=> 'publish' ) );

		wp_update_nav_menu_item( $menu_id , 0, array(
			'menu-item-title'	=>  'Twitter',
			'menu-item-url'		=> 'http://www.twitter.com/profile',
			'menu-item-target'	=> '_blank',
			'menu-item-status'	=> 'publish' ) );

		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title' 	=>  'Google Plus',
			'menu-item-url'		=>  'http://plus.google.com/profile',
			'menu-item-target'	=> '_blank',
			'menu-item-status'	=> 'publish' ) );

		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'	=>  'Custom Social',
			'menu-item-classes' => 'custom',
			'menu-item-url'		=> '#',
			'menu-item-status'	=> 'publish' ) );
		}

	if ( ! empty( $menu_id ) )  {
		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['socials'] = $menu_id;  //$foo is term_id of menu
		set_theme_mod( 'nav_menu_locations', $locations );
	}

} //fluida_socials_menu_preset()
add_action( 'after_switch_theme', 'fluida_socials_menu_preset' );

/* FIN */
