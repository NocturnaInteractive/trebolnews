@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Contactos

@stop

@section('data')

    @parent
    <input type="hidden" id="menu_principal" value="suscriptores" />

@stop

@section('script')

    <script>
    $(function(){

        $('#borrarselecionados').hide();

        $('.checkbox').on('click', function(e){
            e.preventDefault();

            var clicked = $(this).find('input');

            if(clicked.hasClass('todos')) {
                if(clicked.prop('checked') == true) {
                    $('.checkbox').find('input').prop('checked', false);
                } else {
                    $('.checkbox').find('input').prop('checked', true);
                }
            } else {
                if(clicked.prop('checked') == true) {
                    clicked.prop('checked', false);
                } else {
                    clicked.prop('checked', true);
                }
            }

            $('#span_seleccionados').text($('.checkbox input:checked').not('.todos').length);

            if($('.checkbox input:checked').not('.todos').length == $('.checkbox input').not('.todos').length) {
                $('.checkbox .todos').prop('checked', true);
            } else {
                $('.checkbox .todos').prop('checked', false);
            }

            if($('.checkbox input:checked').not('.todos').length > 0) {
                $('#borrarselecionados').show();
            } else {
                $('#borrarselecionados').hide();
            }
        });

        $('[name="search-term"]').on('keypress', function(e){
            if(e.which == 13) {
                e.preventDefault();

                $('#frm-search').ajaxSubmit({
                    success: function(data) {
                        if(data.status == 'ok') {
                            $('#table').html(data.html);
                            $('#paginador').html(data.paginador);
                            $('#txt-total').text(data.total);
                        } else {
                            notys(data.validator);
                        }
                    }
                });
            }
        });

    });
    </script>

@stop

@section('contenido')

    <div id="container">
        <section class="tabs">
            <div class="content">
                <h2>Lista: {{ $lista->nombre }}</h2>
                <a id="volver" href="{{ route('suscriptores') }}"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
                <div class="infocont">
                    <div class="submenu">
                        <form id="frm-search" action="{{ action('ContactoController@search') }}" method="post">
                            <input type="hidden" id="id_lista" name="id_lista" value="{{ $lista->id }}" />
                            <input class="search" type="text" placeholder="BUSCAR" name="search-term" />
                        </form>
                        <ul class="opciones">
                            <li><a class="importarlista" href="#">OPCIONES</a>
                            <ul>
                                <li><a href="#" popup="{{ url('popup/importar_lista') }}">Importar lista</a></li>
                                @if(count($lista->contactos) > 0)
                                <li><a id="btn_exportar" href="{{ action('ListaController@export', $lista->id) }}" target="_blank">Exportar lista</a></li>
                                @endif
                            </ul>
                            </li>
                            <li><a class="crearlista" href="#" popup="{{ url('popup/crear_contacto', $lista->id) }}">CREAR SUSCRIPTOR</a></li>
                        </ul>
                        <div class="cleaner"></div>
                    </div><!--submenu-->
                    <div id="submenulibreria">
                        <ul id="filtroselecionados">
                            <li><p>Seleccionados: <span id="span_seleccionados">0</span> de {{ count($contactos) }}</p></li>
                            <li><a id="borrarselecionados" href="#" popup="{{ url('popup/eliminar_suscriptor_multi') }}">Eliminar</a></li>
                        </ul>
                        <ul id="cantidad" class="btosuscriptores">
                            <li><a href="#" class="boton">VER</a>
                            <ul>
                                <li><a href="#" preference="cant_suscriptores.10">10</a></li>
                                <li><a href="#" preference="cant_suscriptores.20">20</a></li>
                                <li><a href="#" preference="cant_suscriptores.50">50</a></li>
                                <li><a href="#" preference="cant_suscriptores.100">100</a></li>
                            </ul>
                            </li>
                        </ul>
                        <div class="cleaner"></div>
                    </div><!-- submenulibreria -->
                    <div id="table">
                        {{ $html }}
                    </div>
                    <div id="paginador">
                        @if(count($contactos) > 0)
                            {{ $contactos->links('trebolnews/paginador-ajax') }}
                        @endif
                    </div><!--paginador-->
                    <div class="cleaner"></div>
                </div> <!--infocont-->
            </div>
        </section>
    </div>

@stop
