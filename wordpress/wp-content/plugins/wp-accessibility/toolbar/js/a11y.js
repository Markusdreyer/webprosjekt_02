/*
 * Chris Rodriguez
 * chris@inathought.com
 */

// Cookie handler, non-$ style
var is_visible = 0;
function createCookie(name, value, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toGMTString();
	} else {
		var expires = '';
	}
	
	document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	
	return null;
}

function eraseCookie(name) {
	createCookie(name, "");
}

( function( $ ) {
	// Saturation handler
	if (readCookie('a11y-desaturated')) {
		$('body').addClass('desaturated');
		$('#is_normal_color').attr('id', 'is_grayscale').attr('aria-pressed', true).addClass('active');
	}
	
	if (readCookie('a11y-high-contrast')) {
		$('body').addClass('contrast');
		$('head').append($("<link href='" + a11y_stylesheet_path + "' id='highContrastStylesheet' rel='stylesheet' type='text/css' />"));
		$('#is_normal_contrast').attr('id', 'is_high_contrast').attr('aria-pressed', true).addClass('active');
		$('.a11y-toolbar ul li a i').addClass('icon-white');
	}


	if (readCookie('a11y-larger-fontsize')) {
		$('html').addClass('fontsize');
		$('#is_normal_fontsize').attr('id', 'is_large_fontsize').attr('aria-pressed', true).addClass('active');
	}

	/*
	if(readCookie('a11y-hidden')) {
		$('a11y-toolbar').addClass('hidden');
		$('#is_visible').attr('id', 'is_hidden').attr('aria-pressed', true).addClass('active');	
	}*/

	if(readCookie('a11y-hidden')) {
		var toolbar = document.getElementsByClassName('a11y-toolbar-list-item'); {
			for (var i = 1; i < 3; i++) {
				toolbar[i].style.visibility = "hidden";
			}
		}
	}

	$('.toggle-hide').on('click', function (e) {
		if (!is_visible) {
			var toolbar = document.getElementsByClassName('a11y-toolbar-list-item'); {
				for (var i = 1; i < 3; i++) {
					toolbar[i].style.visibility = "hidden";
				}
			}
			this.style['top'] = '88vh';
			this.style['background-image'] = 'url:"/Applications/MAMP/htdocs/wordpress/wp-content/plugins/wp-accessibility/toolbar/fonts/css/PNG/icon-hide.png"" ';
			is_visible = 1;
			createCookie('a11y-hidden', '1');
		} else {
			var toolbar = document.getElementsByClassName('a11y-toolbar-list-item'); {
				for (var i = 1; i < 3; i++) {
					toolbar[i].style.visibility = "visible";
				}
			}
			this.style['top'] = '0';
			is_visible = 0;
			eraseCookie('a11y-hidden');
		}
		
	});


	/*
	$('.toggle-hide').on('click', function (e) {
		if ($(this).attr('id') == "is_visible") {
			$('div').remove('a11y-toolbar-list');
			$(this).attr('id', 'is_hidden').attr('aria-pressed', true).addClass('active');
			createCookie('a11y-hidden', '1');
		} else {
			$(this).removeClass('hidden');
			$(this).attr('id', 'is_visible').attr('aria-pressed', false).removeClass('active');
			eraseCookie('a11y-hidden');
		}
		return false;
	});*/

	$('.toggle-grayscale').on('click', function (e) {
		if ($(this).attr('id') == "is_normal_color") {
			$('body').addClass('desaturated');
			$(this).attr('id', 'is_grayscale').attr('aria-pressed', true).addClass('active');
			createCookie('a11y-desaturated', '1');
		} else {
			$('body').removeClass('desaturated');
			$(this).attr('id', 'is_normal_color').attr('aria-pressed', false).removeClass('active');
			eraseCookie('a11y-desaturated');
			
		}
		
		return false;
	});

	$('.toggle-contrast').on('click', function (e) {
		if ($(this).attr('id') == "is_normal_contrast") {
			$('head').append($("<link href='" + a11y_stylesheet_path + "' id='highContrastStylesheet' rel='stylesheet' type='text/css' />"));
			$('body').addClass('contrast');
			$(this).attr('id', 'is_high_contrast').attr('aria-pressed', true).addClass('active');
			createCookie('a11y-high-contrast', '1');
			eraseCookie('a11y-hidden');
		} else {
			$('#highContrastStylesheet').remove();
			$('body').removeClass('contrast');
			$(this).attr('id', 'is_normal_contrast').attr('aria-pressed', false).removeClass('active');
			eraseCookie('a11y-high-contrast');
			
		}
		
		return false;
	});

	$('.toggle-fontsize').on('click', function (e) {
		if ($(this).attr('id') == "is_normal_fontsize") {
			$('html').addClass('fontsize');
			$(this).attr('id', 'is_large_fontsize').attr('aria-pressed', true).addClass('active');
			createCookie('a11y-larger-fontsize', '1');
		} else {
			$('html').removeClass('fontsize');
			$(this).attr('id', 'is_normal_fontsize').attr('aria-pressed', false).removeClass('active');
			eraseCookie('a11y-larger-fontsize');
		}
		
		return false;
	});


	// Sets a -1 tabindex to ALL sections for .focus()-ing
	var sections = document.getElementsByTagName("section");
	for (var i = 0, max = sections.length; i < max; i++) {
		sections[i].setAttribute('tabindex', -1);
		sections[i].className += ' focusable';
	}
	
} )( jQuery );