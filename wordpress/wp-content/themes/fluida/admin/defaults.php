<?php
/**
 * Theme Defaults
 *
 * @package Fluida
 */

function fluida_get_option_defaults() {

	$sample_pages = fluida_get_default_pages();

	// DEFAULT OPTIONS ARRAY
	$fluida_defaults = array(

	"fluida_db" 				=> "0.9",

	"fluida_sitelayout"			=> "3cSs", // three columns, sided
	"fluida_sitewidth"  		=> 1920, // pixels
	"fluida_layoutalign"		=> 2, 	// 0=left contained, 1=left, 2=center, 3=center contained
	"fluida_primarysidebar"		=> 320, // pixels
	"fluida_secondarysidebar"	=> 320, // pixels
	"fluida_magazinelayout"		=> 2, 	// two column

	"fluida_landingpage"		=> 1, // 1=enabled, 0=disabled
	"fluida_lplayout"			=> 1, // 1=contained, 0=wide
	"fluida_lpposts"			=> 1, // 1=enabled, 0=disabled
	"fluida_lpposts_more"		=> 'More Posts',
	"fluida_lpslider"			=> 1, // 2=shortcode, 1=static, 0=disabled
	"fluida_lpsliderimage"		=> get_template_directory_uri() . '/resources/images/slider/static.jpg', // static image
	"fluida_lpslidertitle"		=> get_bloginfo('name'),
	"fluida_lpslidertext"		=> get_bloginfo('description'),
	"fluida_lpslidershortcode"	=> '',
	"fluida_lpslidercta1text"	=> '',
	"fluida_lpslidercta1link"	=> '',
	"fluida_lpslidercta2text"	=> '',
	"fluida_lpslidercta2link"	=> '',

	"fluida_lpblockmaintitle1"	=> '',
	"fluida_lpblockmaindesc1"	=> '',
	"fluida_lpblockscontent1"	=> 1, // 0=disabled, 1=excerpt, 2=full
	"fluida_lpblocksclick1"		=> 0,
	"fluida_lpblocksreadmore1"	=> '',
	"fluida_lpblockone1"		=> $sample_pages[1],
	"fluida_lpblockoneicon1"	=> 'screen-desktop',
	"fluida_lpblocktwo1"		=> $sample_pages[2],
	"fluida_lpblocktwoicon1"	=> 'layers',
	"fluida_lpblockthree1"		=> $sample_pages[3],
	"fluida_lpblockthreeicon1"	=> 'folder',
	"fluida_lpblockfour1"		=> 0,
	"fluida_lpblockfouricon1"	=> 'megaphone',

	"fluida_lpboxmainttitle1"	=> '',
	"fluida_lpboxmaindesc1"		=> '',
	"fluida_lpboxcat1"			=> '',
	"fluida_lpboxcount1"		=> 6,
	"fluida_lpboxrow1"			=> 3, // 1-4
	"fluida_lpboxheight1"		=> 250, // pixels
	"fluida_lpboxlayout1"		=> 2, // 1=full width, 2=boxed
	"fluida_lpboxmargins1"		=> 2, // 1=no margins, 2=margins
	"fluida_lpboxanimation1"	=> 2, // 1=animated, 2=static, ...
	"fluida_lpboxreadmore1"		=> 'Read More',
	"fluida_lpboxlength1"		=> 25,

	"fluida_lpboxmainttitle2"	=> '',
	"fluida_lpboxmaindesc2"		=> '',
	"fluida_lpboxcat2"			=> '',
	"fluida_lpboxcount2"		=> 8,
	"fluida_lpboxrow2"			=> 4, // 1-4
	"fluida_lpboxheight2"		=> 400, // pixels
	"fluida_lpboxlayout2"		=> 1, // 1=full width, 2=boxed
	"fluida_lpboxmargins2"		=> 1, // 1=no margins, 2=margins
	"fluida_lpboxanimation2"	=> 1, // 1=animated, 2=static
	"fluida_lpboxreadmore2"		=> 'Read More',
	"fluida_lpboxlength2"		=> 25,

	"fluida_lptextone"			=> $sample_pages[1],
	"fluida_lptexttwo"			=> $sample_pages[2],
	"fluida_lptextthree"		=> $sample_pages[3],
	"fluida_lptextfour"			=> $sample_pages[4],

	"fluida_menuheight"			=> 100, // pixels
	"fluida_menustyle"			=> 1, 	// normal, fixed
	"fluida_menulayout"			=> 1, 	// 0=left, 1=right, 2=center
	"fluida_headerheight" 		=> 250, // pixels
	"fluida_headerresponsive" 	=> 1, // cropped, responsive
	"fluida_titleaccent"		=> 1, // 0=disabled, 1+ letter index

	"fluida_logoupload"			=> '', // empty
	"fluida_siteheader"			=> 'both', // title, logo, both, empty
	"fluida_sitetagline"		=> '', // 1= show tagline
	"fluida_headerwidgetwidth"	=> "33%", // 25%, 33%, 50%, 60%, 100%
	"fluida_headerwidgetalign"  => "right", // left, center, right

	"fluida_fgeneral" 			=> 'Open Sans/gfont',
	"fluida_fgeneralgoogle" 	=> '',
	"fluida_fgeneralsize" 		=> '16px',
	"fluida_fgeneralweight" 	=> '300',

	"fluida_fsitetitle" 		=> 'Open Sans Condensed:300/gfont',
	"fluida_fsitetitlegoogle"	=> '',
	"fluida_fsitetitlesize" 	=> '150%',
	"fluida_fsitetitleweight"	=> '300',
	"fluida_fmenu" 				=> 'Open Sans Condensed:300/gfont',
	"fluida_fmenugoogle"		=> '',
	"fluida_fmenusize" 			=> '105%',
	"fluida_fmenuweight"		=> '300',

	"fluida_fwtitle" 			=> 'Open Sans/gfont',
	"fluida_fwtitlegoogle"		=> '',
	"fluida_fwtitlesize" 		=> '100%',
	"fluida_fwtitleweight"		=> '700',
	"fluida_fwcontent" 			=> 'Open Sans/gfont',
	"fluida_fwcontentgoogle"	=> '',
	"fluida_fwcontentsize" 		=> '100%',
	"fluida_fwcontentweight"	=> '300',

	"fluida_ftitles" 			=> 'Open Sans/gfont',
	"fluida_ftitlesgoogle"		=> '',
	"fluida_ftitlessize" 		=> '250%',
	"fluida_ftitlesweight"		=> '300',
	"fluida_fheadings" 			=> 'Open Sans Condensed:300/gfont',
	"fluida_fheadingsgoogle"	=> '',
	"fluida_fheadingssize" 		=> '130%',
	"fluida_fheadingsweight"	=> '300',

	"fluida_textalign"			=> "inherit",
	"fluida_paragraphspace"		=> "1.0em",
	"fluida_parindent"			=> "0.0em",
	"fluida_headingsindent"		=> "Disable",
	"fluida_lineheight"			=> "1.8em",

	"fluida_sitebackground" 	=> "#F3F3F3",
	"fluida_sitetext" 			=> "#555",
	"fluida_headingstext"		=> "#333",
	"fluida_contentbackground"	=> "#fff",
	"fluida_contentbackground2"	=> "",
	"fluida_menubackground" 	=> "#fff",
	"fluida_footerbackground"	=> "#222226",
	"fluida_footertext"			=> "#AAA",
	"fluida_menutext" 			=> "#0085b2",
	"fluida_submenutext" 		=> "#555",
	"fluida_lpblocksbg"			=> "",
	"fluida_lpboxesbg"			=> "",
	"fluida_lptextsbg"			=> "#FFF",
	"fluida_accent1" 			=> "#0085b2",
	"fluida_accent2" 			=> "#f42b00",

	"fluida_breadcrumbs"		=> 1,
	"fluida_pagination"			=> 1,
	"fluida_contenttitles" 		=> 1, // 1, 2, 3, 0
	"fluida_totop"				=> 'fluida-totop-normal',
	"fluida_tables"				=> 'fluida-stripped-table',
	"fluida_normalizetags"		=> 1, // 0,1

	"fluida_elementborder" 		=> 0,
	"fluida_elementshadow" 		=> 1,
	"fluida_elementborderradius"=> 0,
	"fluida_articleanimation"	=> 'fade', // 0=none, >0=effect

	"fluida_searchboxmain" 		=> 1,
	"fluida_searchboxfooter"	=> 0,
	"fluida_contentmargintop"	=> 20,
	"fluida_contentpadding" 	=> 0,
	"fluida_elementpadding" 	=> 10, // percent
	"fluida_footercols"			=> 3, // 0, 1, 2, 3, 4
	"fluida_footeralign"		=> 0,
	"fluida_image_style"		=> 'fluida-image-one',
	"fluida_caption_style"		=> 'fluida-caption-two',

	"fluida_meta_author" 		=> 1,
	"fluida_meta_date"	 		=> 1,
	"fluida_meta_time" 			=> 0,
	"fluida_meta_category" 		=> 1,
	"fluida_meta_tag" 			=> 1,
	"fluida_meta_comment" 		=> 1,

	"fluida_comlabels"			=> 1, // 1, 2
	"fluida_comdate"			=> 2, // 1, 2
	"fluida_comclosed"			=> 1, // 1, 2, 3, 0
	"fluida_comformwidth"		=> 650, // pixels

	"fluida_excerpthome"		=> 'excerpt',
	"fluida_excerptsticky"		=> 'full',
	"fluida_excerptarchive"		=> 'excerpt',
	"fluida_excerptlength"		=> "50",
	"fluida_excerptdots"		=> " &hellip;",
	"fluida_excerptcont"		=> "Continue reading",

	"fluida_fpost" 				=> 1,
	"fluida_fauto" 				=> 0,
	"fluida_falign" 			=> "center center",
	"fluida_fheight"			=> 200,
	"fluida_fresponsive" 		=> 1, // cropped, responsive
	"fluida_fheader" 			=> 1,

	"fluida_socials_header"			=> 0,
	"fluida_socials_footer"			=> 0,
	"fluida_socials_left_sidebar"	=> 0,
	"fluida_socials_right_sidebar"	=> 0,

	"fluida_postboxes" 			=> '',
	"fluida_copyright"			=> 'This text can be changed from the General &raquo; Structure section of the options panel. <br><b>Lorem ipsum</b> dolor sit amet, <a href="#">consectetur adipiscing</a> elit, cras ut imperdiet augue.',

	"fluida_customcss"			=> "/* Fluida Custom CSS */",
	"fluida_masonry"			=> 1,
	"fluida_defer"				=> 1,
	"fluida_fitvids"			=> 1,
	"fluida_autoscroll"			=> 1,
	"fluida_editorstyles"		=> 1,


	); // fluida_defaults array

	return apply_filters( 'fluida_option_defaults_array', $fluida_defaults );
} // fluida_get_option_defaults()

/* Get sample pages for options defaults */
function fluida_get_default_pages( $number = 4 ) {
	$block_ids = array( 0, 0, 0, 0, 0 );
	$default_pages = get_pages(
		array(
			'sort_order' => 'desc',
			'sort_column' => 'post_date',
			'number' => $number,
		)
	);
	foreach ( $default_pages as $key => $page ) {
		if ( ! empty ( $page->ID ) ) {
			$block_ids[$key+1] = $page->ID;
		}
		else {
			$block_ids[$key+1] = 0;
		}
	}
	return $block_ids;
} //fluida_get_default_pages()
