@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Librería

@stop

@section('data')

    @parent
    <input type="hidden" id="id_carpeta" value="{{ isset($carpeta_seleccionada) ? $carpeta_seleccionada->id : '' }}" />

@stop

@section('head')

    {{ HTML::style('trebolnews/fancybox/jquery.fancybox.css') }}
    <style>
    .fancybox-nav {
        width: 60px;
    }

    .fancybox-nav span {
        visibility: visible;
        opacity: 0.5;
    }

    .fancybox-next {
        right: -60px;
    }

    .fancybox-prev {
        left: -60px;
    }
    </style>

    {{ HTML::script('trebolnews/fancybox/jquery.fancybox.pack.js') }}
    <script>
    $(function(){

        $('[rel="gallery"]').fancybox({
            padding     : 5,
            margin      : [20, 60, 20, 60] // Increase left/right margin
        });

        $('.ver_libreria').on('click', function(e){
            e.preventDefault();

            $(this).parents('tr').find('[rel="gallery"]').trigger('click');
        });

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

    });
    </script>

@stop

@section('contenido')

    <div id="container">
        <section class="tabs">
            <div class="content">
                <h2>Librer&iacute;a</h2>
                <div class="infocont">
                    <div class="submenu">
                        <form>
                            <input class="searchlibroteca" type="text" placeholder="BUSCAR" name="Search" />
                        </form>
                        <ul id="subiralibreria">
                            <li><a class="subiralibreria">SUBIR A LIBRER&Iacute;A</a>
                            <ul>
                                <li><a id="btn_mipc" href="subir" popup="{{ url('popup/libreria_mipc') }}">Mi PC</a></li>
                                <li><a id="btn_redes" href="subir" popup="{{ url('popup/libreria_redes') }}">Redes Sociales</a></li>
                                <li><a href="{{ route('banco') }}">Banco de im&aacute;genes</a></li>
                            </ul>
                            </li>
                        </ul>
                        <div class="cleaner"></div>
                    </div><!--submenu-->
                    <div id="filtrolibreria">
                        <ul>
                            <?php $cantidad = 0; ?>
                            @foreach($carpetas as $carpeta)
                            <?php $cantidad += count($carpeta->imagenes); ?>
                            @endforeach
                            <li><a href="{{ route('librerias') }}" id="filtrotodo" {{ isset($carpeta_seleccionada) ? '' : 'class="apretado"' }}>Todo <span>({{ $cantidad + count($carpeta_imagenes->imagenes) }})</span></a></li>
                            <li><a href="{{ route('carpeta', 1) }}" id="filtroimag" {{ isset($carpeta_seleccionada) ? ( $carpeta_seleccionada->id == 1 ? 'class="apretado"' : '' ) : '' }}>{{ Str::title($carpeta_imagenes->nombre) }} <span>({{ count($carpeta_imagenes->imagenes) }})</span></a></li>
                            @foreach($carpetas as $carpeta)
                            <li><a href="{{ route('carpeta', $carpeta->id) }}" id="filtrocarpeta" {{ isset($carpeta_seleccionada) ? ($carpeta_seleccionada->id == $carpeta->id ? 'class="apretado"' : '') : '' }}>{{ Str::title($carpeta->nombre) }} <span>({{ count($carpeta->imagenes) }})</span></a></li>
                            @endforeach
                            <li><a href="{{ route('carpeta', $carpeta_basura->id) }}" id="filtrobasura" {{ isset($carpeta_seleccionada) ? ($carpeta_seleccionada->id == $carpeta_basura->id ? 'class="apretado"' : '') : '' }}>{{ Str::title($carpeta_basura->nombre) }} <span>({{ count($carpeta_basura->imagenes) }})</span></a></li>
                            <li><a href="#" id="filtrocrear" popup="{{ url('popup/crear_carpeta_libreria') }}">Crear carpeta</a></li>
                        </ul>
                    </div><!--filtrolibreria-->
                    <div id="tablalibreria">
                        <div id="submenulibreria">
                            <ul id="filtroselecionados">
                                <li><p>Seleccionados: <span id="span_seleccionados">0</span> de {{ count($imagenes) }} </p></li>
                                <li><a id="agregarcapeta" href="#">Mover a</a></li>
                                <li><a id="borrarselecionados" href="#">Eliminar</a></li>
                            </ul>
                            <ul id="filtrover">
                                <li><a id="filtroiconlinsta" class="apretado" href="#"><img src="{{ asset('internas/imagenes/filtroiconlinsta.png') }}" width="25" height="25"></a></li>
                                <li><a id="filtroiconimagen" href="#"><img src="{{ asset('internas/imagenes/filtroiconimagen.png') }}" width="25" height="25"></a></li>
                            </ul>
                            <ul id="cantidad">
                                <li>
                                    <a href="#" class="boton">VER</a>
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
                        <table width="100%"  cellpadding="0" cellspacing="0" class="libret">
                            <tr class="primeralibre">
                                <th scope="col" width="40px">
                                    <div class="checkbox">
                                        <input type="checkbox" class="todos" />
                                        <label></label>
                                    </div>
                                </th>
                                <th scope="col" width="170px">Visualizaci&oacute;n</th>
                                <th scope="col" width="200px">Nombre</th>
                                <th scope="col" width="125px">Dimensiones</th>
                                <th scope="col" width="99px">Tama&ntilde;o</th>
                                <th scope="col" width="100px"></th>
                            </tr>
                            @foreach($imagenes as $imagen)
                            <?php if(isset($carpeta_seleccionada) && $carpeta_seleccionada->id != 1) { $ruta = 'uploads/imagenes/'; } else { $ruta = 'img/libreria/'; } ?>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input type="checkbox" name="chk_imagen[]" value="{{ $imagen->id }}" />
                                        <label></label>
                                    </div>
                                </td>
                                <td class="libre_img">
                                    <a href="{{ asset($ruta . $imagen->archivo) }}" rel="gallery">
                                        <label for="checkbox2"><img src="{{ asset($ruta . $imagen->archivo) }}" height="75" /></label>
                                    </a>
                                </td>
                                <td class="nombrelibreria">{{ $imagen->nombre }}</td>
                                <?php $dim = getimagesize(public_path() . '/' . $ruta . $imagen->archivo); ?>
                                <td>{{ $dim[0] . ' x ' . $dim[1] }}</td>
                                <td>{{ round(filesize(public_path() . '/' . $ruta . $imagen->archivo) / 1024, 2, PHP_ROUND_HALF_DOWN) . ' Kb' }}</td>
                                <td>
                                    <a class="ver_libreria" href="#">
                                        <img src="{{ asset('internas/imagenes/ojoicono.png') }}" width="28" height="25">
                                    </a>
                                    <a class="editarcampam" href="#">
                                        <img src="{{ asset('internas/imagenes/editarcamania.png') }}" alt="editar campa&ntilde;a" width="25" height="25">
                                    </a>
                                    <a class="borrarcam" href="#">
                                        <img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar campa&ntilde;a" width="25" height="25">
                                    </a>
                                    <div class="cleaner"></div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div id="paginador">
                            @if(count($imagenes) > 0)
                            {{ $imagenes->links('paginador') }}
                            @endif
                        </div><!--paginador-->
                    </div><!--tablalibreria-->
                    <div class="cleaner"></div>
                </div> <!--infocont-->
            </div>
        </section>
    </div>

@stop
