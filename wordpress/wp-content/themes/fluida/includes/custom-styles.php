<?php
/**
 * Master generated style function
 *
 * @package Fluida
 */

function fluida_body_classes( $classes ) {
	$options = cryout_get_option( array(
		'fluida_landingpage', 'fluida_image_style', 'fluida_magazinelayout', 'fluida_comclosed', 'fluida_contenttitles', 'fluida_caption_style',
		'fluida_elementborder', 'fluida_elementshadow', 'fluida_elementborderradius', 'fluida_totop', 'fluida_menustyle', 'fluida_menulayout',
		'fluida_headerresponsive', 'fluida_fresponsive', 'fluida_comlabels', 'fluida_comdate', 'fluida_tables', 'fluida_normalizetags', 'fluida_articleanimation', 'fluida_menuheight'
	) );

	if ( is_front_page() && $options['fluida_landingpage'] && ( 'page' == get_option('show_on_front') ) ) {
		$classes[] = 'fluida-landing-page';
	}

	$classes[] = esc_html( $options['fluida_image_style'] );
	$classes[] = esc_html( $options['fluida_caption_style'] );
	$classes[] = esc_html( $options['fluida_totop'] );
	$classes[] = esc_html( $options['fluida_tables'] );

	if ( $options['fluida_menustyle'] ) $classes[] = 'fluida-fixed-menu';
	if ( $options['fluida_menulayout'] == 0 ) $classes[] = 'fluida-menu-left';
	if ( $options['fluida_menulayout'] == 2 ) $classes[] = 'fluida-menu-center';

	if ( $options['fluida_headerresponsive'] ) $classes[] = 'fluida-responsive-headerimage';
			else $classes[] = 'fluida-cropped-headerimage';

	if ( $options['fluida_fresponsive'] ) $classes[] = 'fluida-responsive-featured';
		else $classes[] = 'fluida-cropped-featured';

	if ( $options['fluida_magazinelayout'] ) {
		switch ( $options['fluida_magazinelayout'] ):
			case 1: $classes[] = 'fluida-magazine-one fluida-magazine-layout'; break;
			case 2: $classes[] = 'fluida-magazine-two fluida-magazine-layout'; break;
			case 3: $classes[] = 'fluida-magazine-three fluida-magazine-layout'; break;
		endswitch;
	}
	switch ( $options['fluida_comclosed'] ) {
		case 2: $classes[] = 'fluida-comhide-in-posts'; break;
		case 3: $classes[] = 'fluida-comhide-in-pages'; break;
		case 0: $classes[] = 'fluida-comhide-in-posts'; $classes[] = 'fluida-comhide-in-pages'; break;
	}
	if ( $options['fluida_comlabels'] == 1 ) $classes[] = 'fluida-comment-placeholder';
	if ( $options['fluida_comdate'] == 1 ) $classes[] = 'fluida-comment-date-published';

	switch ( $options['fluida_contenttitles'] ) {
		case 2: $classes[] = 'fluida-hide-page-title'; break;
		case 3: $classes[] = 'fluida-hide-cat-title'; break;
		case 0: $classes[] = 'fluida-hide-page-title'; $classes[] = 'fluida-hide-cat-title'; break;
	}

	if ( $options['fluida_elementborder'] ) $classes[] = 'fluida-elementborder';
	if ( $options['fluida_elementshadow'] ) $classes[] = 'fluida-elementshadow';
	if ( $options['fluida_elementborderradius'] ) $classes[] = 'fluida-elementradius';
	if ( $options['fluida_normalizetags'] ) $classes[] = 'fluida-normalizedtags';

	if ( !empty( $options['fluida_articleanimation'] ) ) $classes[] = 'fluida-article-animation-' . esc_attr( $options['fluida_articleanimation'] );

	if ( $options['fluida_menuheight'] > 70) { $classes[] = 'fluida-menu-animation'; }

	return $classes;
}
add_filter( 'body_class', 'fluida_body_classes' );


/*
 * Dynamic styles for the frontend
 */
function fluida_custom_styles() {
$options = cryout_get_option();
extract($options);

ob_start();
/////////// LAYOUT DIMENSIONS. ///////////
switch ( $fluida_layoutalign ) {

	case 3: // center contained ?>
			body, #site-header-main, #header-image-main-inside, #wp-custom-header {
				margin: 0 auto;
				max-width: <?php echo esc_html( $fluida_sitewidth ); ?>px;
			}
			<?php if ( esc_html( $fluida_menustyle ) ) { ?> #site-header-main { left: 0; right: 0; } <?php } ?>
	<?php break;

	case 2: // center ?>
			#site-header-main-inside, #container, #colophon-inside, #footer-inside, #breadcrumbs-container-inside, #wp-custom-header {
				margin: 0 auto;
				max-width: <?php echo esc_html( $fluida_sitewidth ); ?>px;
			}
			<?php if ( esc_html( $fluida_menustyle ) ) { ?> #site-header-main { left: 0; right: 0; } <?php } ?>
	<?php break;

	case 1: // left ?>
			#site-header-main-inside, #container, #colophon-inside, #footer-inside, #breadcrumbs-container-inside {
				margin: 0;
				max-width: <?php echo esc_html( $fluida_sitewidth ); ?>px;
			}
			#colophon-inside {margin-left: 1em;}
	<?php break;

	case 0: // left contained ?>
			body, #site-header-main, #header-image-main-inside { max-width: <?php echo esc_html( $fluida_sitewidth ); ?>px; }
			#colophon-inside { margin: 0 0 0 1em; }
	<?php break;
}

