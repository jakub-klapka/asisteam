/* global jQuery, Calculator */
/*************************************/
/* RPSN kalkulator                   */
/* (c) 2014 FISCHER SOFTWARE, s.r.o. */
/* Vsechna prava vyhrazena           */
/* All right reserved                */
/*************************************/
setPPA(12);
function CalcRate(loanAmount, fee, regularPayment, numberOfPayment) {
	var p = getVal(loanAmount);
	var i = getVal(fee);
	var a = getVal(regularPayment);
	var n = Math.floor(getVal(numberOfPayment));
	var f = 0;
	var x = 1.0001;
	var fx = 0;
	var dx = 0;
	var z = 0;
	do {
		fx = i + a * (Math.pow(x, n + 1) - x) / (x - 1) + f * Math.pow(x, n) - p;
		dx = a * (n * Math.pow(x, n + 1) - (n + 1) * Math.pow(x, n) + 1) / Math.pow(x - 1, 2) + n * f * Math.pow(x, n - 1);
		z = fx / dx;
		x = x - z;
	} while (Math.abs(z) > 1e-9);
	r = 100 * (Math.pow(1 / x, m) - 1);
	return TwoDP(r);
}
function CalcPayment(loanAmount, interest, numberOfPayment) {
	var p = getVal(loanAmount);
	var i = getVal(interest);
	var n = Math.floor(getVal(numberOfPayment));
	var q = 1 + (i / 12);
	return TwoDP(p * (Math.pow(q, n) * (q - 1)) / (Math.pow(q, n) - 1));
}
function TwoDP(num) {
	if (isNaN(num)) num = "0";
	num = "$" + Math.round(100 * num) / 100;
	if (num.indexOf(".") == -1) num += ".00";
	if (num.indexOf(".") == num.length - 2) num += "0";
	return num.substring(1, num.length);
}
function OneDP(num) {
	if (isNaN(num)) num = "0";
	num = "$" + Math.round(10 * num) / 10;
	if (num.indexOf(".") == -1) num += ".0";
	return num.substring(1, num.length);
}
function getVal(x) {
	x = parseFloat(x);
	if (isNaN(x)) x = 0;
	return x;
}
function setPPA(x) {
	m = x;
}

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

			if( this.form.data('compute-rightaway') == true ) {
				this.updateValues();
			}

		},

		bindEvents: function () {
			this.selects.on('change', $.proxy(this.updateValues, this));
		},

		updateValues: function () {

			var doba_splaceni = this.doba_splaceni.val() * 12,
				splatka = CalcPayment( this.vyse_uveru.val(), 0.1399, doba_splaceni ),
				fee = ( this.vyse_uveru.val() <= 200000 ) ? 12500 : this.vyse_uveru.val() * 0.05,
				rpsn = CalcRate( this.vyse_uveru.val(), fee, splatka, doba_splaceni );

			this.setNewValues( splatka, rpsn );

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

		//Podminky
		$('input[data-required-checkbox]').each(function(){

			var form = $('#calculator'),
				t = $(this);
			form.on('submit', function(evt) {
				if( !t.is(':checked') ) {
					evt.preventDefault();
					if( t.data('osobni-udaje') == true ) {
						alert('Musíte souhlasit se zpracováním osobních údajů.');
					} else {
						alert('Musíte souhlasit s platebními podmínkami.');
					}
				}
			});

		});

	});

})(jQuery);