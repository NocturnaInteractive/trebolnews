@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Editor

@stop

@section('script')
	{{ HTML::script('ckeditor/ckeditor.js') }}
	{{ HTML::script('ckeditor/adapters/jquery.js') }}
    {{ HTML::script('js/sections/campaigns.js') }}
@stop

@section('contenido')
    <div id="container" class="step5">


		<section class="tabs">

			<div class="content">
				<h2>Resumen y Envio</h2>
				<a id="volver" href="{{ route('step4') }}"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>

				<div class="infocont">
					<ul id="pasoscam">
						<li id="pasocam1">Paso 1<div class="linea"></div><div class="circulo"></div></li>
						<li class="separadorpasos"> <div class="separadorlinea"></div></li>
						<li id="pasocam2">Paso 2<div class="linea"></div><div class="circulo"></div></li>
						<li class="separadorpasos"> <div class="separadorlinea"></div></li>
						<li id="pasocam3">Paso 3<div class="linea"></div><div class="circulo"></div></li>
						<li class="separadorpasos"> <div class="separadorlinea"></div></li>
						<li id="pasocam4">Paso 4<div class="linea"></div><div class="circulo"></div></li>
						<li class="separadorpasos"> <div class="separadorlinea"></div></li>
						<li id="pasocam5">Paso 5<div class="linea"></div><div class="circulo  pasosactivado"></div></li>
						<div class="cleaner"></div>
					</ul><!--pasoscam-->


					<div id="infocont">

						<div id="configuracion_resumen"> <!-- class="resumen_mal" -->
							<div class="tiyulos_resumen">
								<h3>Configuraci&oacute;n</h3>
								<a class="editar_resumen" href="#" id="btn_editar_informacion_basica">editar</a>
								<div class="cleaner"></div>
							</div><!--tiyulos_resumen-->
							<p class="secciones">Informaci&oacute;n B&aacute;sica</p>
							<table width="100%"  cellpadding="0" cellspacing="0" class="perfiltabla">
								<tr class="primeraperfil">
									<th scope="col" width="250px" class="tipoperfil">Nombre de la Campa&ntilde;a:</th>
									<th class="datoperfil" scope="col" width="684px">{{ Session::get('campania.nombre') }}</th>
								</tr>
								<tr>
									<td class="tipoperfil">Asunto:</td>
									<td class="datoperfil">{{ Session::get('campania.asunto') }}</td>
								</tr>
								<tr>
									<td class="tipoperfil">Nombre del Remitente:</td>
									<td class="datoperfil">{{ Session::get('campania.remitente') }}</td>
								</tr>
								<tr>
									<td class="tipoperfil">Email del Remitente:</td> {{-- existe class="cont_faltante" --}}
									<td class="datoperfil">{{ Session::get('campania.email') }}</td>
								</tr>
								<tr>
									<td class="tipoperfil">Email de Respuesta:</td>
									<td class="datoperfil">{{ Session::get('campania.respuesta') }}</td>
								</tr>
							</table>

							<div id="resumen_destinatarios">
								<p class="secciones">Destinatarios Elegidos</p>
								<table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
									<tr class="primeralinea">
										<th scope="col" width="355px">Nombre de Lista</th>
										<th scope="col" width="250px">Fecha de Creaci&oacute;n</th>
										<th scope="col" width="149px">Editado el</th>
										<th scope="col" width="180px">Suscriptores</th>
									</tr>
									@if(Session::has('campania.listas'))
									@foreach(Session::get('campania.listas') as $id_lista)
									<?php $lista = Lista::find($id_lista) ?>
									<tr>
										<td>{{ $lista->nombre }}</td>
										<td>{{ $lista->created_at->format('d/m/Y') }}</td>
										<td>{{ $lista->updated_at->format('d/m/Y') }}</td>
										<td>{{ count($lista->contactos) }}</td>
									</tr>
									@endforeach
									@endif
								</table>
							</div><!--resumen_destinatarios-->

							<div id="resumen_redes">
								<p class="secciones">Redes Sociales Elegidas</p>
								<div id="resumenredes_clasica">
									<div class="iconosredes_resumencla noelegidored" id="face_resumen" red="facebook"></div>
									<div class="iconosredes_resumencla noelegidored" id="tw_resumen" red="twitter"></div>
									<div class="iconosredes_resumencla noelegidored" id="link_resumen" red="linkedin"></div>
									<div class="iconosredes_resumencla noelegidored" id="gplus_resumen" red="google"></div>
									<div class="iconosredes_resumencla noelegidored" id="p_resumen" red="pinterest"></div>
									<div class="iconosredes_resumencla noelegidored" id="b_resumen" red="blogger"></div>
									<div class="iconosredes_resumencla noelegidored" id="meneame_resumen" red="meneame"></div>
									<div class="iconosredes_resumencla noelegidored" id="tumbl_resumen" red="tumblr"></div>
									<div class="iconosredes_resumencla noelegidored" id="reddit_resumen" red="reddit"></div>
									<div class="iconosredes_resumencla noelegidored" id="digg_resumen" red="digg"></div>
									<div class="iconosredes_resumencla noelegidored" id="delicius_resumen" red="delicious"></div>
									<div style="display: none;" id="redes_seleccionadas">
										@if(Session::has('campania.redes'))
										@foreach(Session::get('campania.redes') as $red)
										<input type="hidden" value="{{ $red }}" />
										@endforeach
										@endif
									</div>
									<div class="cleaner"></div>
								</div><!--resumenredes_clasica-->
							</div><!--resumen_redes-->

							<div id="resumen_envio">
								<p class="secciones">Env&iacute;o de la Campa&ntilde;a</p>
								@if(Session::has('campania.programacion'))
								<img src="{{ asset('internas/imagenes/programar_clasico.png') }}" width="107" height="100">
								<p id="horario_programado">Entrega Programada:<br>
									<?php
									$prog = Carbon::createFromFormat('d/m/Y', Session::get('campania.programacion'));
									$dias = Config::get('trebolnews.dias');
									$meses = Config::get('trebolnews.meses');
									?>
									{{ $dias[$prog->format('w')] . ' ' . $prog->format('j') . ' de ' . $meses[$prog->format('n') - 1] . ' de ' . $prog->format('Y g:i A') }}
								</p>
								@else
								<img src="{{ asset('internas/imagenes/inmediato_clasico.png') }}" width="107" height="100">
								<p id="horario_programado">Envío Inmediato</p>
								@endif
								<div class="cleaner"></div>
							</div><!--resumen_envio-->

						</div><!--configuracion_resumen-->




						<div id="contenidoyprueba_resumen">

							<div id="contenido_resumen" class="resumen_bien" >
								<div class="tiyulos_resumen">
									<h3>Contenido</h3>
									<a class="editar_resumen" href="#">editar</a>
									<a class="ver_resumen" href="#">ver</a>
									<div class="cleaner"></div>
								</div><!--tiyulos_resumen-->
								<table cellpadding="0" cellspacing="0" id="campania_resumen">
									<tr><td>{{ Session::get('campania.contenido') }}</td></tr>
								</table>
							</div><!--contenido_resumen-->


							<div id="probarenvio_resumen">
								<h3>Prueba</h3>
								<p>Realice un envi&oacute; de prueba. Separar emails por punto y coma.</p>
								<form>
									<textarea class="emaildeprueba" class="textarea" placeholder="¿A qué emails quieres enviar la prueba?">{{Auth::user()->email}}</textarea>
									<div id="boton_prueba">
										<input type="button" value="PROBAR" id="probar_boton" />
										<div class="cleaner"></div>
									</div>
								</form>
							</div><!--probarenvio_resumen-->


							<div class="cleaner"></div>
						</div><!--contenidoyprueba_resumen-->



						<div id="opciones_pasos" ajax="{{ action('CampaniaController@guardar_campania') }}">
							<a id="guardarysalir" href="{{ route('campanias') }}" class="btn_guardar" y="salir">GUARDAR Y SALIR</a>
							<ul>
								<li><a href="{{ route('step4') }}" id="anterior">ANTERIOR</a></li>
								<li><a href="{{ route('campanias') }}" id="siguiente" class="btn_guardar" y="confirmar">
									@if(Session::get('campania.envio') == 'inmediato')
									ENVIAR
									@elseif(Session::get('campania.envio') == 'programado')
									PROGRAMAR
									@endif
								</a></li>
							</ul>
							<div class="cleaner"></div>
						</div><!--opciones_pasos-->
					</div><!--infocont-->






				</div><!--content-->
			</section>
		</div>
@stop
