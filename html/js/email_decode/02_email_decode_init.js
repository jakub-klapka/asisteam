/* global jQuery */
(function ($) {

	$(document).ready(function(){

		$('.email_decode').each(function(){
			var el = $(this);
			el.rot13().attr('href', $.rot13(el.attr('href')));
		});

	});

})(jQuery);