/////////// COLUMNS ///////////
$colPadding = 2; // percent
$sidebarP = intval($fluida_primarysidebar);
$sidebarS = intval($fluida_secondarysidebar);
?>

#primary 									{ width: <?php echo $sidebarP; ?>px; }
#secondary 									{ width: <?php echo $sidebarS; ?>px; }

#container.one-column 						{ }
#container.two-columns-right #secondary 	{ float: right; }
#container.two-columns-right .main,
.two-columns-right #breadcrumbs				{ width: calc( <?php echo 100 - (int) $colPadding ?>% - <?php echo $sidebarS; ?>px ); float: left; }
#container.two-columns-left #primary 		{ float: left; }
#container.two-columns-left .main,
.two-columns-left #breadcrumbs				{ width: calc( <?php echo 100 - (int) $colPadding ?>% - <?php echo $sidebarP; ?>px ); float: right; }

#container.three-columns-right #primary,
#container.three-columns-left #primary,
#container.three-columns-sided #primary		{ float: left; }

#container.three-columns-right #secondary,
#container.three-columns-left #secondary,
#container.three-columns-sided #secondary	{ float: left; }


#container.three-columns-right #primary,
#container.three-columns-left #secondary 	{ margin-left: <?php echo esc_html( $colPadding ) ?>%; margin-right: <?php echo esc_html( $colPadding ) ?>%; }
#container.three-columns-right .main,
.three-columns-right #breadcrumbs			{ width: calc( <?php echo 100 - absint( $colPadding ) * 2 ?>% - <?php echo absint( $sidebarS + $sidebarP ); ?>px ); float: left; }
#container.three-columns-left .main,
.three-columns-left #breadcrumbs				{ width: calc( <?php echo 100 - absint( $colPadding ) * 2 ?>% - <?php echo absint( $sidebarS + $sidebarP ); ?>px ); float: right; }

#container.three-columns-sided #secondary 	{ float: right; }
#container.three-columns-sided .main,
.three-columns-sided #breadcrumbs			{ width: calc( <?php echo 100 - absint( $colPadding ) * 2 ?>% - <?php echo absint( $sidebarS + $sidebarP ); ?>px ); float: right;
											  margin: 0 calc( <?php echo absint( $colPadding ) ?>% + <?php echo absint($sidebarS) ?>px ) 0 -1920px; }

<?php if ( in_array( $fluida_siteheader, array( 'logo', 'empty' ) ) ) { ?>
	#site-text {
			clip: rect(1px, 1px, 1px, 1px);
			height: 1px;
			overflow: hidden;
			position: absolute !important;
			width: 1px;
			word-wrap: normal !important;
	}
<?php }

/////////// FONTS ///////////
?>
html
					{ font-family: <?php echo cryout_font_select( $fluida_fgeneral, $fluida_fgeneralgoogle ) ?>;
					  font-size: <?php echo esc_html( $fluida_fgeneralsize ) ?>; font-weight: <?php echo esc_html( $fluida_fgeneralweight ) ?>;
					  line-height: <?php echo esc_html( (float) $fluida_lineheight ) ?>; }

#site-title 		{ font-family: <?php echo cryout_font_select( $fluida_fsitetitle, $fluida_fsitetitlegoogle ) ?>;
					  font-size: <?php echo esc_html( $fluida_fsitetitlesize ) ?>; font-weight: <?php echo esc_html( $fluida_fsitetitleweight ) ?>; }

#access ul li a 	{ font-family: <?php echo cryout_font_select( $fluida_fmenu, $fluida_fmenugoogle ) ?>;
					  font-size: <?php echo esc_html( $fluida_fmenusize ) ?>; font-weight: <?php echo esc_html( $fluida_fmenuweight ) ?>; }

#access i.search-icon { font-size: <?php echo esc_html( $fluida_fmenusize ) ?>; }

.widget-title 		{ font-family: <?php echo cryout_font_select( $fluida_fwtitle, $fluida_fwtitlegoogle ) ?>;
					  font-size: <?php echo esc_html( $fluida_fwtitlesize ) ?>; font-weight: <?php echo esc_html( $fluida_fwtitleweight ) ?>; }
