/* global jQuery */
(function ($) {

	var FeaturedItems = {

		init: function () {

			this.anchors = $('.featured_nav a');
			this.targets = $('.featured_item');
			this.slide_speed = 500;

			this.bindEvents();
			this.addCloseButton();
		},

		bindEvents: function() {
			var t = this;
			this.anchors.on('click', function(evt) {
				evt.preventDefault();
				t.clicked($(this));
			});
		},

		clicked: function(el) {

			var cont = this.closeAll(el);

			if( cont === false ) {
				return;
			}

			//open
			el.addClass('active');
			this.targets.filter('[data-item=' + el.data('target') + ']').addClass('open').slideDown(this.slide_speed);

		},

		closeAll: function(el) {

			//close all open
			this.targets.filter('.open').removeClass('open').slideUp(this.slide_speed);

			//click on active
			if( el !== false && el.hasClass('active') ) {
				this.anchors.filter('.active').removeClass('active');
				return false;
			}

			this.anchors.filter('.active').removeClass('active');

		},

		addCloseButton: function() {

			var button = $('<button type="button" class="close">Zavřít</button>');
			this.targets.append( button );
			$('button.close').on('click', $.proxy(this.closeAll, this, false));

		}
	};

	$(document).ready(function () {
		FeaturedItems.init();
	});

})(jQuery);