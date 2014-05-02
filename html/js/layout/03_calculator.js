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

		//Terms popup
		$('.calculator .open_terms').on('click', function(evt){
			evt.preventDefault();
			window.open($(this).attr('href'),'title', 'width=800, height=700,scrollbars=1,menubar=no,status=no,toolbar=no');
		});

	});

})(jQuery);