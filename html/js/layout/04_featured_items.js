/* global jQuery */
(function ($) {

	var FeaturedItems = {

		init: function () {

			this.anchors = $('.featured_nav a');
			this.target = $('.featured_item');
			this.spinner = $('.featured_nav__loader');
			this.slide_speed = 500;
			this.current_el = false;

			this.bindEvents();
			//this.addCloseButton();
		},

		bindEvents: function() {
			var t = this;
			this.anchors.on('click', function(evt) {
				evt.preventDefault();
				t.clicked($(this));
			});
		},

		clicked: function(el) {

			if( el.is( this.current_el  ) ) {
				this.current_el = false;
				this.closeAll();
				return;
			}
			this.current_el = el;

			var closeDefer = $.Deferred();
			this.closeAll( closeDefer );

			var t = this;
			closeDefer.done( function () {

				//open
				el.addClass('active');

				t.spinner.velocity( 'fadeIn', { duration: 200 } );

				var xhr = $.ajax( {
					dataType: 'json',
					url: el.data('target')
				} );

				xhr.done( function( data ) {

					t.spinner.velocity( 'fadeOut', { duration: 200 } );
					t.target.html( data.data );
					t.addCloseButton();
					t.target.velocity( 'slideDown', { duration: 300 } );

				} );


			} );

		},

		closeAll: function( closeDefer ) {
			closeDefer = closeDefer || $.Deferred();

			if( !this.target.is( ':visible' ) ) {
				closeDefer.resolve();
				return;
			}

			//close all open
			this.target.velocity( 'slideUp', { duration: 300, complete: function() {
				closeDefer.resolve();
			} } );
			this.anchors.filter('.active').removeClass('active');

		},

		addCloseButton: function() {

			var button = $('<button type="button" class="close">Zavřít</button>');
			this.target.append( button );
			var t = this;
			$('button.close').on('click', function() {
				t.current_el = false;
				t.closeAll();
			});

		}
	};

	$(document).ready(function () {
		FeaturedItems.init();
	});

})(jQuery);