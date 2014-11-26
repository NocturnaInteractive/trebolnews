@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Banco de Im&aacute;genes

@stop

@section('data')

    @parent
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

        $('[rel="gallery"]').fancybox({
            padding: 5,
            margin: [20, 60, 20, 60],
            helpers: {
                overlay: {
                    locked: false
                }
            }
        });

        $('#table-content').on('click', '.banco_ver', function(e){
            e.preventDefault();

            $(this).parents('table').first().find('[rel=gallery]').trigger('click');
        });

        $('#table-content').on('click', '.checkbox', function(e){
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

        $('#btn-subir-a-libreria').one('click', subir_handler);

        function subir_handler(e) {
            e.preventDefault();

            $('#btn-subir-a-libreria').on('click', function(e){
                e.preventDefault();
            });

            $('#frm-subir-a-libreria').append($('.checkbox input:checked').clone()).ajaxSubmit({
                success: function(data) {
                    window.location = data.route;
                },
                complete: function() {
                    $('#frm-subir-a-libreria').html('');
                    $('#btn-subir-a-libreria').one('click', subir_handler);
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
                <h2>Banco de Im&aacute;genes</h2>
                <a id="volver" href="{{ URL::previous() }}"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
                <div class="infocont">
                    <div class="submenu">
                        <ul id="filtrocategoria">
                            <li>
                                <a class="filtro" href="#">CATEGOR&Iacute;AS</a>
                                <ul>
                                    <li><a href="#">Artes</a></li>
                                    <li><a href="#">Gastronom&iacute;a</a></li>
                                    <li><a href="#">Hotel</a></li>
                                    <li><a href="#">Personas</a></li>
                                    <li><a href="#">Tecnolog&iacute;a</a></li>
                                    <li><a href="#">Turismo</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form>
                            <input class="search" type="text" placeholder="BUSCAR" name="Search" />
                        </form>
                        <ul id="subiralibreria_banco">
                            <li>
                                <a href="#" id="btn-subir-a-libreria">SUBIR A LIBRER&Iacute;A</a>
                                <div style="display: none;">
                                    <form id="frm-subir-a-libreria" method="post" action="{{ action('ImagenController@subir_a_libreria') }}">
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <div class="cleaner"></div>
                    </div><!--submenu-->
                    <div id="banco">
                        <div id="submenulibreria">
                            <ul id="filtroselecionados">
                                <li><p>Resultados de <em>&#8220;Lorem ipsum&#8221;</em></p></li>
                            </ul>
                            <ul id="filtrover">
                                <li><a id="filtroiconlinsta" href="banco2.html"><img src="{{ asset('internas/imagenes/filtroiconlinsta.png') }}" width="25" height="25"></a></li>
                                <li><a id="filtroiconimagen" class="apretado" href="banco.html"><img src="{{ asset('internas/imagenes/filtroiconimagen.png') }}" width="25" height="25"></a></li>
                            </ul>
                            <ul id="cantidad">
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
                        <table width="100%" cellpadding="0" cellspacing="10px" class="tablabanco">
                            <tbody id="table-content">
                            {{ $html }}
                            </tbody>
                        </table>
                        <div class="cleaner"></div>
                    </div><!--banco -->
                    <div id="paginador">
                        @if(count($imagenes) > 0)
                            {{ $paginador }}
                        @endif
                    </div><!--paginador-->
                    <div class="cleaner"></div>
                </div> <!--infocont-->
            </div>
        </section>
    </div><!--conteiner-->

@stop
