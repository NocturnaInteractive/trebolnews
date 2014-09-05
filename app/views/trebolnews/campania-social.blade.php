@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Campaña social

@stop

@section('data')

    @parent
    <input type="hidden" id="menu_principal" value="campanias" />

@stop

@section('contenido')

    <div id="container">
        <section class="tabs">
            <div class="content">
                <h2>Campa&ntilde;a Social</h2>
                <a id="volver" href="{{ route('nueva_campania') }}"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
                <div class="infocont">
                    <ul id="pasoscam">
                        <li id="pasocam1">Paso 1<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam2">Paso 2<div class="linea"></div><div class="circulo  pasosactivado"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam3">Paso 3<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam4">Paso 4<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam5">Paso 5<div class="linea"></div><div class="circulo"></div></li>
                        <div class="cleaner"></div>
                    </ul><!--pasoscam-->
                    <h3>&iquest;C&oacute;mo deseas armar tu campa&ntilde;a?</h3>
                    <div id="armarcam">
                        <a id="eblanco" href="{{ route('paso_3') }}" session="campania.subtipo:blanco">
                            <h4>Email en blanco</h4>
                            <img src="{{ asset('internas/imagenes/eblanco.png') }}" width="107" height="100" alt="emaill blanco">
                            <p>Crea el email, copiando y pegando el contenido en una plantilla en blanco.</p>
                        </a>
                        <a id="epredi" href="{{ route('paso_3') }}" session="campania.subtipo:template">
                            <h4>Emails predise&ntilde;ados</h4>
                            <img src="{{ asset('internas/imagenes/epredi.png') }}" width="107" height="100" alt="email predise&ntilde;ados">
                            <p>Crea el email en base a una<br>plantilla pre-cargada.</p>
                        </a>
                        <a id="eanteriores" href="{{ route('campanias') }}">
                            <h4>Campa&ntilde;as enviadas</h4>
                            <img src="{{ asset('internas/imagenes/camanterioressocial.png') }}" width="107" height="100" alt="campa&ntilde;as enviadas">
                            <p>Crea el email en base a una<br>campa&ntilde;a anterior.</p>
                        </a>
                        <a id="url" href="{{ route('paso_3') }}" session="campania.subtipo:url">
                            <h4>URL</h4>
                            <img src="{{ asset('internas/imagenes/url.png') }}" width="107" height="100" alt="url">
                            <p>Carga el dise&ntilde;o y contenido del email desde una URL externa.</p>
                        </a>
                        <a id="html" href="{{ route('paso_3') }}" session="camania.subtipo:html">
                            <h4>HTML</h4>
                            <img src="{{ asset('internas/imagenes/html.png') }}" width="107" height="100" alt="html">
                            <p>Crea y modifica tu propio<br>c&oacute;digo HTML</p>
                        </a>
                        <a id="tutorial_ch" href="#">
                            <h4>Tutoriales</h4>
                            <img src="{{ asset('internas/imagenes/tutoriales_ch.png') }}" width="107" height="100" alt="html">
                            <p>Aprende c&oacute;mo crear tu<br>primera campa&ntilde;a</p>
                        </a>
                    </div><!--armarcam-->
                    <div class="cleaner"></div>
                </div><!--infocont-->
                <div class="cleaner"></div>
            </div><!--content-->
        </section>
    </div>

@stop