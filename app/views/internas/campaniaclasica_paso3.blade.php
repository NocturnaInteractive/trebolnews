<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TrebolNEWS / Configuraci&oacute;n</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>

		{{ HTML::style('internas/css/style.css') }}
		{{ HTML::script('js/jquery-1.11.0.min.js') }}
		{{ HTML::script('js/jquery.form.min.js') }}
		{{ HTML::script('js/jquery.noty.packaged.min.js') }}
		{{ HTML::script('js/jquery.ui.timepicker.js') }}
		{{ HTML::script('js/trebolnews.js') }}
		<!--chat-->
		{{ HTML::script('home/js/modernizr.custom.js') }}
		<!--chat-->

<!--mostrar y ocultar-->
<script type="text/javascript">
function ocultar_mostrar(div){
owurl7 = document.getElementById(div);
//Verificamos si la capa esta oculta o no y como resultado
//indicamos que cambie su valor distinto al actual. "none" o "block"
owurl7.style.display!='none'?
owurl7.style.display='none':owurl7.style.display='block';
}
</script>
<!--mostrar y ocultar-->

<!--fecha-->
	{{ HTML::style('internas/css/jquery.ui.datepicker.css') }}
	{{ HTML::style('internas/css/jquery.ui.theme.css') }}

	{{ HTML::script('js/jquery-ui-1.10.4.min.js') }}

<!--fecha-->
	<script>
	$(function() {
		$('.btn_guardar').one('click', guardar_handler);

		function guardar_handler(e) {
			e.preventDefault();
			e.stopImmediatePropagation();

			var boton = $(this);

			boton.on('click', function(e) {
				e.preventDefault();
			});

			$('#frm_campania').ajaxSubmit({
				data: {
					y: boton.attr('y'),
					paso: 3
				},
				success: function(data) {
					if(data.status == 'ok') {
						window.location = boton.attr('href');
					} else {
						notys(data.validator);
					}
				},
				complete: function() {
					$('.btn_guardar').one('click', guardar_handler);
				}
			});
		}

		$( "#datepicker" ).datepicker({
			prevText: '<',
			nextText: '>',
			dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
			monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
			monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
			dateFormat: 'dd/mm/yy'
		});

		$('[envio]').on('click', function(e) {
			$('#envio').val($(this).attr('envio'));
		});

		$('.activarydesactivar').on('click', function(e) {
			if($('#compartir').val() == 'on') {
				$('#compartir').val('');
			} else {
				$('#compartir').val('on');
			}
		});

		$('.timepicker').timepicker({
			hourText: 'Hora',
			minuteText: 'Minutos'
		});
	});
	</script>

	<script type="text/javascript">
	function marcar(source) {
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llam&oacute; (Marcar/Desmarcar Todos)
			}
		}
	}
	</script>

		<!--[if lt IE 9]>
			<style>
				.content{
					height: auto;
					margin: 0;
				}
				.content div {
					position: relative;
				}
			</style>
		<![endif]-->
	</head>
	<body>
	   <header>
	<div id="conheader">
	<h1><a href="{{ url('/') }}">TrebolNEWS</a></h1>

<div id="menu" class="cbp-fbscroller" >
	@include('menu')
	<input type="hidden" id="menu_principal" value="campanias" />
