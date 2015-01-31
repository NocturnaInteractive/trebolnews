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
			            	if(typeof(data.validator) !== "undefined")
			                	notys(data.validator);
			                else
			                	notys(data.status);
			            }
			        }
			    });
		    }else{
		    	//step 5
		    	$.ajax({
					type: 'post',
					url:  $(this).parents('[ajax]').attr('ajax'),
					data: {
						y: $this.attr('y'),
						emailtest: $('#email-test').val()
					},
					success: function(data) {
						if(data.status == 'ok') {
							if($this.attr('href')){
								window.location = $this.attr('href');
							}else if($this.attr('y') == 'test'){
								alert('¡Email de Prueba Enviado!');
							}
						} else {
							if(typeof(data.validator) !== "undefined")
			                	notys(data.validator);
			                else
			                	console.log("Error sending email");
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

		//disable all social links
		$('#info_agregar_redes input[type=text]').each(function(n,o){
			$this = $(o);
			checkSocialLinks($this);
		});
		//social link enable event
		$('#info_agregar_redes').on('keyup','input[type=text]',function(e){
			$this = $(e.target);
			checkSocialLinks($this);
		});

		function checkSocialLinks(inputElement){
			$this = $(inputElement);
			if($this.val()==""){
				$this.siblings().first().css({ opacity: 0.3 });
			}else{
				$this.siblings().first().css({ opacity: 1 });
			}
		}
	}

	

	/*****************
		STEP 4
	*****************/

	if( $('.step4').length > 0 ){
		$('#txt_campania').ckeditor({
			height: '296px'
		});

		$('.btn_guardar').on('click', _events.saveHandler);

		$('#template-gallery').on('click','.template',function(e){
			e.preventDefault();
			e.stopPropagation();
			var $this=$(this);
			var templateId = $this.data('template');

			$this.find('input').prop("checked", true );

			$.ajax({
				type: 'get',
				url:  '/templates/' + $this.data('template'),
				success: function(data) {
					CKEDITOR.instances.txt_campania.setData(data.content);
				}
			});

		});

		$('#fetch-url-container').on('click','#fetch-url-button',function(e){
			$.ajax({
				type: 'post',
				data: {url: $('#fetch-url-container #fetch-url-input').val()},
				url:  '/templates/fetch/',
				success: function(data) {
					CKEDITOR.instances.txt_campania.setData(data);
				}
			});
		});
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

