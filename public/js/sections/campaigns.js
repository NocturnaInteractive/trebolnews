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
		var libraryImages = [];
		var windowOrigin = window.top.location.origin + '/';
		$.get('/library/folders/images/all', function(data){
			libraryImages.push(['Imagen Actual', '']);
			data.forEach(function(item, index){
				libraryImages.push([item.nombre, windowOrigin + item.archivo]);
			});
		});
		$('#txt_campania').ckeditor({
			height: '296px'
		});
		CKEDITOR.on('dialogDefinition', function( ev ) {
		    // Take the dialog window name and its definition from the event data.
		    var dialogName = ev.data.name;
		    var dialogDefinition = ev.data.definition;

		    if ( dialogName == 'image' ) {
		    	var lastImage = null;
		        // memo: dialogDefinition.onShow = ... throws JS error (C.preview not defined) 
         
		        // Get a reference to the 'Link Info' tab. 
		        var infoTab = dialogDefinition.getContents('info'); 
		        // Remove unnecessary widgets 
		        infoTab.remove( 'ratioLock' ); 
		        //infoTab.remove( 'txtHeight' );
		        //infoTab.remove( 'txtWidth' ); 
		        infoTab.remove( 'txtAlt' );
		        infoTab.remove( 'txtBorder'); 
		        infoTab.remove( 'txtHSpace'); 
		        infoTab.remove( 'txtVSpace'); 
		        infoTab.remove( 'cmbAlign' ); 
	            infoTab.add( {
                    id : 'library',
                    type : 'select',
                    label : 'Imagenes de mi Libreria',
                    'default':'',
                    items: libraryImages,
                    onChange:function(){
                    	var d = CKEDITOR.dialog.getCurrent();
                    	lastImage = lastImage || d.getValueOf('info','txtUrl');
                    	
                    	//if selected option is different from default placeholder
                    	if(this.items[0][1] != this.getValue()) {
	                    	d.setValueOf("info", "txtUrl", this.getValue());
                    	} else {
	                    	d.setValueOf("info", "txtUrl", lastImage);	
                    	}
                    } 
                });


		        dialogDefinition.onLoad = function () { 
		            var dialog = CKEDITOR.dialog.getCurrent(); 
		             
		            var elem = dialog.getContentElement('info','htmlPreview');     
		            //elem.getElement().hide(); 
		         
		            dialog.hidePage( 'Link' ); 
		            dialog.hidePage( 'advanced' ); 
		            dialog.hidePage( 'Upload' ); // works now (CKEditor v3.6.4) 
		            this.selectPage('info'); 

		             
		            /*var uploadTab = dialogDefinition.getContents('Upload'); 
		            var uploadButton = uploadTab.get('uploadButton'); 
		            uploadButton['filebrowser']['onSelect'] = function( fileUrl, errorMessage ) { 
		                //$("input.cke_dialog_ui_input_text").val(fileUrl); 
		                dialog.getContentElement('info', 'txtUrl').setValue(fileUrl); 
		                //$(".cke_dialog_ui_button_ok span").click(); 
		            }*/ 
		        }; 
		    }
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
					$('#template-gallery').slideUp(200);
				}
			});

		});

		$('#open-template-gallery-button').on('click', function(){
			$('#template-gallery').slideDown(200);
		});

		$('.template-view-button').on('click', function(e){
			e.preventDefault();
			var $this = $(this);

			var templatePreview = $('<div class="show-template"></div>')
					.append(
						$('<img>').attr('src',$this.attr('href'))
					).on('click', function(){
						$(this).fadeOut(200, function(){
							$(this).remove()
						});
					});

			templatePreview.css('top',$(document).scrollTop());

			$('body').append(templatePreview);

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


		if( $('#txt_campania').html() !== '' ){
			$('#template-gallery').hide();
		}
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

