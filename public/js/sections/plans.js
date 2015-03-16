var Currency = function (code, name, symbol, ratio){
	this.code = code;
	this.name = name;
	this.symbol = symbol;

	if(ratio)
		this.ratio = ratio;
	else
		this.ratio = null;
};

var PlanServices = {
	currencyList: [],
	selectedCurrency: null,
	selectedPlan: null,
	selectedCombo: 1,
	taxApply: false,
	comboDiscounts: [0,10,25,35],

	loadCurrencies: function (){
		PlanServices.currencyList.push(new Currency('USD','Dólares Estadounidenses', 'US$', 1));
		PlanServices.currencyList.push(new Currency('ARS','Pesos Argentinos', 'AR$'));
		PlanServices.currencyList.push(new Currency('CLP','Pesos Chilenos', 'CH$'));
		PlanServices.currencyList.push(new Currency('UYU','Pesos Uruguayos', 'UY$'));
	},
	
	setCurrencies: function (){
		PlanServices.taxApply = false;
		PlanServices.loadCurrencies();
		PlanServices.selectedCurrency = PlanServices.currencyList[0];
		PlanServices.currencyList.forEach(function (element, index){
			if (!element.ratio)
				PlanServices.getCurrencyRatio(element);

			$('#currency-dropdown').append(
				$('<option>').attr('value',element.code).html(element.name)
			);
		});
	},

	getCurrencyRatio: function (currency){
		$.ajax({
	        url: 'https://api.mercadolibre.com/currency_conversions/search',
	        method: 'get',
	        dataType: "jsonp",
	        data: {
	            from: 'USD',
	            to: currency.code
	        },
	        success: function(data) {
	            currency.ratio = data[2].ratio;
	        }
	    });
	},

	findPlan: function (id){
		var plan = null;
		planList.forEach(function (element, index){
			if (element.id == id){
				plan = element;
			}
		});

		return plan;
	},

	findCurrency: function (code){
		var currency = null;
		PlanServices.currencyList.forEach(function (element, index){
			if (element.code == code){
				currency = element;
			}
		});
		return currency;
	},

	currencyDropdownHandler: function (e){
		var currencyCode = e.currentTarget.value;
		PlanServices.selectedCurrency = PlanServices.findCurrency(currencyCode);
		
		$('.plan').each(function (index,element){
			var $element = $(element);
			var planId = $element.find('input').data('plan');
			var plan = PlanServices.findPlan(planId);
			$element.find('.moneda').html(PlanServices.selectedCurrency.symbol);
			$element.find('.price').html((parseFloat(plan.value) * PlanServices.selectedCurrency.ratio).toFixed(2));
		});
	},

	planClickHandler: function (e){
		e.preventDefault();
		PlanServices.taxApply = false;

		// get the input element and check it
	    $('.plan').find('input').prop('checked', '');
	    var $this = $(this);
	    var input;
	    if ($this.data('plan'))
	        input = $this;
	    else
	        input = $this.find('input');
	    input.prop('checked', 'checked');
	    //end get input element and checkit


	    PlanServices.selectedPlan = PlanServices.findPlan(input.data('plan'));
	    var plan = PlanServices.selectedPlan;

	    if (plan){

	    	PlanServices.setPrices();

	    	$('.formasdepago').fadeIn();
	    	$('.solo-suscriptor').hide();
	    	$('.solo-envio').hide();

	    	$('.plan-name').html(plan.name);

	    	

	    	PlanServices.selectedCombo = 1;
	    	if (plan.isSuscription){
		    	$('.solo-suscriptor').show();
		    } else {
		    	$('.solo-envio').show();
		    	$('.seleccion-meses').hide();
		    }	

	    	PlanServices.setCheckoutButton();
	    } else {
			$('.formasdepago').fadeOut();
	    }
	    
	},

	setCheckoutButton: function(){
		$('#comprar').attr('href', '/checkout/' + PlanServices.selectedPlan.id + '/' + PlanServices.selectedCombo + '/');
	},

	setPrices: function (){
		var plan = PlanServices.selectedPlan;
		var price = (parseFloat(plan.value) * PlanServices.selectedCurrency.ratio * PlanServices.selectedCombo);
    	var tax = price * 0.21;
    	var comboIndex = $('#cantidad-meses-'+PlanServices.selectedCombo).data('index');
    	var discount = (plan.isSuscription) ? price * (PlanServices.comboDiscounts[comboIndex]) / 100 : 0;
    	var total = price - discount;
    	var totaltax = price + tax - discount;
    	$('.plan-price').html(PlanServices.selectedCurrency.symbol + price.toFixed(2));
    	$('.plan-price-tax').html(PlanServices.selectedCurrency.symbol + tax.toFixed(2));
    	$('.plan-price-total').html(PlanServices.selectedCurrency.symbol + total.toFixed(2));
    	$('.plan-price-totaltax').html(PlanServices.selectedCurrency.symbol + totaltax.toFixed(2));
    	$('.plan-price-discount').html('-' + PlanServices.selectedCurrency.symbol + discount.toFixed(2));
    	if(discount > 0)
    		$('.discount-row').show();
    	else
    		$('.discount-row').hide();
	},

	buyButtonHandler: function (e){
		e.preventDefault();

	    var plan = PlanServices.selectedPlan;

	    if (confirm('Esta seguro que desea comprar \n' + plan.name)) {
	        window.top.location.href = $(e.target).attr('href');
	    }
	},

	sendButtonHandler: function (e){
		e.preventDefault();

	    var plan = PlanServices.selectedPlan;

	    if (confirm('Esta seguro que desea enviar la orden por \n' + plan.name)) {
	        $.post('/checkout/manual',{
	        	'planId': plan.id, 
	        	'months': PlanServices.selectedCombo, 
	        	'taxApply':  PlanServices.taxApply
	        });
	    }
	},

	paymentFormHandler: function (e){
		$('.transferencia-bancaria').hide();
		$('.comprar-envios-content').hide();
	    $('#comprar').hide();
	    $('#enviar').hide();

	    if (this.getAttribute('id') == 'transferencia-bancaria') {
	        $('.transferencia-bancaria').show();
	    	$('#enviar').show();

	    } else {
	        $('.transferencia-bancaria').fadeOut();
	        $('.comprar-envios-content').show();
	    	$('#comprar').show();
	    }
	    $(".select-forma-de-pago").removeClass('active');
	    if (this.checked) {
	        $(this).parent().addClass('active');
	    }

	    $('#select-tipo-factura .opciones-select').find('a').eq(0).trigger('click');
	},

	comboCheckboxHandler: function (e){
		var input = $(e.currentTarget).find('input');
		PlanServices.selectedCombo = parseInt(input.val());
		PlanServices.setPrices();
		PlanServices.setCheckoutButton();
	}

};



