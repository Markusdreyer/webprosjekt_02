/**
 * JS for Custom Customizer Controls
 *
 * @package Cryout Framework
 */

jQuery(window).load(function(){

	var settings = [];

	setTimeout(function() {
	// wait for page load

		// Slider Control
		jQuery('input[type="number"].slider').each(function() {
			settings = [
				jQuery(this).attr('name'),
				jQuery(this).val(),
				jQuery(this).attr('min'),
				jQuery(this).attr('max'),
				jQuery(this).attr('step')
			]
			jQuery(this).hide();
			var the_input = this;

			jQuery(this).next('div.slider').slider({
				value: parseInt( settings[1] ),
				min: parseInt( settings[2] ),
				max: parseInt( settings[3] ),
				step: parseInt( settings[4] ),
				slide: function( event, ui){
					jQuery(the_input).val( ui.value ).change();
					jQuery(this).parent().find('.value').text( ui.value );
				}
			});

		}); // each

		// SliderTwo Control
		jQuery('input[type="number"].slidertwo').each(function() {
			settings = [
				jQuery(this).attr('name'),
				jQuery(this).val(),
				jQuery(this).attr('min'),
				jQuery(this).attr('max'),
				jQuery(this).attr('step'),
				jQuery(this).attr('size')
			]
			jQuery(this).hide();
			var the_input = this;

			jQuery(this).next('div.slidertwo').slider({
				value: parseInt( settings[1] ),
				min: parseInt( settings[2] ),
				max: parseInt( settings[3] ),
				step: parseInt( settings[4] ),
				slide: function( event, ui){
					jQuery(the_input).val( ui.value ).change();
					jQuery(this).parent().find('.value').text( ui.value );
					jQuery(this).parent().find('.value2').text( settings[5] - parseInt(ui.value) );
				}
			});

		}); // each
		
		// Sortable control
		jQuery('.customize-control-sortable .sortable-row').sortable({
			update: function( event, ui ) {
				var order = new Array();
				jQuery(this).children('li').each(function() {
					order.push(jQuery(this).attr("id"));
				});
				jQuery(this).parent().children('.the_sorted').val(order.join()).change();
			}
		}); // sortable

	}); // setTimeout


	// RadioImage Control
    jQuery( '.customize-control-radio-image .buttonset' ).buttonset();

}); // load