<div class="cleaner"></div>
</div>

	</div><!-- #BeginLibraryItem "/Library/chat.lbi" --><div id="chat">
	<button id="showRight">Chatee con un operador</button>

			<div class="cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
			<h3>Consultas</h3><div id="formah3"></div>
			<div class="cleaner"></div>

	   <form id="consultachat"  action="" method="post">

		<ul>
		<li  class="izq_consultachat" ><input name="nombre" type="text" placeholder="&nbsp;*Nombre:" /></li>

		<li class="der_consultachat" ><input name="apellido" type="text" placeholder="&nbsp;*Apellido:" /></li>

		<div class="cleaner"></div>

		<li class="izq_consultachat" ><input name="telefono" type="text" placeholder="Tel&eacute;fono:"  /></li>


		<li class="der_consultachat" ><input name="empresa" type="text" placeholder="Empresa:" /></li>

		<div class="cleaner"></div>

		<li class="email_chat"><input name="email" type="text" placeholder="&nbsp;*Email:"  /></li>


		<li><textarea name="comentario" placeholder="&nbsp;*Comentario:"></textarea></li>

		</ul>

		<p>*&nbsp;Campos obligatorios</p>

		<div id="botones_consultachat">
		<input class="btn"  id="borrar" type="reset" value="BORRAR" name="borrar" />
		<input type="button" value="ENVIAR" name="enviar" onClick="enviar(this.form)" id="saveForm" />
		<div class="cleaner"></div>
		</div><!--botones_consultachat-->
		</form>

		</div><!--cbp-spmenu-s2-->

	</div><!--chat--><!-- #EndLibraryItem --></header>
