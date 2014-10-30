@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Listas de suscriptores

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

        $('#btn_exportar').on('click', function(e){
            e.preventDefault();
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
                                    <li><a href="#">Importar lista</a></li>
                                    <li><a id="btn_exportar" href="{{ action('ListaController@export') }}">Exportar listas</a></li>
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
                            <li><p>Seleccionados: <span id="txt_seleccionados">0</span> de <span id="txt-total">{{ count($listas) }}</span></p></li>
                            <li><a id="borrarselecionados" href="popup_eliminar_listasuscriptor_multi.html">Eliminar</a></li>
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
                    </div><!--submenulibreria   -->
                    <table width="100%" cellpadding="0" cellspacing="0" class="listacampanias" id="tabla_listas">
                        <tr class="primeralinea">
                            <th scope="col" width="40px">
                                <div class="checkbox">
                                    <input type="checkbox" class="todos" />
                                    <label></label>
                                </div>
                            </th>
                            <th scope="col" width="305px">Nombre de lista</th>
                            <th scope="col" width="200px">Creada
                                <!-- <a href="#" class="flechatabla"></a> -->
                            </th>
                            <th scope="col" width="149px">Editada</th>
                            <th scope="col" width="140px">Suscriptores</th>
                            <th scope="col" width="100px"></th>
                        </tr>
                        <tbody id="table-content">
                        {{ $html }}
                        </tbody>
                    </table>
                    <div id="paginador">
                        @if(count($listas) > 0)
                            {{ $listas->links('trebolnews/paginador-ajax') }}
                        @endif
                    </div><!--paginador-->
                    <div class="cleaner"></div>
                </div> <!--infocont-->
            </div>
        </section>
    </div>

@stop
