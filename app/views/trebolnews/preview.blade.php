@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Visualizar plantilla

@stop

@section('data')

    @parent
    <input type="hidden" id="menu_principal" value="campanias" />

@stop

@section('contenido')

    <div id="container">
        <section class="tabs">
            <div class="content">
                <h2>Emails Predise&ntilde;ados</h2>
                <a id="volver" href="campaniatemplate_paso4.html"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
                <div class="infocont">
                    <div id="detalle_template">
                        <img src="{{ asset('internas/imagenes/template-detalle.jpg') }}" width="800" height="1200">
                    </div>
                </div>
            </div>
        </section>
    </div>

@stop