<div id="container">
	<section class="tabs">
		<div class="content">
			<h2>Configuraci&oacute;n</h2>
			<a id="volver" href="{{ URL::previous() }}"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
			<div class="infocont">
				<ul id="pasoscam">
					<li id="pasocam1">Paso 1<div class="linea"></div><div class="circulo"></div></li>
					<li class="separadorpasos"> <div class="separadorlinea"></div></li>
					<li id="pasocam2">Paso 2<div class="linea"></div><div class="circulo"></div></li>
					<li class="separadorpasos"> <div class="separadorlinea"></div></li>
					<li id="pasocam3">Paso 3<div class="linea"></div><div class="circulo pasosactivado"></div></li>
					<li class="separadorpasos"> <div class="separadorlinea"></div></li>
					<li id="pasocam4">Paso 4<div class="linea"></div><div class="circulo"></div></li>
					<li class="separadorpasos"> <div class="separadorlinea"></div></li>
					<li id="pasocam5">Paso 5<div class="linea"></div><div class="circulo"></div></li>
					<div class="cleaner"></div>
				</ul><!--pasoscam-->
				<form action="{{ action('CampaniaController@guardar_campania') }}" method="post" id="frm_campania">
				<div id="info_basica">
					<h3>Informaci&oacute;n B&aacute;sica</h3>
					<input type="text" class="text nomcam" 	name="campania:nombre" 		placeholder="Nombre de la Campa&ntilde;a" 	value="{{Session::get(campania.nombre)}}"		/>
					<input type="text" class="text" 		name="campania:asunto" 		placeholder="Asunto"						value="{{Session::get(campania.asunto)}}" 		/>
					<input type="text" class="text der" 	name="campania:remitente"   placeholder="Nombre del Remitente" 			value="{{Session::get(campania.remitente)}}"	/>
					<input type="text" class="text" 		name="campania:email" 		placeholder="Email del Remitente" 			value="{{Session::get(campania.email)}}"		/>
					<input type="text" class="text der" 	name="campania:respuesta" 	placeholder="Email de Respuesta" 			value="{{Session::get(campania.respuesta)}}"	/>
					<div class="cleaner"></div>
				</div><!--info_basica-->

				<div id="selecionar_suscriptores">
					<h3>Selecciona los destinatarios de la Campa&ntilde;a</h3>
					<div class="submenu">
						<input class="search" type="text" placeholder="BUSCAR" />
						<div class="cleaner"></div>
					</div><!--submenu-->
					<table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
						<tr class="primeralinea">
							<th scope="col" width="40px">
	<!--     <form class="checkbox">
		 <input type="checkbox"  id="checkbox1" name="" onclick="marcar(this)" />
		 <label for="checkbox1"></label>
		 </form>-->
							</th>
							<th scope="col" width="355px">Nombre de Lista</th>
							<th scope="col" width="250px">Fecha de Creaci&oacute;n
								<!-- <a href="#" class="flechatabla"></a> -->
							</th>
							<th scope="col" width="149px">Editado el</th>
							<th scope="col" width="140px">Suscriptores</th>
						</tr>
						@foreach($listas = Auth::user()->listas()->has('contactos', '>', '0')->get() as $lista)
						<tr>
							<td>
								<div class="checkbox">
								<input type="checkbox" id="{{ 'listas['.$lista->id.']' }}" name="campania:listas[]" value="{{ $lista->id }}" />
								<label for="{{ 'listas['.$lista->id.']' }}"></label>
								</div>
							</td>
							<td>{{ $lista->nombre }}</td>
							<td>{{ $lista->created_at->format('d/m/Y') }}</td>
							<td>{{ $lista->updated_at->format('d/m/Y') }}</td>
							<td>{{ count($lista->contactos) }}</td>
						</tr>
						@endforeach
						@if(count($listas) > 0)
						<input type="hidden" name="con_listas" value="on" />
						@else
						<tr>
							<td colspan="5">
								Todavía no has creado contactos en una lista de suscriptores
							</td>
						</tr>
						@endif
					</table>
				</div><!--selecionar_suscriptores-->

				<div id="configurar_redes_clasica">
					<h3>Configuraci&oacute;n de Redes Sociales</h3>
					<div id="agregar_redes_clasica">
						<input type="hidden" id="compartir" name="compartir" />
						<div id="mostrar_div">
							<span class="activarydesactivar btbmostrar_div" onclick="ocultar_mostrar('mostrar_div'); return false;">Activar Compartir en:</span>
							<div class="divparaocultar"></div>
						</div>

						<div id="info_agregar_redes">
							<a class="activarydesactivar" href="#" onclick="ocultar_mostrar('mostrar_div'); return false;">Desactivar Compartir en:</a>
							<div id="rede_iconos">
								<div class="iconosindividuales">
								<input type="checkbox" id="facebook_agregar_redes" name="campania:redes[]" value="facebook" />
								<label for="facebook_agregar_redes" id="label_facebook_agregar_redes"></label>
								</div>
								<div class="iconosindividuales">
								<input type="checkbox" id="twitter_agregar_redes" name="campania:redes[]" value="twitter" />
								<label for="twitter_agregar_redes" id="label_twitter_agregar_redes"></label>
								</div>
								<div class="iconosindividuales">
								<input type="checkbox" id="linkedin_agregar_redes" name="campania:redes[]" value="linkedin" />
								<label for="linkedin_agregar_redes" id="label_linkedin_agregar_redes"></label>
								</div>
								<div class="iconosindividuales">
								<input type="checkbox" id="google_agregar_redes" name="campania:redes[]" value="google" />
								<label for="google_agregar_redes" id="label_google_agregar_redes"></label>
								</div>
								<div class="iconosindividuales">
								<input type="checkbox" id="pinterest_agregar_redes" name="campania:redes[]" value="pinterest" />
								<label for="pinterest_agregar_redes" id="label_pinterest_agregar_redes"></label>
								</div>
								<div class="iconosindividuales">
								<input type="checkbox" id="blogger_agregar_redes" name="campania:redes[]" value="blogger" />
								<label for="blogger_agregar_redes" id="label_blogger_agregar_redes"></label>
								</div>
								<div class="iconosindividuales">
								<input type="checkbox" id="meneame_agregar_redes" name="campania:redes[]" value="meneame" />
								<label for="meneame_agregar_redes" id="label_meneame_agregar_redes"></label>
								</div>
								<div class="iconosindividuales">
								<input type="checkbox" id="tumblr_agregar_redes" name="campania:redes[]" value="tumblr" />
								<label for="tumblr_agregar_redes" id="label_tumblr_agregar_redes"></label>
								</div>
								<div class="iconosindividuales">
								<input type="checkbox" id="reddit_agregar_redes" name="campania:redes[]" value="reddit" />
								<label for="reddit_agregar_redes" id="label_reddit_agregar_redes"></label>
								</div>
								<div class="iconosindividuales">
								<input type="checkbox" id="digg_agregar_redes" name="campania:redes[]" value="digg" />
								<label for="digg_agregar_redes" id="label_digg_agregar_redes"></label>
								</div>
								<div class="iconosindividuales checkbox_delicious">
								<input type="checkbox" id="delicious_agregar_redes" name="campania:redes[]" value="delicious" />
								<label for="delicious_agregar_redes" id="label_delicious_agregar_redes"></label>
								</div>
								<div class="cleaner"></div>
							</div>
						</div>
					</div><!--fin agregar_redes-->

					<div class="cleaner"></div>
				</div><!--fin configurar_redes-->

				<div id="configurar_envio">
					<h3>Configurar Env&iacute;o</h3>
					<div id="pestanias_envio">
						<input type="hidden" id="envio" name="campania:envio" value="inmediato" />
						<input id="enviotab-1" type="radio" name="radio-set" class="tab-selector-1" envio="inmediato" checked="checked" />
						<label for="enviotab-1" class="envio-label-1">
							<img src="{{ asset('internas/imagenes/inmediato_clasico.png') }}" width="107" height="100" alt="envio inmediato">
							<h4>Env&iacute;o Inmediato</h4>
							<p>La Campa&ntilde;a se enviar&aacute; al momento en el que hagas  click en enviar.</p>
							<div class="cleaner"></div>
						</label>

						<input id="enviotab-2" type="radio" name="radio-set" class="tab-selector-2" envio="programado" />
						<label for="enviotab-2" class="envio-label-2">
							<img src="{{ asset('internas/imagenes/programar_clasico.png') }}" width="107" height="100" alt="envio programado">
							<h4>Entrega Programada</h4>
							<p>La Campa&ntilde;a se enviar&aacute; en la fecha y hora que selecciones.</p>
							<div class="cleaner"></div>
						</label>
						<div class="clear-shadow"></div>

						<div class="enviocontent">
							<div class="content-1">
								<div id="separador_inmediato">
									<img src="{{ asset('internas/imagenes/separador.png') }}" width="25" height="20">
								</div>
								<div class="configuracionenvio_mensaje">
									<div class="checkbox">
										<input id="checkbox5" type="checkbox" checked="checked" name="campania:notificacion">
										<label for="checkbox5"></label>
									</div>
									<p>Deseo recibir una notificaci&oacute;n cuando la Campa&ntilde;a haya sido enviada.</p>
									<div class="cleaner"></div>
								</div><!--fin configuracionenvio_mensaje-->
							</div><!--fin content-1-->
							<div class="content-2">
								<div id="separador_programada">
									<img src="{{ asset('internas/imagenes/separador.png') }}" width="25" height="20">
								</div>
								<div id="programar_envio">
									<div id="programar_fecha">
										<p class="titulo_envio">Fecha:</p>
										<div id="fecha-form">
											<input type="text" id="datepicker" placeholder="DD/MM/AAAA" name="fecha" />
										</div>
									</div><!--fin programar_fecha-->
									<div id="programar_horario">
										<p class="titulo_envio">Hora:</p>
										<div id="horarioforma">
											<input name="hora" type="text" placeholder="00:00" class="timepicker" style="width: 178px;" />
											<!-- <input type="text" placeholder="00" /> -->
										</div>
										<!-- <select id="hora" SIZE="1">
											<option value="am" selected="1">AM</option>
											<option value="pm">PM</option>
										</select> -->
									</div><!--programar_horario-->
									<div id="zona_horaria-div">
										<p class="titulo_envio">Zona Horaria:</p>
										<select id="zona_horaria" SIZE="1">
											<option value="" selected="1">ZONA HORARIA</option>
											<option value="">(GMT-12:00) International Date Line West</option>
											<option value="">(GMT-11:00) Midway Island, Samoa</option>
											<option value="">(GMT-10:00) Hawaii</option>
											<option value="">(GMT-09:00) Alaska</option>
											<option value="">(GMT-08:00) Pacific Time (US & Canada); Tijuana</option>
											<option value="">(GMT-07:00) Mountain Time (US & Canada)</option>
											<option value="">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
											<option value="">(GMT-07:00) Arizona</option>
											<option value="">(GMT-06:00) Central America</option>
											<option value="">(GMT-06:00) Central Time (US & Canada)</option>
											<option value="">(GMT-06:00) Saskatchewan</option>
											<option value="">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
											<option value="">(GMT-05:00) Eastern Time (US & Canada)</option>
											<option value="">(GMT-05:00) Indiana (East)</option>
											<option value="">(GMT-05:00) Bogota, Lima, Quito</option>
											<option value="">(GMT-04:00) Atlantic Time (Canada)</option>
											<option value="">(GMT-04:00) Caracas, La Paz</option>
											<option value="">(GMT-04:00) Santiago</option>
											<option value="">(GMT-03:30) Newfoundland</option>
											<option value="">(GMT-03:00) Brasilia</option>
											<option value="">(GMT-03:00) Buenos Aires, Georgetown</option>
											<option value="">(GMT-03:00) Greenland</option>
											<option value="">(GMT-02:00) Mid-Atlantic</option>
											<option value="">(GMT-01:00) Azores</option>
											<option value="">(GMT-01:00) Cape Verde Is.</option>
											<option class="doble" value="">(GMT 00:00) Greenwich Mean Time : Dublin, Edinburgh, London</option>
											<option value="">(GMT 00:00) Casablanca, Monrovia</option>
											<option value="">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
											<option value="">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
											<option value="">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
											<option value="">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
											<option value="">(GMT+01:00) West Central Africa</option>
											<option value="">(GMT+02:00) Bucharest</option>
											<option value="">(GMT+02:00) Cairo</option>
											<option value="">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
											<option value="">(GMT+02:00) Athens, Istanbul, Minsk</option>
											<option value="">(GMT+02:00) Jerusalem</option>
											<option value="">(GMT+02:00) Harare, Pretoria</option>
											<option value="">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
											<option value="">(GMT+03:00) Kuwait, Riyadh</option>
											<option value="">(GMT+03:00) Nairobi</option>
											<option value="">(GMT+03:00) Baghdad</option>
											<option value="">(GMT+03:30) Tehran</option>
											<option value="">(GMT+04:00) Abu Dhabi, Muscat</option>
											<option value="">(GMT+04:00) Baku, Tbilisi, Yerevan</option>
											<option value="">(GMT+04:30) Kabul</option>
											<option value="">(GMT+05:00) Ekaterinburg</option>
											<option value="">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
											<option value="">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
											<option value="">(GMT+05:45) Kathmandu</option>
											<option value="">(GMT+06:00) Astana, Dhaka</option>
											<option value="">(GMT+06:00) Sri Jayawardenepura</option>
											<option value="">(GMT+06:00) Almaty, Novosibirsk</option>
											<option value="">(GMT+06:30) Rangoon</option>
											<option value="">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
											<option value="">(GMT+07:00) Krasnoyarsk</option>
											<option value="">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
											<option value="">(GMT+08:00) Kuala Lumpur, Singapore</option>
											<option value="">(GMT+08:00) Taipei</option>
											<option value="">(GMT+08:00) Perth</option>
											<option value="">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
											<option value="">(GMT+09:00) Seoul</option>
											<option value="">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
											<option value="">(GMT+09:00) Yakutsk</option>
											<option value="">(GMT+09:30) Darwin</option>
											<option value="">(GMT+09:30) Adelaide</option>
											<option value="">(GMT+10:00) Canberra, Melbourne, Sydney</option>
											<option value="">(GMT+10:00) Brisbane</option>
											<option value="">(GMT+10:00) Hobart</option>
											<option value="">(GMT+10:00) Vladivostok</option>
											<option value="">(GMT+10:00) Guam, Port Moresby</option>
											<option value="">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
											<option value="">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
											<option value="">(GMT+12:00) Auckland, Wellington</option>
											<option value="">(GMT+13:00) Nuku alofa</option>
										</select>
									</div><!--zona_horaria-div-->
									<div class="cleaner"></div>
								</div><!--programar_envio-->
								<div class="configuracionenvio_mensaje">
									<div class="checkbox">
										<input id="checkbox6" type="checkbox" checked="checked">
										<label for="checkbox6"></label>
									</div>
									<p>Deseo recibir una notificaci&oacute;n cuando la campa&ntilde;a haya sido enviada.</p>
									<div class="cleaner"></div>
								</div><!--fin configuracionenvio_mensaje-->
							</div><!--fin content-2-->
						</div>
					</div><!--pestanias_envio-->
				</div><!--configurar_envio-->
				<div id="opciones_pasos">
					<a id="guardarysalir" href="{{ route('campanias') }}" class="btn_guardar" y="salir">GUARDAR Y SALIR</a>
					<ul>
						<li><a href="{{ URL::previous() }}" id="anterior">ANTERIOR</a></li>
						<li><a href="{{ route('paso_4') }}" id="siguiente" class="btn_guardar" y="seguir">SIGUIENTE</a></li>
					</ul>
					<div class="cleaner"></div>
				</div><!--opciones_pasos-->
				</form>
			</div><!--infocont-->
		</div><!--content-->
	</section>
