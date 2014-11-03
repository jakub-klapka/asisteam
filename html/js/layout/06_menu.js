/* global jQuery */
( function( $ ){

	$( function() {

		$( '.main_nav ul li:has(ul)' ).each( function() {

			var li = $( this ),
				ul = li.find( 'ul' );

			li.on( 'mouseenter', function() {
				ul.velocity('stop').velocity( 'fadeIn', { duration: 300 } );
			} );

			li.on( 'mouseleave', function() {
				ul.velocity('stop').velocity( 'fadeOut', { duration: 300 } );
			} );

		} );

	} );

} )( jQuery );