.widget-container 	{ font-family: <?php echo cryout_font_select( $fluida_fwcontent, $fluida_fwcontentgoogle ) ?>;
				      font-size: <?php echo esc_html( $fluida_fwcontentsize ) ?>; font-weight: <?php echo esc_html( $fluida_fwcontentweight ) ?>; }
.entry-title, #reply-title,
.woocommerce .main .page-title
					{ font-family: <?php echo cryout_font_select( $fluida_ftitles, $fluida_ftitlesgoogle ) ?>;
					  font-size: <?php echo esc_html( $fluida_ftitlessize ) ?>; font-weight: <?php echo esc_html( $fluida_ftitlesweight ) ?>; }
.content-masonry .entry-title
					{ font-size: <?php echo esc_html( (int)$fluida_ftitlessize * 0.75 ) ?>%; }

<?php
$font_root = 2.6; // headings font size root
for ( $i = 1; $i <= 6; $i++ ) {
		$size = round( ( $font_root - ( 0.27 * $i ) ) * ( preg_replace( "/[^\d]/", "", esc_html( $fluida_fheadingssize ) ) / 100), 5 ); ?>
	h<?php echo $i ?> { font-size: <?php echo $size ?>em; } <?php
} //for ?>
h1, h2, h3, h4, h5, h6 { font-family: <?php echo cryout_font_select( $fluida_fheadings, $fluida_fheadingsgoogle ) ?>;
					     font-weight: <?php echo esc_html( $fluida_fheadingsweight ) ?>; }


<?php
/////////// COLORS ///////////
?>
body 										{ color: <?php echo esc_html( $fluida_sitetext ) ?>;
											  background-color: <?php echo esc_html( $fluida_sitebackground ) ?>; }
#site-header-main,  #site-header-main-inside, #access ul li a, #access ul ul,
.menu-search-animated .searchform input[type="search"], #access::after
											{ background-color: <?php echo esc_html( $fluida_menubackground ) ?>; }
#access .menu-main-search .searchform 		{ border-color: <?php echo esc_html( $fluida_menutext ) ?>; }

#header a 									{ color: <?php echo esc_html( $fluida_accent1 ) ?>; }
#access > div > ul > li,
#access > div > ul > li > a					{ color: <?php echo esc_html( $fluida_menutext ) ?>; }
#access ul.sub-menu li a,
#access ul.children li a 					{ color: <?php echo esc_html( $fluida_submenutext ) ?>; }
#access ul.sub-menu li:hover > a,
#access ul.children li:hover > a			{ background-color: rgba(<?php echo cryout_hex2rgb( esc_html( $fluida_submenutext ) ) ?>,0.1); }
#access > div > ul > li:hover > a 			{ color: <?php echo esc_html( $fluida_menubackground ) ?>; }
#access ul > li.current_page_item > a,
#access ul > li.current-menu-item > a,
#access ul > li.current_page_ancestor > a,
#access ul > li.current-menu-ancestor > a,
#access .sub-menu, #access .children 		{ border-top-color: <?php echo esc_html( $fluida_menutext ) ?>; }
#access ul ul ul					 		{ border-left-color: rgba(<?php echo cryout_hex2rgb( esc_html( $fluida_submenutext ) ) ?>,0.5); }
#access > div > ul > li.menu-main-search:hover,
#access > div > ul > li:hover > a			{ background-color: <?php echo esc_html( $fluida_menutext ) ?>; }

#access ul.children > li.current_page_item > a,
#access ul.sub-menu > li.current-menu-item > a,
#access ul.children > li.current_page_ancestor > a,
#access ul.sub-menu > li.current-menu-ancestor > a
											{ border-color: <?php echo esc_html( $fluida_submenutext ) ?>; }
.searchform .searchsubmit, .searchform:hover input[type="search"], .searchform input[type="search"]:focus
											{ color: <?php echo esc_html( $fluida_contentbackground ) ?>; background-color: transparent; }
.searchform::after, .searchform input[type="search"]:focus, .searchform .searchsubmit:hover
											{ background-color: <?php echo esc_html( $fluida_accent1 ) ?>; }

article.hentry, #primary, .searchform, .main > div:not(#content-masonry),
.main > header, .main > nav#nav-below, .pagination span, .pagination a,
#nav-old-below .nav-previous, #nav-old-below .nav-next
											{ background-color: <?php echo esc_html( $fluida_contentbackground ) ?>; }
#breadcrumbs-container 						{ background-color: <?php echo esc_html( cryout_hexdiff( $fluida_menubackground, 7 ) ); ?>;}
#secondary			 						{ background-color: <?php echo esc_html( $fluida_contentbackground2 ) ?>; }