/////////////



$(".select-mes").click(PlanServices.comboCheckboxHandler);
$('#comprar').click(PlanServices.buyButtonHandler);
$('#enviar').click(PlanServices.sendButtonHandler);
$('.plan').click(PlanServices.planClickHandler);
$('#currency-dropdown').change(PlanServices.currencyDropdownHandler);
$(".select-forma-de-pago").find('input').change(PlanServices.paymentFormHandler);
PlanServices.setCurrencies();
$(document).tooltip({
    position: {
        my: "center bottom-10",
        at: "center top",
        using: function(position, feedback) {
            $(this).css(position);
            $("<div>")
                .addClass("arrow")
                .addClass(feedback.vertical)
                .addClass(feedback.horizontal)
                .appendTo(this);
        }
    }
});



////////////

$('#select-tipo-factura').find('a').click(function(e) {
    e.preventDefault();

});
$('#select-tipo-factura').find('.boton').hover(function(e) {
    $('#select-tipo-factura').find('.opciones-select').css('pointer-events', 'all');
});

$('#select-tipo-factura').find('.opciones-select').find('a').click(function(e) {
    e.preventDefault();
    PlanServices.taxApply = false;
    $('#select-tipo-factura').find('.boton').html($(this).html());
    $('#select-tipo-factura').find('.opciones-select').css('pointer-events', 'none');

    $('.' + this.getAttribute('tipo')).fadeIn();
    if (this.getAttribute('tipo') == 'consumidor-final') {
    	PlanServices.taxApply = true;
        $('.consumidor-final').show();
        $('.responsable-inscripto').hide();
        $('.detalle-factura').show();
    } else if (this.getAttribute('tipo') == 'responsable-inscripto') {
    	
        $('.consumidor-final').hide();
        $('.responsable-inscripto').show();
        $('.detalle-factura').show();
    }
});
