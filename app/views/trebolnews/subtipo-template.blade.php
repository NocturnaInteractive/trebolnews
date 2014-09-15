@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Emails prediseñados

@stop

@section('data')

    @parent
    <input type="hidden" id="menu_principal" value="campanias" />

@stop

@section('script')
    <script>
    $(function(){

            $('.btn_guardar').one('click', guardar_handler);

            function guardar_handler(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                $(this).on('click', function(e) {
                    e.preventDefault();
                });

                var boton = $(this);

                $('#frm_campania').ajaxSubmit({
                    data: {
                        y: boton.attr('y'),
                        paso: 4
                    },
                    success: function(data) {
                        if(data.status == 'ok') {
                            window.location = boton.attr('href');
                        } else {
                            notys(data.validator);
                        }
                    },
                    complete: function() {
                        $('.btn_guardar').one('click', guardar_handler);
                    }
                });
            }

        $('.tabla_template [chk]').on('click', function(e){
            e.preventDefault();

            $(this).find('input').prop('checked', true)
        });

    });
    </script>
@stop

@section('contenido')

    <div id="container">
        <section class="tabs">
            <div class="content">
                <h2>Emails Predise&ntilde;ados</h2>
                <a id="volver" href="#"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
                <div class="infocont">
                    <ul id="pasoscam">
                        <li id="pasocam1">Paso 1<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam2">Paso 2<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam3">Paso 3<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam4">Paso 4<div class="linea"></div><div class="circulo pasosactivado"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam5">Paso 5<div class="linea"></div><div class="circulo"></div></li>
                        <div class="cleaner"></div>
                    </ul><!--pasoscam-->
                    <div class="submenu">
                        <ul id="filtrocategoria">
                            <li><a class="filtro" href="#">CATEGOR&Iacute;AS</a>
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
                            <input  class="search" type="text" placeholder="BUSCAR" name="Search" />
                        </form>
                        <ul id="cantidad_template">
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
                    </div><!--submenu-->
                    <table width="100%"  cellpadding="0" cellspacing="10px" class="tabla_template">
                        <form action="{{ action('CampaniaController@guardar_campania') }}" id="frm_campania" method="post">
                        <?php $por_fila = 4; $i = 1; ?>
                        @foreach($templates as $template)
                            @if($i % $por_fila == 1)
                            <tr>
                            @endif
                                <td>
                                    <table cellpadding="0" cellspacing="0">
                                        <tr class="temple_opciones" height="20px">
                                            <th scope="col"></th>
                                            <th scope="col" width="30px">
                                                <div class="radio" chk>
                                                    <input type="radio" name="campania:template" value="{{ $template->id }}" />
                                                    <label for="template"></label>
                                                </div>
                                            </th>
                                            <th scope="col" width="25px"><a class="temple_ver" href="{{ route('preview', $template->id) }}">ver</a></th>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <a class="temple_img" href="#">
                                                    <label for="radio1">
                                                        <img src="{{ asset('internas/imagenes/template-1.jpg') }}" width="150" height="190">
                                                    </label>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            @if($i % $por_fila == 0 || $i == count($templates))
                            </tr>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                        </form>
                    </table>
                    <div class="cleaner"></div>
                    <div id="paginador">
                        @if(count($templates) > 0)
                            {{ $templates->links('paginador') }}
                        @endif
                    </div><!--paginador-->
                    <div class="cleaner"></div>
                    <div id="opciones_pasos" class="opciones_paso4">
                        <a id="guardarysalir" href="{{ route('campanias') }}" class="btn_guardar" y="salir">GUARDAR Y SALIR</a>
                        <ul>
                            <li><a href="{{ route('paso_3') }}" id="anterior">ANTERIOR</a></li>
                            <li><a href="{{ route('paso_5') }}" id="siguiente" class="btn_guardar" y="seguir">SIGUIENTE</a></li>
                        </ul>
                        <div class="cleaner"></div>
                    </div><!--opciones_pasos-->
                </div> <!--infocont-->
            </div>
        </section>
    </div>

@stop