#colophon, #footer 							{ background-color: <?php echo esc_html( $fluida_footerbackground ) ?>;
 											  color: <?php echo esc_html( $fluida_footertext ) ?>; }

span.entry-format 							{ color: <?php echo esc_html( $fluida_accent1 ) ?>; }

.format-aside 								{ border-top-color: <?php echo esc_html( $fluida_sitebackground ) ?>; }

article.hentry .post-thumbnail-container
											{ background-color: rgba(<?php echo cryout_hex2rgb( esc_html( $fluida_sitetext ) ) ?>,0.15); }
.entry-content blockquote::before,
.entry-content blockquote::after 			{ color: rgba(<?php echo cryout_hex2rgb( esc_html( $fluida_sitetext ) ) ?>,0.1); }
.entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4
											{ color: <?php echo esc_html( $fluida_headingstext ) ?>; }

a 											{ color: <?php echo esc_html( $fluida_accent1 ); ?>; }
a:hover, .entry-meta span a:hover,
.comments-link a:hover 						{ color: <?php echo esc_html( $fluida_accent2 ); ?>; }

#footer a, .page-title strong 				{ color: <?php echo esc_html( $fluida_accent1 ) ?>; }
#footer a:hover, #site-title a:hover span 	{ color: <?php echo esc_html( $fluida_accent2 ) ?>; }
#access > div > ul > li.menu-search-animated:hover i
											{ color: <?php echo esc_html( $fluida_menubackground ) ?>; }

.continue-reading-link { color: <?php echo esc_html( $fluida_contentbackground ) ?>; background-color: <?php echo esc_html( $fluida_accent2 ); ?>}
.continue-reading-link:before { background-color: <?php echo esc_html( $fluida_accent1 ); ?>}
.continue-reading-link:hover { color: <?php echo esc_html( $fluida_contentbackground ) ?>; }

header.pad-container						{ border-top-color: <?php echo esc_html( $fluida_accent1 ) ?>; }
article.sticky:after 						{ background-color: rgba(<?php echo cryout_hex2rgb( esc_html( $fluida_accent1 ) ) ?>,1); }
.socials a:before 							{ color: <?php echo esc_html( $fluida_accent1 ) ?>; }
.socials a:hover:before 					{ color: <?php echo esc_html( $fluida_accent2 ) ?>; }

.fluida-normalizedtags #content .tagcloud a { color: <?php echo esc_html($fluida_contentbackground) ?>; background-color: <?php echo esc_html( $fluida_accent1 ) ?>; }
.fluida-normalizedtags #content .tagcloud a:hover { background-color: <?php echo esc_html( $fluida_accent2 ) ?>; }

#toTop .icon-back2top:before 				{ color: <?php echo esc_html( $fluida_accent1 ) ?>; }
#toTop:hover .icon-back2top:before 			{ color: <?php echo esc_html( $fluida_accent2 ) ?>; }
.entry-meta .icon-metas:before				{ color: <?php echo esc_html( $fluida_accent2 ) ?>; }
.page-link a:hover 							{ border-top-color: <?php echo esc_html( $fluida_accent2 ) ?>; }

#site-title span a span:nth-child(<?php echo (int)$fluida_titleaccent ?>) 		{ background-color: <?php echo esc_html( $fluida_accent1 ) ?>;
											  color: <?php echo esc_html( $fluida_menubackground ) ?>;
											  width: 1.4em; margin-right: .1em; text-align: center; line-height: 1.4; font-weight: 300; }
#site-title span a:hover span:nth-child(<?php echo (int)$fluida_titleaccent ?>)	{ background-color: <?php echo esc_html( $fluida_accent2 ) ?>; }

.fluida-caption-one .main .wp-caption .wp-caption-text 	{ border-bottom-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 17 ) ) ?>; }
.fluida-caption-two .main .wp-caption .wp-caption-text 	{ background-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground,10 ) ) ?>; }

.fluida-image-one .entry-content img[class*="align"],
.fluida-image-one .entry-summary img[class*="align"],
.fluida-image-two .entry-content img[class*='align'],
.fluida-image-two .entry-summary img[class*='align'] 	{ border-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 17 ) ) ?>; }
.fluida-image-five .entry-content img[class*='align'],
.fluida-image-five .entry-summary img[class*='align'] 	{ border-color: <?php echo esc_html( $fluida_accent1 ); ?>; }

/* diffs */
span.edit-link a.post-edit-link, span.edit-link a.post-edit-link:hover, span.edit-link .icon-edit:before
											{ color: <?php echo esc_html( cryout_hexdiff( $fluida_sitetext, 69) ) ?>; }

