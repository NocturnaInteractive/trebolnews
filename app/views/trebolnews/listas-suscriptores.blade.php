@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Suscriptores

@stop

@section('script')
    <script>
    $(function(){
        $('.checkbox').on('click', function(e){
            e.preventDefault();

            var clicked = $(this).find('input');

            if(clicked.hasClass('todos')) {

            } else {
                if(clicked.prop('checked') == true) {
                    clicked.prop('checked', false);
                } else {
                    clicked.prop('checked', true);
                }
            }

        });
    });
    </script>
@stop

@section('contenido')

    <div id="container">
        <section class="tabs">
            <div class="content">
                <h2>Listas de Suscriptores</h2>
                <div class="infocont">
                    <div class="submenu">
                        <form>
                            <input class="search" type="text" placeholder="BUSCAR" name="Search" />
                        </form>
                        <ul class="opciones">
                            <li>
                                <a class="importarlista" href="#">OPCIONES</a>
                                <ul>
                                    <li><a href="#">Importar lista</a></li>
                                    <li><a href="#">Exportar listas</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="crearlista" href="#" popup="{{ url('popup/crearlista') }}">CREAR LISTA</a>
                            </li>
                        </ul>
                        <div class="cleaner"></div>
                    </div><!--submenu-->
                    <div id="submenulibreria">
                        <ul id="filtroselecionados">
                            <li><p>Seleccionados: <span id="txt_seleccionados">0</span> de {{ count($listas) }}</p></li>
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
                            <th scope="col" width="305px">Nombre de Lista</th>
                            <th scope="col" width="200px">Fecha de Creaci&oacute;n
                                <!-- <a href="#" class="flechatabla"></a> -->
                            </th>
                            <th scope="col" width="149px">Editado el</th>
                            <th scope="col" width="140px">Suscriptores</th>
                            <th scope="col" width="100px"></th>
                        </tr>
                        @foreach($listas as $lista)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input type="checkbox" name="chk_lista[]" value="{{ $lista->id }}" />
                                        <label></label>
                                    </div>
                                </td>
                                <td><a href="{{ route('lista', $lista->id) }}">{{ $lista->nombre }}</a></td>
                                <td>{{ $lista->created_at->format('d/m/Y') }}</td>
                                <td>{{ $lista->updated_at->format('d/m/Y') }}</td>
                                <td>{{ count($lista->contactos) }}</td>
                                <td>
                                    <a class="descargarlista" href="#">
                                        <img src="{{ asset('internas/imagenes/descargarlista.png') }}" alt="descargar lista" width="25" height="25">
                                    </a>
                                    <a class="editarcampam" href="#" popup="{{ url('popup/editar_lista' . '/' . $lista->id) }}">
                                        <img src="{{ asset('internas/imagenes/editarcamania.png') }}" alt="cambiar nombre" width="25" height="25">
                                    </a>
                                    <a class="borrarcam" href="#" popup="{{ url('popup/eliminar_lista' . '/' . $lista->id) }}">
                                        <img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar lista" width="25" height="25">
                                    </a>
                                    <div class="cleaner"></div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div id="paginador">
                        @if(count($listas) > 0)
                            {{ $listas->links('paginador') }}
                        @endif
                    </div><!--paginador-->
                    <div class="cleaner"></div>
                </div> <!--infocont-->
            </div>
        </section>
    </div>

@stop
