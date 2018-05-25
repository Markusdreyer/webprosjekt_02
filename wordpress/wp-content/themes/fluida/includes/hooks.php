<?php
/**
 * Theme hooks
 *
 * @package Fluida
 */

/**
 * HEADER HOOKS
*/

// Before wp_head hook
function cryout_header_hook() {
    do_action( 'cryout_header_hook' );
}
// Meta hook
function cryout_meta_hook() {
    do_action( 'cryout_meta_hook' );
}

// Post formats meta hook
function cryout_meta_format_hook() {
    do_action( 'cryout_meta_format_hook' );
}

// Before wrapper
function cryout_body_hook() {
    do_action( 'cryout_body_hook' );
}

// After <header id="header">
function cryout_mobilemenu_hook() {
    do_action( 'cryout_mobilemenu_hook' );
}

// Inside branding
function cryout_branding_hook() {
    do_action( 'cryout_branding_hook' );
}

// Inside branding
function cryout_header_socials_hook() {
    do_action( 'cryout_header_socials_hook' );
}

// Inside header image
function cryout_headerimage_hook() {
    do_action( 'cryout_headerimage_hook' );
}

// Inside header for widgets
function cryout_header_widget_hook() {
    do_action( 'cryout_header_widget_hook' );
}

// Inside access
function cryout_access_hook() {
    do_action( 'cryout_access_hook' );
}

// Inside main
function cryout_main_hook() {
    do_action( 'cryout_main_hook' );
}

// Breadcrumbs
function cryout_breadcrumbs_hook() {
    do_action( 'cryout_breadcrumbs_hook' );
}

/**
 * FOOTER HOOKS
*/

// Footer hook is handled in core master footer

// Master Footer hook
function cryout_master_footer_hook() { ?>
		<div id="footer-inside">
			<?php do_action( 'cryout_master_footer_hook' ); ?>
		</div> <!-- #footer-inside -->
<?php
}


/**
 * SIDEBAR HOOKS
*/

function cryout_before_primary_widgets_hook() {
    do_action( 'cryout_before_primary_widgets_hook' );
}

function cryout_after_primary_widgets_hook() {
    do_action( 'cryout_after_primary_widgets_hook' );
}

function cryout_before_secondary_widgets_hook() {
    do_action( 'cryout_before_secondary_widgets_hook' );
}

function cryout_after_secondary_widgets_hook() {
    do_action( 'cryout_after_secondary_widgets_hook' );
}

/**
 * LOOP HOOKS
*/

// Post featured image hook
function cryout_featured_hook() {
	do_action( 'cryout_featured_hook' );
}

// Continue reading link hook
function cryout_post_excerpt_hook() {
	do_action( 'cryout_post_excerpt_hook' );
}

// Before each article hook
function cryout_before_article_hook() {
    do_action( 'cryout_before_article_hook' );
}

// After each article hook
function cryout_after_article_hook() {
    do_action( 'cryout_after_article_hook' );
}

// After each article title
function cryout_post_title_hook() {
    do_action( 'cryout_post_title_hook' );
}

// After each post meta
function cryout_post_meta_hook() {
    do_action( 'cryout_post_meta_hook' );
}

// Before the actual post content on blog pages (content.php)
function cryout_before_inner_hook() {
    do_action( 'cryout_before_inner_hook' );
}

// After the actual post content on blog pages (content.php)
function cryout_after_inner_hook() {
    do_action( 'cryout_after_inner_hook' );
}

// Before the actual post content on pages and posts (single.php and content-page.php)
function cryout_singular_before_inner_hook() {
    do_action( 'cryout_singular_before_inner_hook' );
}

// Before comments (single.php)
function cryout_singular_before_comments_hook() {
    do_action( 'cryout_singular_before_comments_hook' );
}

// After the actual post content on pages and posts (single.php and content-page.php)
function cryout_singular_after_inner_hook() {
    do_action( 'cryout_singular_after_inner_hook' );
}

// After the actual post content
function cryout_post_after_content_hook() {
    do_action( 'cryout_post_after_content_hook' );
}

// After the actual post content
function cryout_post_footer_hook() {
    do_action( 'cryout_post_footer_hook' );
}

/**
 * CONTENT HOOKS
 */

function cryout_before_content_hook() {
    do_action( 'cryout_before_content_hook' );
}

function cryout_after_content_hook() {
    do_action( 'cryout_after_content_hook' );
}

function cryout_empty_page_hook() {
    do_action( 'cryout_empty_page_hook' );
}

function cryout_absolute_top_hook() {
    do_action( 'cryout_absolute_top_hook' );
}

function cryout_absolute_bottom_hook() {
    do_action( 'cryout_absolute_bottom_hook' );
}

/* FIN */