.searchform 								{ border-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 20) ) ?>; }
.entry-meta span, .entry-utility span, .entry-meta time,
.comment-meta a, #breadcrumbs-nav .icon-angle-right::before,
 .footermenu ul li span.sep					{ color: <?php echo esc_html( cryout_hexdiff( $fluida_sitetext, 69) ) ?>; }
 #footer 									{ border-top-color: <?php echo esc_html (cryout_hexdiff ($fluida_footerbackground, 20 ) ) ?>; }
 #colophon .widget-container:after 			{ background-color: <?php echo esc_html (cryout_hexdiff ($fluida_footerbackground, 20 ) ) ?>; }

#commentform								{ <?php if ( $fluida_comformwidth ) { echo 'max-width:' . esc_html( $fluida_comformwidth ) . 'px;';}?>}

code, .reply a:after,
#nav-below .nav-previous a:before, #nav-below .nav-next a:before, .reply a:after
											{ background-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 17 ) ) ?>; }
pre, .entry-meta .author, nav.sidebarmenu, .page-link > span, article #author-info, .comment-author,
.commentlist .comment-body, .commentlist .pingback, nav.sidebarmenu li a
											{ border-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 17 ) ) ?>; }

select, input[type], textarea 				{ color: <?php echo esc_html( $fluida_sitetext ); ?>; }
button, input[type="button"], input[type="submit"], input[type="reset"]
											{ background-color: <?php echo esc_html( $fluida_accent1 ) ?>;
											  color: <?php echo esc_html( $fluida_contentbackground ) ?>; }
button:hover, input[type="button"]:hover, input[type="submit"]:hover, input[type="reset"]:hover
											{ background-color: <?php echo esc_html( $fluida_accent2 ) ?>; }
select, input[type], textarea
											{ border-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 22 ) ) ?>; }
input[type]:hover, textarea:hover, select:hover,
input[type]:focus, textarea:focus, select:focus
											{ border-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 50 ) ) ?>; }

hr											{ background-color: <?php echo esc_html(cryout_hexdiff($fluida_contentbackground, 22 ) ) ?>; }

#toTop 										{ background-color: rgba(<?php echo esc_html( cryout_hex2rgb( cryout_hexdiff( $fluida_contentbackground, 5 ) ) ) ?>,0.8) }

/* woocommerce */
.woocommerce-page #respond input#submit.alt, .woocommerce a.button.alt,
.woocommerce-page button.button.alt, .woocommerce input.button.alt,
.woocommerce #respond input#submit, .woocommerce a.button,
.woocommerce button.button, .woocommerce input.button
											{ background-color: <?php echo esc_html( $fluida_accent1 ) ?>;
											  color: <?php echo esc_html( $fluida_contentbackground ) ?>;
											  line-height: <?php echo esc_html( (float) $fluida_lineheight ) ?>; }
.woocommerce #respond input#submit:hover, .woocommerce a.button:hover,
.woocommerce button.button:hover, .woocommerce input.button:hover
											{ background-color: <?php echo esc_html( cryout_hexdiff( $fluida_accent1, -34 ) ) ?>;
										 	 color: <?php echo esc_html( $fluida_contentbackground ) ?>;}
.woocommerce-page #respond input#submit.alt, .woocommerce a.button.alt,
.woocommerce-page button.button.alt, .woocommerce input.button.alt
											{ background-color: <?php echo esc_html( $fluida_accent2 ) ?>;
											  color: <?php echo esc_html( $fluida_contentbackground ) ?>;
										  	  line-height: <?php echo esc_html( (float) $fluida_lineheight ) ?>; }
.woocommerce-page #respond input#submit.alt:hover, .woocommerce a.button.alt:hover,
.woocommerce-page button.button.alt:hover, .woocommerce input.button.alt:hover
											{ background-color: <?php echo esc_html( cryout_hexdiff( $fluida_accent2, -34 ) ) ?>;
											  color: <?php echo esc_html( $fluida_contentbackground ) ?>;}
.woocommerce div.product .woocommerce-tabs ul.tabs li.active
											{ border-bottom-color: <?php echo esc_html( $fluida_contentbackground ) ?>; }
.woocommerce #respond input#submit.alt.disabled,
.woocommerce #respond input#submit.alt.disabled:hover,
.woocommerce #respond input#submit.alt:disabled,
.woocommerce #respond input#submit.alt:disabled:hover,
.woocommerce #respond input#submit.alt[disabled]:disabled,
.woocommerce #respond input#submit.alt[disabled]:disabled:hover,
.woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover,
.woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover,
.woocommerce a.button.alt[disabled]:disabled,
.woocommerce a.button.alt[disabled]:disabled:hover,
.woocommerce button.button.alt.disabled,
.woocommerce button.button.alt.disabled:hover,
.woocommerce button.button.alt:disabled,
.woocommerce button.button.alt:disabled:hover,
.woocommerce button.button.alt[disabled]:disabled,
.woocommerce button.button.alt[disabled]:disabled:hover,
.woocommerce input.button.alt.disabled,
.woocommerce input.button.alt.disabled:hover,
.woocommerce input.button.alt:disabled,
.woocommerce input.button.alt:disabled:hover,
.woocommerce input.button.alt[disabled]:disabled,
.woocommerce input.button.alt[disabled]:disabled:hover
											{ background-color: <?php echo esc_html( $fluida_accent2 ) ?>; }
