@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Listas de suscriptores

@stop

@section('data')

    @parent
    <input type="hidden" id="menu_principal" value="suscriptores" />

@stop

@section('head')

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

        $('#btn_exportar').on('click', function(e){
            e.preventDefault();

            if($('.checkbox input:checked').length == 0) {
                noty({
                    text: 'Seleccione al menos una lista',
                    layout: 'topCenter',
                    timeout: 5000
                });
            }

            var url = $(this).attr('href');
            $('.checkbox input:checked').each(function(i,e){
                var tab = window.open(url + '/' + $(e).val());
            });
        });

    });
    </script>

@stop

@section('contenido')

    <div id="container">
        <section class="tabs">
            <div class="content">
                <h2>Listas de suscriptores</h2>
                <div class="infocont">
                    <div class="submenu">
                        <form id="frm-search" action="{{ action('ListaController@search') }}" method="post">
                            <input class="search" type="text" placeholder="BUSCAR" name="search-term" />
                        </form>
                        <ul class="opciones">
                            <li>
                                <a class="importarlista" href="#">OPCIONES</a>
                                <ul>
                                    <li><a href="#" popup="{{ url('popup/importar_lista') }}">Importar lista</a></li>
                                    @if(count(Auth::user()->listas) > 0)
                                    <li><a id="btn_exportar" href="{{ action('ListaController@export') }}">Exportar listas</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li>
                                <a class="crearlista" href="#" popup="{{ url('popup/crear_lista') }}">CREAR LISTA</a>
                            </li>
                        </ul>
                        <div class="cleaner"></div>
                    </div><!--submenu-->
                    <div id="submenulibreria">
                        <ul id="filtroselecionados">
                            <li><p>Seleccionados: <span id="span_seleccionados">0</span> de <span id="txt-total">{{ count($listas) }}</span></p></li>
                            <li><a id="borrarselecionados" href="#" popup="{{ url('popup/eliminar_lista_multi') }}">Eliminar</a></li>
                        </ul>
                        <ul id="cantidad" class="btosuscriptores">
                            <li><a href="#" class="boton">VER</a>
                            <ul>
                                <li><a href="#" preference="cant_listas.10">10</a></li>
                                <li><a href="#" preference="cant_listas.20">20</a></li>
                                <li><a href="#" preference="cant_listas.50">50</a></li>
                                <li><a href="#" preference="cant_listas.100">100</a></li>
                            </ul>
                            </li>
                        </ul>
                        <div class="cleaner"></div>
                    </div><!-- submenulibreria -->
                    <div id="table">
                        {{ $html }}
                    </div>
                    <div id="paginador">
                        @if(count($listas) > 0)
                            {{ $listas->links('trebolnews.paginador-ajax') }}
                        @endif
                    </div><!--paginador-->
                    <div class="cleaner"></div>
                </div> <!--infocont-->
            </div>
        </section>
    </div>

@stop
