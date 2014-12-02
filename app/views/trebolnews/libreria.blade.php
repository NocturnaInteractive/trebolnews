@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Librería

@stop

@section('data')

    @parent
    <input type="hidden" id="id_carpeta" value="{{ isset($carpeta_seleccionada) ? $carpeta_seleccionada->id : '' }}" />
    <input type="hidden" id="menu_principal" value="librerias" />

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

        $('[controles]').hide();

        $('[rel="gallery"]').fancybox({
            padding: 5,
            margin: [20, 60, 20, 60],
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });

        $('#table').on('click', '.ver_libreria', function(e){
            e.preventDefault();
            $(this).parents('tr').find('[rel="gallery"]').trigger('click');
        });

        $('#table').on('click', '.banco_ver', function(e){
            e.preventDefault();
            $(this).parents('td').find('[rel="gallery"]').trigger('click');
        });

        $('#table').on('click', '.checkbox', function(e){
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
                $('[controles]').show();
            } else {
                $('[controles]').hide();
            }
        });

        $('#borrarselecionados').one('click', borrar_handler);

        function borrar_handler(e) {
            e.preventDefault();

            $('#borrarselecionados').on('click', preventDefault);

            $('<form></form>').hide()
                .attr('method', 'post')
                .attr('action', $('#borrarselecionados').attr('action'))
                .append($('[name="chk_imagen[]"]:checked').clone())
                .ajaxSubmit({
                    data: {
                        id_carpeta: $('#id_carpeta').val()
                    },
                    success: function(data) {
                        if(data.status == 'ok') {
                            location.reload();
                        }
                    },
                    complete: function() {
                        $('#borrarselecionados').one('click', borrar_handler);
                    }
                });
        }

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
                                <li><a id="btn_mipc" href="#" popup="{{ url('popup/libreria_mipc') }}">Mi PC</a></li>
                                <!-- <li><a id="btn_redes" href="subir" popup="{{ url('popup/libreria_redes') }}">Redes Sociales</a></li> -->
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
                            <li><a href="{{ route('librerias') }}" id="filtrotodo" {{ isset($carpeta_seleccionada) ? '' : 'class="apretado"' }}>Todo <span>({{ $total }})</span></a></li>
                            <li><a href="{{ route('carpeta', $carpeta_mis_imagenes->id) }}" id="filtroimag" {{ isset($carpeta_seleccionada) ? ( $carpeta_seleccionada->id == $carpeta_mis_imagenes->id ? 'class="apretado"' : '' ) : '' }}>{{ Str::title($carpeta_mis_imagenes->descripcion) }} <span>({{ count($carpeta_mis_imagenes->imagenes) }})</span></a></li>
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
                                <li><p>Seleccionados: <span id="span_seleccionados">0</span> de <span id="txt-total">{{ count($imagenes) }}</span></p></li>
                                @if(isset($carpeta_seleccionada) && $carpeta_seleccionada->id != 1)
                                <li controles ><a id="agregarcapeta" href="#" popup="{{ url('popup/mover_imagen', $carpeta_seleccionada->id) }}">Mover a</a></li>
                                <li controles ><a id="borrarselecionados" href="#" action="{{ action('ImagenController@trash') }}">Eliminar</a></li>
                                @endif
                            </ul>
                            <ul id="filtrover">
                                <li><a id="filtroiconlinsta" href="#" {{ $type == 'list' ? 'class="apretado"' : '' }} preference="libreria_view.list" ><img src="{{ asset('internas/imagenes/filtroiconlinsta.png') }}" width="25" height="25"></a></li>
                                <li><a id="filtroiconimagen" href="#" {{ $type == 'grid' ? 'class="apretado"' : '' }} preference="libreria_view.grid" ><img src="{{ asset('internas/imagenes/filtroiconimagen.png') }}" width="25" height="25"></a></li>
                            </ul>
                            <ul id="cantidad">
                                <li>
                                    <a href="#" class="boton">VER</a>
                                    <ul>
                                        <li><a href="#" preference="cant_libreria.8">8</a></li>
                                        <li><a href="#" preference="cant_libreria.16">16</a></li>
                                        <li><a href="#" preference="cant_libreria.48">48</a></li>
                                        <li><a href="#" preference="cant_libreria.96">96</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="cleaner"></div>
                        </div><!-- submenulibreria -->
                        <div id="table">
                            {{ $html }}
                        </div>
                        <div id="paginador">
                            @if(count($imagenes) > 0)
                                {{ $imagenes->links('trebolnews.paginador-ajax') }}
                            @endif
                        </div><!--paginador-->
                    </div><!--tablalibreria-->
                    <div class="cleaner"></div>
                </div> <!--infocont-->
            </div>
        </section>
    </div>

@stop