.woocommerce ul.products li.product .price, .woocommerce div.product p.price,
.woocommerce div.product span.price
											{ color: <?php echo esc_html( cryout_hexdiff( $fluida_sitetext, -50 ) ); ?> }
#add_payment_method #payment, .woocommerce-cart #payment, .woocommerce-checkout #payment {
	background: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 10 ) ) ?>;
}


/* mobile menu */
nav#mobile-menu 							{ background-color: <?php echo esc_html( $fluida_menubackground ) ?>; }
#mobile-menu .mobile-arrow 					{ color: <?php esc_html( $fluida_sitetext ) ?>; }

<?php
/////////// LAYOUT ///////////
?>
.main .entry-content, .main .entry-summary 	{ text-align: <?php echo esc_html( $fluida_textalign ) ?>; }
.main p, .main ul, .main ol, .main dd, .main pre, .main hr
											{ margin-bottom: <?php echo esc_html( $fluida_paragraphspace ) ?>; }
.main p 									{ text-indent: <?php echo esc_html( $fluida_parindent ) ?>;}
.main a.post-featured-image 				{ background-position: <?php echo esc_html( $fluida_falign ) ?>; }

#content			 						{ margin-top: <?php echo esc_html( $fluida_contentmargintop ) ?>px; }
#content 									{ padding-left: <?php echo esc_html( $fluida_contentpadding ) ?>px;
											  padding-right: <?php echo esc_html( $fluida_contentpadding ) ?>px; }
#header-widget-area 						{ width: <?php echo esc_html( $fluida_headerwidgetwidth ) ?>;
											<?php switch ( esc_html( $fluida_headerwidgetalign ) ) {
												case 'left': ?> left: 10px; <?php break;
												case 'right': ?> right: 10px; <?php break;
												case 'center': ?>  left: calc(50% - <?php echo esc_html( $fluida_headerwidgetwidth ) ?> / 2); <?php break;
											} ?> }

.fluida-stripped-table .main thead th,
.fluida-bordered-table .main thead th,
.fluida-stripped-table .main td, .fluida-stripped-table .main th,
.fluida-bordered-table .main th, .fluida-bordered-table .main td
											{ border-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 22 ) ) ?>; }

.fluida-clean-table .main th,
.fluida-stripped-table .main tr:nth-child(even) td,
.fluida-stripped-table .main tr:nth-child(even) th
											{ background-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 9 ) ) ?>; }
<?php if ( $fluida_fpost && ( $fluida_fheight > 0 ) ) { ?>
.fluida-cropped-featured .main .post-thumbnail-container
											{ height: <?php echo esc_html( $fluida_fheight ) ?>px; }
.fluida-responsive-featured .main .post-thumbnail-container
											{ max-height: <?php echo esc_html( $fluida_fheight ) ?>px; height: auto; }
<?php } ?>

