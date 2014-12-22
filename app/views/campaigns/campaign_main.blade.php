@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Campañas

@stop

@section('script')

    <script>
        $(function(){
            @if(Input::has('s'))
                @if(Input::get('s') == 'nueva')
                    $('.tab-selector-1').trigger('click');
                @elseif(Input::get('s') == 'borradores')
                    $('.tab-selector-2').trigger('click');
                @elseif(Input::get('s') == 'programadas')
                    $('.tab-selector-3').trigger('click');
                @elseif(Input::get('s') == 'enviadas')
                    $('.tab-selector-4').trigger('click');
                @elseif(Input::get('s') == 'reporte')
                    $('.tab-selector-5').trigger('click');
                @endif
            @endif

            $('.borrarcam').on('click', function(e){
                e.preventDefault();

                var boton = $(this);

                $.ajax({
                    beforeSend: function() {
                        return confirm('Desea eliminar esta campaña?');
                    },
                    url: boton.attr('ajax'),
                    success: function(data) {
                        if(data.status == 'ok') {
                            window.location = boton.attr('href');
                        }
                    }
                });
            });
        });
    </script>

@stop

@section('data')

    @parent
    <input type="hidden" id="menu_principal" value="campanias" />


@stop

@section('contenido')

    <input type="hidden" id="session_url" value="{{ url('session') }}" />
    <?php $configtipos = Config::get('trebolnews.campania.tipo'); ?>
    <?php $configstatus = Config::get('trebolnews.campania.status'); ?>

    <div id="container">
        <section class="tabs">
            <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
            <label for="tab-1" class="tab-label-1">Campa&ntilde;a Nueva</label>
            <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
            <label for="tab-2" class="tab-label-2">Borradores</label>
            <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
            <label for="tab-3" class="tab-label-3">Programadas</label>
            <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4" />
            <label for="tab-4" class="tab-label-4">Enviadas</label>
            <input id="tab-5" type="radio" name="radio-set" class="tab-selector-5" />
            <label for="tab-5" class="tab-label-5">Reporte</label>
            <div class="clear-shadow"></div>
            <div class="content">
                <div class="content-1">
                    <h2>Crear campa&ntilde;as nueva</h2>
                    <div class="infocont">
                        <h3>Creaci&oacute;n de Campa&ntilde;as</h3>
                        <p>En s&oacute;lo unos pocos pasos ud comenzar&aacute; a crear su campa&ntilde;a, podr&aacute; optar por seleccionar campa&ntilde;as pre dise&ntilde;adas, de acuerdo a su categor&iacute;a y utilizar nuestro banco de im&aacute;genes, subir su logo y completar con sus datos para personalizar en env&iacute;o, podr&aacute; subir y utilizar su propia campa&ntilde;a con c&oacute;digo html o subir a nuestra plataforma, desde una direcci&oacute;n url hosteada en su servidor.</p>
                        <a id="campana1" href="{{ route('nueva_campania') }}">
                            <h4>Crea una Campa&ntilde;a</h4>
                            <img src="{{ asset('internas/imagenes/nuevacampana.png') }}" width="180" height="155" alt="nueva campa&ntilde;a">
                            <p>Inicia el proceso, sigue el paso a paso y personaliza tu primer env&iacute;o.</p>
                        </a>
                        <a id="tutorial" href="#">
                            <h4>Tutoriales</h4>
                            <img src="{{ asset('internas/imagenes/tutoriales.png') }}" width="180" height="155" alt="tutoriales">
                            <p>Aprende c&oacute;mo crear tu primera <br>campa&ntilde;a.</p>
                        </a>
                        <div class="cleaner"></div>
                    </div>
                </div>
                <div class="content-2">
                    <h2>Borradores de campa&ntilde;as</h2>
                    <div class="infocont">
                        <div class="submenu">
                            <form>
                                <input  class="search" type="text" name="" placeholder="BUSCAR" name="Search" />
                            </form>
                            <div class="cleaner"></div>
                        </div><!--submenu-->
                        <table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
                            <tr class="primeralinea">
                                <th scope="col" width="100px" >Tipo</th>
                                <th scope="col" >Nombre de Campa&ntilde;a</th>
                                <th scope="col" width="190px">Asunto</th>
                                <th scope="col" width="179px">Fecha de Creaci&oacute;n</th>
                                <th scope="col" width="65px"></th>
                            </tr>
                            @foreach(Auth::user()->campanias()->where('status', '=', 'draft')->get() as $campania)
                                <tr>
                                    <td>{{ Str::title(Config::get('trebolnews.campania.tipo')[$campania->tipo]) }}</td>
                                    <td>{{ $campania->nombre }}</td>
                                    <td>{{ $campania->asunto }}</td>
                                    <td>{{ $campania->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a class="editarcampam" href="{{ route('campania', $campania->id) }}"><img src="{{ asset('internas/imagenes/editarcamania.png') }}" alt="editar campa&ntilde;a" width="25" height="25"></a>
                                        <a class="borrarcam" href="{{ route('campanias') . '?' . http_build_query(array( 's' => 'borradores' )) }}" ajax="{{ route('eliminar_campania', $campania->id) }}"><img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar campa&ntilde;a" width="25" height="25"></a>
                                        <div class="cleaner"></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div> <!--infocont-->
                </div>  <!--content-2-->
                <div class="content-3">
                    <h2>Campa&ntilde;as Programadas</h2>
                    <div class="infocont">
                        <div class="submenu">
                            <form>
                                <input  class="search" type="text" name="" placeholder="BUSCAR" name="Search" />
                            </form>
                            <div class="cleaner"></div>
                        </div><!--submenu-->
                        <table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
                            <tr class="primeralinea">
                                <th scope="col" width="100px" >Tipo</th>
                                <th scope="col" width="310px">Nombre de Campa&ntilde;a</th>
                                <th scope="col" width="459px">Estado</th>
                                <th scope="col" width="65px"></th>
                            </tr>
                            @foreach(Auth::user()->campanias()->where('status', '=', 'programmed')->get() as $campania)
                                <tr>
                                    <td>{{ Str::title($configtipos[$campania->tipo]) }}</td>
                                    <td>{{ $campania->nombre }}</td>
                                    <td>Programada para el d&iacute;a {{ $campania->programacion }}</td>
                                    <td>
                                        <a class="editarcampam" href="{{ route('campania', $campania->id) }}"><img src="{{ asset('internas/imagenes/editarcamania.png') }}" alt="editar campa&ntilde;a" width="25" height="25"></a>
                                        <a class="borrarcam" href="{{ route('eliminar_campania', $campania->id) }}"><img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar campa&ntilde;a" width="25" height="25"></a>
                                        <div class="cleaner"></div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div> <!--infocont-->
                </div> <!--content-3-->
                <div class="content-4">
                    <h2>Campa&ntilde;as Enviadas</h2>
                    <div class="infocont">
                        <div class="submenu">
                            <form>
                                <input  class="search" type="text" name="" placeholder="BUSCAR" name="Search" />
                            </form>
                            <div class="cleaner"></div>
                        </div><!--submenu-->
                        <table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
                            <tr class="primeralinea">
                                <th scope="col" width="100px" >Tipo</th>
                                <th scope="col" width="315px">Nombre de Campa&ntilde;a</th>
                                <th scope="col" width="275px">Asunto</th>
                                <th scope="col" width="179px">Fecha de Envio</th>
                                <th scope="col" width="65px"></th>
                            </tr>
                            @foreach(Auth::user()->campanias()->where('status', '=', 'sent')->get() as $campania)
                                <tr>
                                    <td>{{ Str::title($configtipos[$campania->tipo]) }}</td>
                                    <td>{{ $campania->nombre }}</td>
                                    <td>{{ $campania->asunto }}</td>
                                    <td>{{ $campania->envio == 'direct' ? $campania->created_at : $campania->programacion }}</td>
                                    <td>
                                        <a class="duplicamania" href="/campaigns/{{$campania->id}}/report"><img src="{{ asset('internas/imagenes/duplicamania.png') }}" alt="Ver Reporte" width="25" height="25"></a>
                                        <a class="utilizarcam" href="#"><img src="{{ asset('internas/imagenes/spinner.png') }}" alt="Utilizar Campa&ntilde;a" width="25" height="25"></a>
                                        <div class="cleaner"></div>
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                    </div> <!--infocont-->
                </div><!--content-4-->
                <div class="content-5">
                    <h2>Reporte de Campa&ntilde;as</h2>
                    <div class="infocont">
                        <table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
                            <tr class="primeralinea">
                                <th scope="col" width="100px" >Tipo</th>
                                <th scope="col" width="350px">Nombre de Campa&ntilde;a</th>
                                <th scope="col" width="305px">Asunto</th>
                                <th scope="col" width="255px">Fecha de Envio</th>
                            </tr>
                            <tr>
                                <td>Clasica</td>
                                <td>Newsletter de Noviembre 2013</td>
                                <td>Noticias de Noviembre</td>
                                <td>01 / 11 / 2013</td>
                            </tr>
                        </table>
                        <table width="100%"  cellpadding="0" cellspacing="0" class="reportecampanias" style="margin-top:50px">
                            <tr class="primeralineareport">
                                <th scope="col" width="233.5px">Emails Enviados</th>
                                <th scope="col" width="233.5px">Emails Rebotados</th>
                                <th scope="col" width="233.5px">Emails Abiertos</th>
                                <th scope="col" width="233.5px">Emails Clikeados</th>
                            </tr>
                            <tr class="reporteinfo">
                                <td>959</td>
                                <td>213</td>
                                <td>183</td>
                                <td>24</td>
                            </tr>
                        </table>
                        <table width="100%"  cellpadding="0" cellspacing="0" class="reportecampanias" style="margin-top:50px">
                            <tr style="height:20px"></tr>
                            <tr class="primeralineareport">
                                <th scope="col" width="186.8px">Fowards</th>
                                <th scope="col" width="186.8px">Spam</th>
                                <th scope="col" width="186.8px">Pa&iacute;ses</th>
                                <th scope="col" width="186.8px">Ciudades</th>
                                <th scope="col" width="186.8px">Browsers y OS</th>
                            </tr>
                            <tr class="reporteinfo">
                                <td>48</td>
                                <td>2</td>
                                <td>12</td>
                                <td>74</td>
                                <td>4</td>
                            </tr>
                        </table>
                    </div><!--infocont-->
                </div><!--content-5-->
                <div class="cleaner"></div>
            </div>
        </section>
    </div><!--conteiner-->

@stop