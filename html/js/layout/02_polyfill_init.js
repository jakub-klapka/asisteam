/* global jQuery, LumiPolyfill, Modernizr */
(function ($) {

	$(document).ready(function(){

		if( Modernizr.flexbox === false ) {
			$('head').append('<link rel="stylesheet" href="' + LumiPolyfill.theme_path + 'css/no-flexbox.css">');
		}

	});

})(jQuery);