<?php
/////////// SOME CONDITIONAL CLEANUP ///////////
if ( empty( $fluida_contentbackground ) ) {  ?> #primary, #colophon { border: 0; box-shadow: none; } <?php }
if ( empty( $fluida_contentbackground2 ) ) { ?> #secondary { border: 0; box-shadow: none; }
											 #primary + #secondary { padding-left: 1em; } <?php }

/////////// ELEMENTS PADDING ///////////
?>
article.hentry .article-inner, #breadcrumbs-nav, body.woocommerce.woocommerce-page #breadcrumbs-nav,
#content-masonry article.hentry .article-inner, .pad-container  {
		padding-left: <?php echo esc_html( $fluida_elementpadding ) ?>%;
		padding-right: <?php echo esc_html( $fluida_elementpadding ) ?>%;
}

.fluida-magazine-two.archive #breadcrumbs-nav,
.fluida-magazine-two.archive .pad-container,
.fluida-magazine-two.search #breadcrumbs-nav,
.fluida-magazine-two.search .pad-container,
.fluida-magazine-two.page-template-template-page-with-intro #breadcrumbs-nav,
.fluida-magazine-two.page-template-template-page-with-intro .pad-container {
	padding-left: <?php echo esc_html( $fluida_elementpadding/2 ) ?>%;
	padding-right: <?php echo esc_html( $fluida_elementpadding/2 ) ?>%;
}

.fluida-magazine-three.archive #breadcrumbs-nav,
.fluida-magazine-three.archive .pad-container,
.fluida-magazine-three.search #breadcrumbs-nav,
.fluida-magazine-three.search .pad-container,
.fluida-magazine-three.page-template-template-page-with-intro #breadcrumbs-nav,
.fluida-magazine-three.page-template-template-page-with-intro .pad-container {
	padding-left: <?php echo esc_html( $fluida_elementpadding/3 ) ?>%;
	padding-right: <?php echo esc_html( $fluida_elementpadding/3 ) ?>%;
}

<?php
/////////// HEADER LAYOUT ///////////
?>
#site-header-main { height:<?php echo esc_html( $fluida_menuheight ) ?>px; }
.menu-search-animated, #sheader, .identity, #nav-toggle
											{ height:<?php echo esc_html( $fluida_menuheight ) ?>px;
											  line-height:<?php echo esc_html( $fluida_menuheight ) ?>px; }
#access div > ul > li > a 					{ line-height:<?php echo intval( (int) $fluida_menuheight - 2 ) ?>px; }
#branding		 							{ height:<?php echo intval( $fluida_menuheight ) ?>px; }
<?php if ( ! ( is_front_page() && function_exists( 'the_custom_header_markup' ) && has_header_video() ) ) { ?>
	.fluida-responsive-headerimage #masthead #header-image-main-inside
												{ max-height: <?php echo esc_html( $fluida_headerheight ) ?>px; }
	.fluida-cropped-headerimage #masthead div.header-image
												{ height: <?php echo esc_html( $fluida_headerheight ) ?>px; }
<?php } ?>
<?php if ( $fluida_sitetagline ) {?> #site-description { display: block; } <?php } ?>
<?php if (! display_header_text() ) { ?>
	#site-text	 							{ display: none; }
<?php }; ?>
<?php if ( esc_html( $fluida_menustyle ) ) { ?>
	#masthead #site-header-main 			{ position: fixed; top: 0; box-shadow: 0 0 3px rgba(0,0,0,0.2); }
	#header-image-main						{ margin-top: <?php echo esc_html( $fluida_menuheight ) ?>px; }
<?php };
/////////// lANDING PAGE ///////////

$lp_width = (int)$fluida_sitewidth;

if ( $fluida_lplayout && in_array( $fluida_sitelayout, array('2cSr', '3cSr', '3cSs' ) ) ) $lp_width -= (int)$sidebarP;
if ( $fluida_lplayout && in_array( $fluida_sitelayout, array('2cSl', '3cSl', '3cSs' ) ) ) $lp_width -= (int)$sidebarS;
?>
.fluida-landing-page .lp-blocks-inside,
.fluida-landing-page .lp-boxes-inside,
.fluida-landing-page .lp-text-inside,
.fluida-landing-page .lp-posts-inside,
.fluida-landing-page .lp-section-header		{ max-width: <?php echo esc_html( $lp_width ) ?>px;	}

.seriousslider-theme .seriousslider-caption-buttons a:nth-child(2n+1),
a.staticslider-button:nth-child(2n+1)			{ color: <?php echo esc_html( $fluida_sitetext ) ?>;
										  	border-color: <?php echo esc_html( $fluida_contentbackground ) ?>;
										  	background-color: <?php echo esc_html( $fluida_contentbackground ) ?>;   }
.seriousslider-theme .seriousslider-caption-buttons a:nth-child(2n+1):hover,
a.staticslider-button:nth-child(2n+1):hover 	{ color: <?php echo esc_html( $fluida_contentbackground ); ?>; }
.seriousslider-theme .seriousslider-caption-buttons a:nth-child(2n),
a.staticslider-button:nth-child(2n) { border-color: <?php echo esc_html( $fluida_contentbackground ) ?>;
	 									color: <?php echo esc_html( $fluida_contentbackground ); ?>; }
.seriousslider-theme .seriousslider-caption-buttons a:nth-child(2n):hover,
.staticslider-button:nth-child(2n):hover { color: <?php echo esc_html( $fluida_sitetext ) ?>;
											background-color: <?php echo esc_html( $fluida_contentbackground ) ?>; }

<?php if ( $fluida_lpslider == 3 ) {?> .fluida-landing-page #header-image-main-inside { display: block; } <?php } ?>
.lp-blocks { background-color:  <?php echo esc_html( $fluida_contentbackground2 ) ?>; }
.lp-block > i::before { color: <?php echo esc_html( $fluida_accent1 ); ?>; }
.lp-block:hover i::before { color: <?php echo esc_html( $fluida_accent2 ); ?>; }
.lp-block i:after { background-color: <?php echo esc_html( $fluida_accent1 ); ?>; }
.lp-block:hover i:after { background-color: <?php echo esc_html( $fluida_accent2); ?>; }
.lp-block-text, .lp-boxes-static .lp-box-text, .lp-section-desc { color: <?php echo esc_html( cryout_hexdiff( $fluida_sitetext, 60 ) ) ?>; }
.lp-text { background-color:  <?php echo esc_html( $fluida_contentbackground ) ?>; }
.lp-boxes-1 .lp-box .lp-box-image { height: <?php echo intval ( (int) $fluida_lpboxheight1 ); ?>px; }
.lp-boxes-1.lp-boxes-animated .lp-box:hover .lp-box-text { max-height: <?php echo intval ( (int) $fluida_lpboxheight1 - 100 ); ?>px; }
.lp-boxes-2 .lp-box .lp-box-image { height: <?php echo intval ( (int) $fluida_lpboxheight2 ); ?>px; }
.lp-boxes-2.lp-boxes-animated .lp-box:hover .lp-box-text { max-height: <?php echo intval ( (int) $fluida_lpboxheight2 - 100 ); ?>px; }
.lp-box-readmore { color: <?php echo esc_html( $fluida_accent1 ) ?>; }
.lp-boxes .lp-box-overlay { background-color: rgba(<?php echo cryout_hex2rgb( esc_html( $fluida_accent1 ) ) ?>, 0.9); }
<?php
for ($i=1; $i<=8; $i++) { ?>
	.lpbox-rnd<?php echo $i ?> { background-color:  <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 50+5*$i ) ) ?>; }
<?php }

	return apply_filters( 'fluida_custom_styles', preg_replace('/((background-)?color:\s*?)[;}]/i', '', ob_get_clean() ) );
} // fluida_custom_styles()


