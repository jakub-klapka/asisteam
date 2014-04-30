/* global jQuery, LumiSliderConfig */
(function($) {

	var LumiSlider = {

		config: {
			slider_width: 650,
			slider_timeout: 6000
		},

		init: function(el, config) {
			$.extend( this.config, config );

			this.slider = el;
			this.wrapper = el.find('.wrapper');
			this.items = el.find('.slider_item');
			this.current = 0; //0-based
			this.number_of_images = this.items.length - 1; //0-based
			this.buttons = this.slider.find('.controls button');

			this.wrapper.css('width', this.config.slider_width * ( this.number_of_images + 2 ) );

			this.bindEvents();
		},

		bindEvents: function() {

			$(window).load($.proxy(this.loadPlaceheldImages, this));
			$(window).load($.proxy(this.fireTimeout, this));

			var self = this;
			this.buttons.on('click', function() {
				self.moveTo(self.buttons.index(this));
				clearInterval( self.interval );
			});

		},

		/**
		 * @param index 0-based
		 */
		moveTo: function(index) {
			this.current = index;

			//animate
			var final_margin = - ( this.config.slider_width * index );
			this.wrapper.transition({'margin-left': final_margin + 'px'}, 1000);

			//set aria hidden
			this.items.filter(':not(:eq(' + index + '))').attr('aria-hidden', true);
			this.items.eq(index).attr('aria-hidden', false);

			//set active control
			this.buttons.removeClass('active');
			this.buttons.eq(index).addClass('active');
		},

		fireTimeout: function() {
			this.interval = setInterval($.proxy(this.moveByOne, this), this.config.slider_timeout );
		},

		moveByOne: function() {
			if( this.current < this.number_of_images ) {
				this.moveTo( this.current + 1 );
			} else {
				this.moveTo( 0 );
			}
		},

		loadPlaceheldImages: function() {
			var placeholders = this.slider.find('.image_placeholder');
			placeholders.each(function() {
				var t = $(this),
					src = t.data('src'),
					alt = t.data('alt'),
					img = $('<img />').attr({'src': src, 'alt': alt});
				t.after(img);
				t.remove();
			});
		}

	};

	$(document).ready(function(){
		var config = (typeof LumiSliderConfig === 'object' ) ? LumiSliderConfig : {};
		LumiSlider.init($('#lumi_slider'), config);
	});

})(jQuery);