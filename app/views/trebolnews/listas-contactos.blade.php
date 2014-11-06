@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Contactos

@stop

@section('script')

    <script>
    $(function(){

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
        });

        $('[name="search-term"]').on('keypress', function(e){
            if(e.which == 13) {
                e.preventDefault();

                $('#frm-search').ajaxSubmit({
                    success: function(data) {
                        if(data.status == 'ok') {
                            $('#table-content').html(data.html);
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
                            <input type="hidden" name="id_lista" value="{{ $lista->id }}" />
                            <input class="search" type="text" placeholder="BUSCAR" name="search-term" />
                        </form>
                        <ul class="opciones">
                            <li><a class="importarlista" href="#">OPCIONES</a>
                            <ul>
                                <li><a href="#">Importar lista</a></li>
                                <li><a id="btn_exportar" href="{{ action('ListaController@export', $lista->id) }}" target="_blank">Exportar lista</a></li>
                            </ul>
                            </li>
                            <li><a class="crearlista" href="#" popup="{{ url('popup/crear_contacto', $lista->id) }}">CREAR SUSCRIPTOR</a></li>
                        </ul>
                        <div class="cleaner"></div>
                    </div><!--submenu-->
                    <div id="submenulibreria">
                        <ul id="filtroselecionados">
                            <li><p>Seleccionados: <span id="span_seleccionados">0</span> de {{ count($contactos) }}</p></li>
                            <li><a id="borrarselecionados" href="popup_eliminarsuscriptor_multi.html">Eliminar</a></li>
                        </ul>
                        <ul id="cantidad" class="btosuscriptores">
                            <li><a href="#" class="boton">VER</a>
                            <ul>
                                <li><a href="#">10</a></li>
                                <li><a href="#">20</a></li>
                                <li><a href="#">50</a></li>
                                <li><a href="#">100</a></li>
                            </ul>
                            </li>
                        </ul>
                        <div class="cleaner"></div>
                    </div><!-- submenulibreria -->
                    <table width="100%"  cellpadding="0" cellspacing="0" class="listadecontactos">
                        <tr class="primeralinea">
                            <th scope="col" width="40px">
                                <div class="checkbox">
                                    <input type="checkbox" class="todos" />
                                    <label></label>
                                </div>
                            </th>
                            <th scope="col" width="190px">Nombre y Apellido
                                <!-- <a href="#" class="flechatabla"></a> -->
                            </th>
                            <th scope="col" width="189px">Email</th>
                            <th scope="col" width="180px">Puesto / Cargo</th>
                            <th scope="col" width="180px">Empresa</th>
                            <th scope="col" width="90px">Pa&iacute;s</th>
                            <th scope="col" width="65px"></th>
                        </tr>
                        <tbody id="table-content">
                        {{ $html }}
                        </tbody>
                    </table>
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
