@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Editor

@stop

@section('script')
	{{ HTML::script('ckeditor/adapters/jquery.js') }}
    {{ HTML::script('js/sections/campaigns.js') }}
@stop

@section('contenido')
    <div id="container" class="step4 editor">


	<section class="tabs">

		<div class="content">
			<h2>Email en Blanco</h2>
			<a id="volver" href="{{ route('step3') }}"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>

			<div class="infocont">

				<ul id="pasoscam">
					<li id="pasocam1">Paso 1<div class="linea"></div><div class="circulo"></div></li>
					<li class="separadorpasos"> <div class="separadorlinea"></div></li>
					<li id="pasocam2">Paso 2<div class="linea"></div><div class="circulo"></div></li>
					<li class="separadorpasos"> <div class="separadorlinea"></div></li>
					<li id="pasocam3">Paso 3<div class="linea"></div><div class="circulo"></div></li>
					<li class="separadorpasos"> <div class="separadorlinea"></div></li>
					<li id="pasocam4">Paso 4<div class="linea"></div><div class="circulo pasosactivado"></div></li>
					<li class="separadorpasos"> <div class="separadorlinea"></div></li>
					<li id="pasocam5">Paso 5<div class="linea"></div><div class="circulo"></div></li>
					<div class="cleaner"></div>
				</ul><!--pasoscam-->



				<div style="border:1px solid #D4D8D9; height:400px">
				
				<div class="template-gallery">
					<div>
						<img style="width:100px; height:100px;" src="http://images.sharefaith.com/images/3/1283540378534_180/page-02.jpg">
						<img style="width:100px; height:100px;" src="http://images.sharefaith.com/images/3/1283540378534_180/page-02.jpg">
						<img style="width:100px; height:100px;" src="http://images.sharefaith.com/images/3/1283540378534_180/page-02.jpg">
						<img style="width:100px; height:100px;" src="http://images.sharefaith.com/images/3/1283540378534_180/page-02.jpg">
						<img style="width:100px; height:100px;" src="http://images.sharefaith.com/images/3/1283540378534_180/page-02.jpg">
						<img style="width:100px; height:100px;" src="http://images.sharefaith.com/images/3/1283540378534_180/page-02.jpg">
						<img style="width:100px; height:100px;" src="http://images.sharefaith.com/images/3/1283540378534_180/page-02.jpg">
						<img style="width:100px; height:100px;" src="http://images.sharefaith.com/images/3/1283540378534_180/page-02.jpg">
					</div>	
				</div>

				</div><!--editor de contenido-->

				<div id="opciones_pasos" class="opciones_paso4">
					<a id="guardarysalir" href="{{ route('campanias') }}" class="btn_guardar" y="salir">GUARDAR Y SALIR</a>
					<ul>
						<li><a href="{{ route('step3') }}" id="anterior"  class="btn_guardar" y="seguir" >ANTERIOR</a></li>
						<li><a href="{{ route('step5') }}" id="siguiente" class="btn_guardar" y="seguir">VISUALIZAR</a></li>
					</ul>
					<div class="cleaner"></div>
				</div><!--opciones_pasos-->


			</div><!--infocont-->






		</div><!--content-->
	</section>
</div>
@stop