/*
 * Dynamic styles for the admin MCE Editor
 */
function fluida_editor_styles() {
	header( 'Content-type: text/css' );
	$options = cryout_get_option();
	extract($options);

	switch ( $fluida_sitelayout ) {
		case '1c':
			$fluida_primarysidebar = $fluida_secondarysidebar = 0;
			break;
		case '2cSl':
			$fluida_secondarysidebar = 0;
			break;
		case '2cSr':
			$fluida_primarysidebar = 0;
			break;
		default:
			break;
	}
	$content_body = floor( (int) $fluida_sitewidth - ( (int) $fluida_primarysidebar + (int) $fluida_secondarysidebar ) );

	ob_start();
?>
body.mce-content-body {
	max-width: <?php echo esc_html( $content_body ); ?>px;
	font-family: <?php echo cryout_font_select( $fluida_fgeneral, $fluida_fgeneralgoogle ) ?>;
	font-size: <?php echo esc_html( $fluida_fgeneralsize ) ?>; font-weight: <?php echo esc_html( $fluida_fgeneralweight ) ?>;
	line-height: <?php echo esc_html( (float) $fluida_lineheight ) ?>;
	color: <?php echo esc_html( $fluida_sitetext ); ?>;
	background-color: <?php echo esc_html( $fluida_contentbackground ) ?>	}
<?php
$font_root = 2.6; // headings font size root
for ( $i = 1; $i <= 6; $i++ ) {
		$size = round( ( $font_root - ( 0.27 * $i ) ) * ( preg_replace( "/[^\d]/", "", esc_html( $fluida_fheadingssize ) ) / 100), 5 ); ?>
		 h<?php echo $i ?> { font-size: <?php echo $size ?>em; } <?php
} //for ?>
h1, h2,  h3,  h4,  h5,  h6 {
	font-family: <?php echo cryout_font_select( $fluida_fheadings, $fluida_fheadingsgoogle ) ?>;
	font-weight: <?php echo esc_html( $fluida_fheadingsweight ) ?>; }

blockquote::before, blockquote::after {
	color: rgba(<?php echo cryout_hex2rgb( esc_html( $fluida_sitetext ) ) ?>,0.1); }

a 		{ color: <?php echo esc_html( $fluida_accent1 ); ?>; }
a:hover	{ color: <?php echo esc_html( $fluida_accent2 ); ?>; }

code	{ background-color: <?php echo esc_html(cryout_hexdiff( $fluida_contentbackground, 17 ) ) ?>; }
pre		{ border-color: <?php echo esc_html(cryout_hexdiff( $fluida_contentbackground, 17 ) ) ?>; }

select, input[type], textarea {
	color: <?php echo esc_html( $fluida_sitetext ); ?>;
	background-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 10 ) ) ?>;
	border-color: <?php echo esc_html( cryout_hexdiff( $fluida_contentbackground, 17 ) ) ?> }

p, ul, ol, dd,
pre, hr { margin-bottom: <?php echo esc_html( $fluida_paragraphspace ) ?>; }
p { text-indent: <?php echo esc_html( $fluida_parindent ) ?>;}

<?php // end </style>
	echo apply_filters( 'fluida_editor_styles', ob_get_clean() );
} // fluida_editor_styles()


/* FIN */