</div><!--conteiner--><!-- #BeginLibraryItem "/Library/footer_internas.lbi" -->

<div id="foo">
	  <div id="foo_text">

		<div id="foo_izq">
		<h6>TrebolNEWS</h6>
		<p>www.trebolnews.com - Copyright 2013</p>
		</div>

		<div id="foo_der">
		<a href="#" class="twe">Seguinos por Tweter</a>
		<a href="#" class="face">Estamos en Facebook</a>

		<form id="subanewsletter" method="post"  action=""> <!-- es necesario que coincida el nombre de este archivo php con el que aparece en el campo action -->
		<input type="text" name="email" class="compo-form" id="newsletter" placeholder="Suscr&iacute;bete a nuestro Newsletter"  style=" color:#FFF; font-size:12px;"  />
		<input type="submit" id="button" value="ENVIAR" />
		</form>

		<div class="cleaner"></div>
		</div>

	  <div class="cleaner"></div>

	   <div id="botones_footer">
	   <ul>
	   <li><a href="campanias.html">Campa&ntilde;as</a></li>
	   <li><a href="listascontactos.html">Suscriptores</a></li>
	   <li><a href="libreria.html">Libre&iacute;as</a></li>
	   <li><a href="planes.html">Planes</a></li>
	   <li><a href="soporte.html">Soporte</a></li>
	   <li><a href="terminosycondiciones.html" class="ultimo_boton_footer" target="_blank">Terminos y Condiciones</a></li>
	   </ul>
	   <div class="cleaner"></div>
	   </div><!--botones_footer-->

	  </div><!--fin de foo_text-->
	  </div>

	  <!--fin de footer--><!-- #EndLibraryItem --><!--chat-->
		{{ HTML::script('home/js/chat.js') }}
		<script>
			var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				showRight = document.getElementById( 'showRight' ),
				showTop = document.getElementById( 'showTop' ),
				body = document.body;

			showRight.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuRight, 'cbp-spmenu-open' );
				disableOther( 'showRight' );
			};

			function disableOther( button ) {

				if( button !== 'showRight' ) {
					classie.toggle( showRight, 'disabled' );
				}
			}
		</script>
	   <!--chat-->





	  <!--explorer placeholder-->

		<script type="text/javascript">
/* <![CDATA[ */
$(function() {
	var input = document.createElement("input");
	if(('placeholder' in input)==false) {
		$('[placeholder]').focus(function() {
			var i = $(this);
			if(i.val() == i.attr('placeholder')) {
				i.val('').removeClass('placeholder');
				if(i.hasClass('password')) {
					i.removeClass('password');
					this.type='password';
				}
			}
		}).blur(function() {
			var i = $(this);
			if(i.val() == '' || i.val() == i.attr('placeholder')) {
				if(this.type=='password') {
					i.addClass('password');
					this.type='text';
				}
				i.addClass('placeholder').val(i.attr('placeholder'));
			}
		}).blur().parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var i = $(this);
				if(i.val() == i.attr('placeholder'))
					i.val('');
			})
		});
	}
});
/* ]]> */
</script>

 <!--explorer placeholder-->
	</body>
</html>