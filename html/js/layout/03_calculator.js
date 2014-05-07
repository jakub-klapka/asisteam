/* global jQuery, Calculator */
(function ($) {

	//AJAX calculation
	var LumiCalculator = {

		init: function (form) {

			this.form = form;
			this.section = $('.calculator');
			this.selects = form.find('select');
			this.vyse_uveru = this.selects.filter('[name=vyse_uveru]');
			this.doba_splaceni = this.selects.filter('[name=vyse_platby_v_mesicich]');
			this.splatka_el = $('#calculator_splatka');
			this.rpsn_el = $('#calculator_rpsn');
			this.current_xhr = false;

			this.bindEvents();

		},

		bindEvents: function () {
			this.selects.on('change', $.proxy(this.updateValues, this));
		},

		updateValues: function () {

			this.spinner(true);

			//Call app
			this.current_xhr = this.callApp( this.vyse_uveru.val(), this.doba_splaceni.val() );

			//Parse results
			var t = this;
			this.current_xhr.success(function( data, response, xhr ){
				//check, if we are completing last request
				if( t.current_xhr !== xhr ) {
					return;
				}

				if( data.error === true ) {
					console.log(data.message);
					t.setNewValues( '---', '---' );
					t.spinner(false);
				}

				//All went fine
				t.setNewValues( data.splatka, data.rpsn );
				t.spinner(false);
			});

			this.current_xhr.error(function() {
				t.setNewValues( '---', '---' );
				t.spinner(false);
			});

		},

		spinner: function (show) {
			if( show === true ) {
				this.section.addClass('loading');
			} else {
				this.section.removeClass('loading');
			}
		},

		callApp: function( vyse_uveru, doba_splaceni ) {

			return $.ajax({
				data: {
					vyse_uveru: vyse_uveru,
					doba_splaceni: doba_splaceni
				},
				dataType: 'json',
				url: Calculator.handler_url
			});
		},

		setNewValues: function( splatka, rpsn ) {
			var splatka_corrected = splatka.toString().replace( '.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, " ");
			var rpsn_corrected = rpsn.toString().replace( '.', ',');
			this.splatka_el.text(splatka_corrected);
			this.rpsn_el.text(rpsn_corrected);
		}

	};



	$(document).ready(function () {

		LumiCalculator.init($('#calculator'));

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