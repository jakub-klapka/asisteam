/* global jQuery */
(function($){

	var LumiLightboxForm = {

		init: function() {

			this.form = $('#lightbox');
			this.overlay = $('#lightbox_overlay');

			this.open_button = $('.main_content_wrap #calculator button[type=submit], .banner #calculator button[type=submit]');

			$('a[data-close-lightbox]').click(function(evt){
				evt.preventDefault();
				parent.LumiLightboxForm.close_lightbox();
			});

			if( this.open_button.length > 0 ) {
				//on home page
				this.bindEvents();
			}

			if( this.open_button.length <= 0 ) {
				//in lightbox
				this.current_iframe_hash = window.location.hash;
				this.bindLightboxEvents();
			}

		},

		bindEvents: function(){
			this.open_button.on('click', $.proxy(this.open_lightbox, this));
			this.overlay.on('click', $.proxy(this.close_lightbox, this));

		},

		open_lightbox: function(evt) {
			evt.preventDefault();
			this.form.fadeIn(500);
			this.overlay.fadeIn(500);
		},

		close_lightbox: function () {
			this.form.fadeOut(500);
			this.overlay.fadeOut(500);
		},

		bindLightboxEvents: function() {
			setInterval($.proxy( this.checkForURLChange, this ), 1000 );
		},

		checkForURLChange: function() {

			if( this.current_iframe_hash !== window.location.hash ) {
				this.current_iframe_hash = window.location.hash;
				//set new values
				var matches = window.location.hash.match( /doba_splaceni=(.+?)\&vyse_uveru=(.+?)$/),
					doba_splaceni = matches[1],
					vyse_uveru = matches[2];
				$('select[name=vyse_uveru]').val(vyse_uveru).change();
				$('select[name=vyse_platby_v_mesicich]').val(doba_splaceni).change();


			}
		}

	};

	$(document).ready(function(){
		window.LumiLightboxForm = LumiLightboxForm;
		window.LumiLightboxForm.init();
	});

})(jQuery);