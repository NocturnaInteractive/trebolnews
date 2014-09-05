@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Nueva campaña

@stop

@section('data')

    @parent
    <input type="hidden" id="menu_principal" value="campanias" />

@stop

@section('contenido')
    <div id="container">
        <section class="tabs">
            <div class="content">
                <h2>Crear campa&ntilde;a nueva</h2>
                <a id="volver" href="campanias.html"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
                <div class="infocont">
                    <ul id="pasoscam">
                        <li id="pasocam1">Paso 1<div class="linea"></div><div class="circulo pasosactivado"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam2">Paso 2<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam3">Paso 3<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam4">Paso 4<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam5">Paso 5<div class="linea"></div><div class="circulo"></div></li>
                        <div class="cleaner"></div>
                    </ul><!--pasoscam-->
                    <a id="campanacla" href="{{ route('campania_clasica') }}" session="campania.tipo:clasica">
                        <h4>Secci&oacute;n Campa&ntilde;a Cl&aacute;sica</h4>
                        <img src="{{ asset('internas/imagenes/camclasica.png') }}" width="160" height="150" alt="campa&ntilde;a clasica">
                        <p>Cree sus propias campa&ntilde;as. &Oacute; suba su campa&ntilde;a ya dise&ntilde;ada en html o por url.</p>
                    </a>
                    <a id="campanasocial" href="{{ route('campania_social') }}" session="campania.tipo:social">
                        <h4>Campa&ntilde;as Social<br>Media</h4>
                        <img src="{{ asset('internas/imagenes/camsicial.png') }}" width="160" height="150" alt="campa&ntilde;a social">
                        <p>Integre las campa&ntilde;as con las redes Facebook y Tw para viralizar sus env&iacute;os.</p>
                    </a>
                    <a id="testsocial" href="#">
                        <h4>Test de Campa&ntilde;as</h4>
                        <img src="{{ asset('internas/imagenes/testdecam.png') }}" width="160" height="150" alt=" test de campa&ntilde;as">
                        <p>Una vez que tengas campa&ntilde;as creadas, podr&aacute; testearlas envi&aacute;ndosela por mail.</p>
                    </a>
                    <div class="cleaner"></div>
                </div><!--infocont-->
            </div>
        </section>
    </div>

@stop