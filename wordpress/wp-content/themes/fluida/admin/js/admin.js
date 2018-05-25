/**
 * Admin-side JS
 *
 * @package Fluida
 */

jQuery(document).ready(function() {

	/* Theme settings save */
	jQuery('#cryout-savesettings-button').on('click', function(e) {
		jQuery( "#cryout-settings-dialog" ).dialog({
		  modal: true,
		  minWidth: 600,
		  buttons: {
			'Close': function() {
			  jQuery( this ).dialog( "close" );
			}
		  }
		});
		jQuery('#cryout-themesettings-textarea').val(jQuery('#cryout-export input#cryout-themesettings').val());
		jQuery('#cryout-themesettings-textarea').prop('readonly',true);
		jQuery('#cryout-settings-dialog strong').hide();
		jQuery('#cryout-settings-dialog div.settings-error').remove();
		jQuery('#cryout-settings-dialog strong:nth-child(1)').show();
	});

	/* Theme settings load */
	jQuery('#cryout-loadsettings-button').on('click', function(e) {
		jQuery( '#cryout-themesettings-textarea' ).prop('readonly',false);
		jQuery( "#cryout-settings-dialog" ).dialog({
			modal: true,
			minWidth: 600,
			buttons: {
				'Load Settings': function() {
					theme_settings = encodeURIComponent(jQuery('#cryout-themesettings-textarea').val());
					nonce = jQuery('#cryout-settings-nonce').val();
					jQuery.post(ajaxurl, {
						action: 'cryout_loadsettings_action',
						cryout_settings_nonce: nonce,
						cryout_settings: theme_settings,
					}, function(response) {
						if (response=='OK') {
							jQuery('#cryout-settings-dialog div.settings-error').remove();
							window.location.search += '&settings-loaded=true';
							//window.location = '?page=about-fluida-theme&settings-loaded=true';
						} else {
							jQuery('#cryout-settings-dialog div.settings-error').remove();
							jQuery('#cryout-themesettings-textarea').after('<div class="settings-error">' + response + '</div>');
						}
					})
				}
			}
		});
		jQuery('#cryout-themesettings-textarea').val('');
		jQuery('#cryout-settings-dialog strong').hide();
		jQuery('#cryout-settings-dialog strong:nth-child(2)').show();
	});

	/* Latest News Content */
    var data = {
        action: 'cryout_feed_action',
    };
	jQuery.post(ajaxurl, data, function(response) {
		jQuery("#fluida-news .inside").html(response);
    });

	/* Confirm modal window on reset to defaults */
	jQuery('#cryout_reset_defaults').click (function() {
		if (!confirm(reset_confirmation)) { return false;}
	});

	jQuery("#cryout-themesettings-textarea").focus(function() {
	    var $this = jQuery(this);
	    $this.select();
		// document.execCommand("copy");

	    // Work around Chrome's little problem
	    $this.mouseup(function() {
	        // Prevent further mouseup intervention
	        $this.unbind("mouseup");
	        return false;
	    });
	});

});/* document.ready */

/* FIN */
