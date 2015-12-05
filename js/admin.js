(function( $ ) {
	'use strict';

	jQuery(document).ready(function($){
		// Color picker.
		$( 'input.select-color' ).each( function() {
		    $( this ).wpColorPicker();
		});

	});

})( jQuery );
