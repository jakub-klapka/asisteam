/* global jQuery */
(function ($) {

	$(document).ready(function () {

		//Form focus handling
		$('.calculator form select').each(function() {
			var t = $(this),
				style_box = t.parent('.style_wrap');
			t.on('focus', function () {
				style_box.addClass('focus');
			});
			t.on('blur', function () {
				style_box.removeClass('focus');
			});


		});

	});

})(jQuery);