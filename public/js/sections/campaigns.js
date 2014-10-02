$(function() {

	_events = {
		saveHandler: function(e){
			e.preventDefault();
		    e.stopImmediatePropagation();

		    var $this = $(this);

		    if($('#frm_campania').length > 0){
		    	// step 3 and 4
		    	$('#frm_campania').ajaxSubmit({
			        data: {
			            y: 		$this.attr('y'),
			            paso: 	$('#frm_campania').data('step')
			        },
			        success: function(data) {
			            if(data.status == 'ok') {
			                window.location = $this.attr('href');
			            } else {
			                notys(data.validator);
			            }
			        }
			    });
		    }else{
		    	//step 5
		    	$.ajax({
					type: 'post',
					url:  $(this).parents('[ajax]').attr('ajax'),
					data: {
						y: $this.attr('y')
					},
					success: function(data) {
						if(data.status == 'ok') {
							window.location = $this.attr('href');
						} else {
							notys(data.validator);
						}
					}
				});
		    }
		    
		}
	};

	/*****************
		STEP 3
	*****************/
	if( $('.step3').length > 0 ){
		$('.btn_guardar').on('click', _events.saveHandler);


		$('input[envio]').on('click', function(e) {
		    $('#envio').val($(this).attr('envio'));
		});

		/*
		$( ".step3 #datepicker" ).datepicker({
		    prevText: '<',
		    nextText: '>',
		    dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
		    monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		    monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		    dateFormat: 'dd/mm/yy'
		});
		*/

		/*
		$('.step3 .timepicker').timepicker({
		    hourText: 'Hora',
		    minuteText: 'Minutos'
		});
		*/
	}

	

	/*****************
		STEP 4
	*****************/

	if( $('.step4').length > 0 ){
		$('#txt_campania').ckeditor({
			height: '296px'
		});

		$('.btn_guardar').on('click', _events.saveHandler);
	}

	


	/****************
		STEP 5
	****************/
	if( $('.step5').length > 0 ){
		$('.btn_guardar').on('click', _events.saveHandler);


		$('#redes_seleccionadas').children().each(function(i, e) {
			$('#resumenredes_clasica [red="' + $(e).val() + '"]').removeClass('noelegidored');
		});
	}

	
});

