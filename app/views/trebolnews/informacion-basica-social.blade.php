@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Información básica

@stop

@section('script')
    <script>
        $(function() {
            $('.btn_guardar').one('click', guardar_handler);

            function guardar_handler(e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var boton = $(this);

                boton.on('click', function(e) {
                    e.preventDefault();
                });

                $('#frm_campania').ajaxSubmit({
                    data: {
                        y: boton.attr('y'),
                        paso: 3
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

            $( "#datepicker" ).datepicker({
                prevText: '<',
                nextText: '>',
                dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                dateFormat: 'dd/mm/yy'
            });

            $('[name="radio-set"').on('click', function(e) {
                $('#envio').val($(this).attr('envio'));
            });

            $('.activarydesactivar').on('click', function(e) {
                if($('#compartir').val() == 'on') {
                    $('#compartir').val('');
                } else {
                    $('#compartir').val('on');
                }
            });
        });
    </script>
@stop

@section('contenido')

    <div id="container">
        <section class="tabs">
            <div class="content">
                <h2>Configuraci&oacute;n</h2>
                <a id="volver" href="{{ URL::previous() }}"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
                <div class="infocont">
                    <ul id="pasoscam">
                        <li id="pasocam1">Paso 1<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam2">Paso 2<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam3">Paso 3<div class="linea"></div><div class="circulo  pasosactivado"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam4">Paso 4<div class="linea"></div><div class="circulo"></div></li>
                        <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                        <li id="pasocam5">Paso 5<div class="linea"></div><div class="circulo"></div></li>
                        <div class="cleaner"></div>
                    </ul><!--pasoscam-->
                    <form action="{{ action('CampaniaController@guardar_campania') }}" method="post" id="frm_campania">
                        <input type="hidden" name="paso" value="3" />
                        <div id="info_basica">
                            <h3>Informaci&oacute;n B&aacute;sica</h3>
                            <input type="text" class="text nomcam" name="campania.nombre" placeholder="Nombre de la Campa&ntilde;a:" />
                            <input type="text" class="text" name="campania.asunto" placeholder="Asunto:" />
                            <input type="text" class="text der" name="campania.remitente" placeholder="Nombre del Remitente:" />
                            <input type="text" class="text" name="campania.email" placeholder="Email del Remitente:" />
                            <input type="text" class="text der" name="campania.respuesta" placeholder="Email de Respuesta:" />
                            <div class="cleaner"></div>
                        </div><!--info_basica-->
                        <div id="selecionar_suscriptores">
                            <h3>Selecciona los destinatarios de la Campa&ntilde;a</h3>
                            <div class="submenu">
                                <div>
                                    <input class="search" type="text" placeholder="BUSCAR" />
                                </div>
                                <div class="cleaner"></div>
                            </div><!--submenu-->
                            <table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
                                <tr class="primeralinea">
                                    <th scope="col" width="40px">
                                    <!-- <form class="checkbox">
                                    <input type="checkbox"  id="checkbox1" name="" onclick="marcar(this)" />
                                    <label for="checkbox1"></label>
                                    </form>-->
                                    </th>
                                    <th scope="col" width="355px">Nombre de Lista</th>
                                    <th scope="col" width="250px">Fecha de Creaci&oacute;n
                                        <a href="#" class="flechatabla"></a>
                                    </th>
                                    <th scope="col" width="149px">Editado el</th>
                                    <th scope="col" width="140px">Suscriptores</th>
                                </tr>
                                @foreach($listas = Auth::user()->listas()->has('contactos', '>', '0')->get() as $lista)
                                <tr>
                                    <td>
                                    <div class="checkbox">
                                        <input type="checkbox" id="{{ 'listas['.$lista->id.']' }}" name="campania.listas[]" value="{{ $lista->id }}" />
                                        <label for="{{ 'listas['.$lista->id.']' }}"></label>
                                    </div>
                                    </td>
                                    <td>{{ $lista->nombre }}</td>
                                    <td>{{ $lista->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $lista->updated_at->format('d/m/Y') }}</td>
                                    <td>{{ count($lista->contactos) }}</td>
                                </tr>
                                @endforeach
                                @if(count($listas) > 0)
                                <input type="hidden" name="con_listas" value="on" />
                                @else
                                <tr>
                                    <td colspan="5">
                                        Todavía no has creado contactos en una lista de suscriptores
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div><!--selecionar_suscriptores-->
                        <div id="configurar_redes">
                            <h3>Configuraci&oacute;n de Redes Sociales</h3>
                            <div id="agregar_redes">
                                <div id="mostrar_div">
                                    <a class="activarydesactivar btbmostrar_div" href="#" onclick="ocultar_mostrar('mostrar_div'); return false;">Activar Compartir en:</a>
                                    <div class="divparaocultar"></div>
                                </div>
                                <div id="info_agregar_redes">
                                    <a class="activarydesactivar" href="#" onclick="ocultar_mostrar('mostrar_div'); return false;">Desactivar Compartir en:</a>
                                    <div id="rede_iconos">
                                        <div class="iconosindividuales">
                                            <input type="checkbox" id="facebook_agregar_redes" name="campania.redes[]" value="facebook" />
                                            <label for="facebook_agregar_redes" id="label_facebook_agregar_redes"></label>
                                        </div>
                                        <div class="iconosindividuales">
                                            <input type="checkbox" id="twitter_agregar_redes" name="campania.redes[]" value="twitter" />
                                            <label for="twitter_agregar_redes" id="label_twitter_agregar_redes"></label>
                                        </div>
                                        <div class="iconosindividuales">
                                            <input type="checkbox" id="linkedin_agregar_redes" name="campania.redes[]" value="linkedin" />
                                            <label for="linkedin_agregar_redes" id="label_linkedin_agregar_redes"></label>
                                        </div>
                                        <div class="iconosindividuales">
                                            <input type="checkbox" id="google_agregar_redes" name="campania.redes[]" value="google" />
                                            <label for="google_agregar_redes" id="label_google_agregar_redes"></label>
                                        </div>
                                        <div class="iconosindividuales">
                                            <input type="checkbox" id="pinterest_agregar_redes" name="campania.redes[]" value="pinterest" />
                                            <label for="pinterest_agregar_redes" id="label_pinterest_agregar_redes"></label>
                                        </div>
                                        <div class="iconosindividuales">
                                            <input type="checkbox" id="blogger_agregar_redes" name="campania.redes[]" value="blogger" />
                                            <label for="blogger_agregar_redes" id="label_blogger_agregar_redes"></label>
                                        </div>
                                        <div class="cleaner"></div>
                                        <div class="segundalinea_redes">
                                            <div class="iconosindividuales">
                                                <input type="checkbox" id="meneame_agregar_redes" name="campania.redes[]" value="meneame" />
                                                <label for="meneame_agregar_redes" id="label_meneame_agregar_redes"></label>
                                            </div>
                                            <div class="iconosindividuales">
                                                <input type="checkbox" id="tumblr_agregar_redes" name="campania.redes[]" value="tumblr" />
                                                <label for="tumblr_agregar_redes" id="label_tumblr_agregar_redes"></label>
                                            </div>
                                            <div class="iconosindividuales">
                                                <input type="checkbox" id="reddit_agregar_redes" name="campania.redes[]" value="reddit" />
                                                <label for="reddit_agregar_redes" id="label_reddit_agregar_redes"></label>
                                            </div>
                                            <div class="iconosindividuales">
                                                <input type="checkbox" id="digg_agregar_redes" name="campania.redes[]" value="digg" />
                                                <label for="digg_agregar_redes" id="label_digg_agregar_redes"></label>
                                            </div>
                                            <div class="iconosindividuales">
                                                <input type="checkbox" id="delicious_agregar_redes" name="campania.redes[]" value="delicious" />
                                                <label for="delicious_agregar_redes" id="label_delicious_agregar_redes"></label>
                                            </div>
                                            <div class="cleaner"></div>
                                        </div><!--segundalinea_redes -->
                                    </div>
                                </div>
                            </div><!--fin agregar_redes-->
                            <div id="conectarsearedes">
                                <div id="mostrar_div_conected">
                                    <a class="activarydesactivar btbmostrar_div" href="#" onclick="ocultar_mostrar('mostrar_div_conected'); return false;">Activar Publicar en:</a>
                                    <div class="divparaocultar"></div>
                                </div>
                                <div id="info_conectarse_redes">
                                    <a class="activarydesactivar" href="#" onclick="ocultar_mostrar('mostrar_div_conected'); return false;">Desactivar Publicar en:</a>
                                    <div id="conectar_face" class="conected">
                                        <a href="#">CONECTAR</a>
                                    </div>
                                    <div id="conectar_tw" class="conected">
                                        <a href="#">CONECTAR</a>
                                    </div>
                                    <div class="cleaner"></div>
                                    <div id="conectar_lk" class="conected">
                                        <a href="#">CONECTAR</a>
                                    </div>
                                    <div id="conectar_g" class="conected">
                                        <a href="#">CONECTAR</a>
                                    </div>
                                    <div class="cleaner"></div>
                                </div><!--info_conectarse_redes-->
                            </div><!--conectarsearedes-->
                            <div class="cleaner"></div>
                            <div id="segundasopciones">
                                <div id="plugins_redes">
                                    <div id="mostrar_div_plugins_redes">
                                        <a class="activarydesactivar btbmostrar_div" href="#" onclick="ocultar_mostrar('mostrar_div_plugins_redes'); return false;">Activar Plugins </a>
                                        <div class="divparaocultar"></div>
                                    </div>
                                    <div id="info_plugins_redes">
                                        <a class="activarydesactivar" href="#" onclick="ocultar_mostrar('mostrar_div_plugins_redes'); return false;">Desactivar Plugins </a>
                                        <div id="plugins_iconos">
                                            <div class="iconosindividuales_plugins">
                                                <input type="checkbox" id="facebook_plugins" />
                                                <label for="facebook_plugins" id="label_facebookplugins"></label>
                                            </div>
                                            <div class="iconosindividuales_plugins">
                                                <input type="checkbox" id="twitter_plugins" />
                                                <label for="twitter_plugins" id="label_googleplugins"></label>
                                            </div>
                                            <div class="iconosindividuales_plugins ultimoprinterest">
                                                <input type="checkbox" id="pinterest_plugins" />
                                                <label for="pinterest_plugins" id="label_pinterestplugins"></label>
                                            </div>
                                            <div class="cleaner"></div>
                                        </div>
                                    </div><!--info_plugins_redes-->
                                </div><!--plugins_redes-->
                                <div id="canalrss">
                                    <div id="mostrar_div_canalrss">
                                        <a class="activarydesactivar btbmostrar_div" href="#" onclick="ocultar_mostrar('mostrar_div_canalrss'); return false;">Activar Canal RSS</a>
                                        <div class="divparaocultar"></div>
                                    </div>
                                    <div id="info_canalrss">
                                        <a class="activarydesactivar" href="#" onclick="ocultar_mostrar('mostrar_div_canalrss'); return false;">Desactivar Canal RSS</a>
                                        <div id="texarea_rss">
                                            <textarea name="comentario" placeholder="Descripci&oacute;n:" class="textarea_redes"></textarea>
                                        </div>
                                    </div><!--info_canalrss-->
                                </div><!--canalrss-->
                                <div class="cleaner"></div>
                            </div><!--segundasopciones-->
                        </div><!--fin configurar_redes-->
                        <div id="configurar_envio">
                            <h3>Configurar Env&iacute;o</h3>
                            <div id="pestanias_envio">
                                <input type="hidden" id="envio" name="envio" value="inmediato" />
                                <input id="enviotab-1" type="radio" name="radio-set" class="tab-selector-1" envio="inmediato" checked="checked" />
                                <label for="enviotab-1" class="envio-label-1">
                                    <img src="{{ asset('internas/imagenes/inmediato_social.png') }}" width="107" height="100" alt="envio inmediato">
                                    <h4>Env&iacute;o Inmediato</h4>
                                    <p>La Campa&ntilde;a se enviar&aacute; al momento en el que hagas  click en enviar.</p>
                                    <div class="cleaner"></div>
                                </label>
                                <input id="enviotab-2" type="radio" name="radio-set" class="tab-selector-2" envio="programado" />
                                <label for="enviotab-2" class="envio-label-2">
                                    <img src="{{ asset('internas/imagenes/programar_social.png') }}" width="107" height="100" alt="envio programado">
                                    <h4>Entrega Programada</h4>
                                    <p>La Campa&ntilde;a se enviar&aacute; en la fecha y hora que selecciones.</p>
                                    <div class="cleaner"></div>
                                </label>
                                <div class="clear-shadow"></div>
                                <div class="enviocontent">
                                    <div class="content-1">
                                        <div id="separador_inmediato">
                                            <img src="{{ asset('internas/imagenes/separador.png') }}" width="25" height="20">
                                        </div>
                                        <div class="configuracionenvio_mensaje">
                                            <div class="checkbox">
                                                <input id="checkbox15" type="checkbox" checked="checked" name="notificacion">
                                                <label for="checkbox15"></label>
                                            </div>
                                            <p>Deseo recibir una notificaci&oacute;n cuando la Campa&ntilde;a haya sido enviada.</p>
                                            <div class="cleaner"></div>
                                        </div><!--fin configuracionenvio_mensaje-->
                                    </div><!--fin content-1-->
                                    <div class="content-2">
                                        <div id="separador_programada">
                                            <img src="{{ asset('internas/imagenes/separador.png') }}" width="25" height="20">
                                        </div>
                                        <div id="programar_envio">
                                            <div id="programar_fecha">
                                                <p class="titulo_envio">Fecha:</p>
                                                <div id="fecha-form" action="" method="post">
                                                    <input type="text" id="datepicker" value="FECHA" name="campania:programacion" />
                                                </div>
                                            </div><!--fin programar_fecha-->
                                            <div id="programar_horario">
                                                <p class="titulo_envio">Hora:</p>
                                                <div id="horarioforma" action="" method="post">
                                                    <input type="text" value="12" name="hora" />
                                                    <input type="text" value="00" name="minutos" />
                                                </div>
                                                <select name="meridiano" id="hora" SIZE="1">
                                                    <option value="am" selected="1">AM</option>
                                                    <option value="fm">FM</option>
                                                </select>
                                            </div><!--programar_horario-->
                                            <div id="zona_horaria-div">
                                                <p class="titulo_envio">Zona Horaria:</p>
                                                <select name="pais" id="zona_horaria" SIZE="1">
                                                    <option value="" selected="1">ZONA HORARIA</option>
                                                    <option value="">(GMT-12:00) International Date Line West</option>
                                                    <option value="">(GMT-11:00) Midway Island, Samoa</option>
                                                    <option value="">(GMT-10:00) Hawaii</option>
                                                    <option value="">(GMT-09:00) Alaska</option>
                                                    <option value="">(GMT-08:00) Pacific Time (US & Canada); Tijuana</option>
                                                    <option value="">(GMT-07:00) Mountain Time (US & Canada)</option>
                                                    <option value="">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                    <option value="">(GMT-07:00) Arizona</option>
                                                    <option value="">(GMT-06:00) Central America</option>
                                                    <option value="">(GMT-06:00) Central Time (US & Canada)</option>
                                                    <option value="">(GMT-06:00) Saskatchewan</option>
                                                    <option value="">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                    <option value="">(GMT-05:00) Eastern Time (US & Canada)</option>
                                                    <option value="">(GMT-05:00) Indiana (East)</option>
                                                    <option value="">(GMT-05:00) Bogota, Lima, Quito</option>
                                                    <option value="">(GMT-04:00) Atlantic Time (Canada)</option>
                                                    <option value="">(GMT-04:00) Caracas, La Paz</option>
                                                    <option value="">(GMT-04:00) Santiago</option>
                                                    <option value="">(GMT-03:30) Newfoundland</option>
                                                    <option value="">(GMT-03:00) Brasilia</option>
                                                    <option value="">(GMT-03:00) Buenos Aires, Georgetown</option>
                                                    <option value="">(GMT-03:00) Greenland</option>
                                                    <option value="">(GMT-02:00) Mid-Atlantic</option>
                                                    <option value="">(GMT-01:00) Azores</option>
                                                    <option value="">(GMT-01:00) Cape Verde Is.</option>
                                                    <option class="doble" value="">(GMT 00:00) Greenwich Mean Time : Dublin, Edinburgh, London</option>
                                                    <option value="">(GMT 00:00) Casablanca, Monrovia</option>
                                                    <option value="">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                    <option value="">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                                                    <option value="">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                    <option value="">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                    <option value="">(GMT+01:00) West Central Africa</option>
                                                    <option value="">(GMT+02:00) Bucharest</option>
                                                    <option value="">(GMT+02:00) Cairo</option>
                                                    <option value="">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                                                    <option value="">(GMT+02:00) Athens, Istanbul, Minsk</option>
                                                    <option value="">(GMT+02:00) Jerusalem</option>
                                                    <option value="">(GMT+02:00) Harare, Pretoria</option>
                                                    <option value="">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                    <option value="">(GMT+03:00) Kuwait, Riyadh</option>
                                                    <option value="">(GMT+03:00) Nairobi</option>
                                                    <option value="">(GMT+03:00) Baghdad</option>
                                                    <option value="">(GMT+03:30) Tehran</option>
                                                    <option value="">(GMT+04:00) Abu Dhabi, Muscat</option>
                                                    <option value="">(GMT+04:00) Baku, Tbilisi, Yerevan</option>
                                                    <option value="">(GMT+04:30) Kabul</option>
                                                    <option value="">(GMT+05:00) Ekaterinburg</option>
                                                    <option value="">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                                    <option value="">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                    <option value="">(GMT+05:45) Kathmandu</option>
                                                    <option value="">(GMT+06:00) Astana, Dhaka</option>
                                                    <option value="">(GMT+06:00) Sri Jayawardenepura</option>
                                                    <option value="">(GMT+06:00) Almaty, Novosibirsk</option>
                                                    <option value="">(GMT+06:30) Rangoon</option>
                                                    <option value="">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                    <option value="">(GMT+07:00) Krasnoyarsk</option>
                                                    <option value="">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                    <option value="">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                                    <option value="">(GMT+08:00) Taipei</option>
                                                    <option value="">(GMT+08:00) Perth</option>
                                                    <option value="">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                    <option value="">(GMT+09:00) Seoul</option>
                                                    <option value="">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                    <option value="">(GMT+09:00) Yakutsk</option>
                                                    <option value="">(GMT+09:30) Darwin</option>
                                                    <option value="">(GMT+09:30) Adelaide</option>
                                                    <option value="">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                                                    <option value="">(GMT+10:00) Brisbane</option>
                                                    <option value="">(GMT+10:00) Hobart</option>
                                                    <option value="">(GMT+10:00) Vladivostok</option>
                                                    <option value="">(GMT+10:00) Guam, Port Moresby</option>
                                                    <option value="">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                                    <option value="">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                    <option value="">(GMT+12:00) Auckland, Wellington</option>
                                                    <option value="">(GMT+13:00) Nuku alofa</option>
                                                </select>
                                            </div><!--zona_horaria-div-->
                                            <div class="cleaner"></div>
                                        </div><!--programar_envio-->
                                        <div class="configuracionenvio_mensaje">
                                            <div class="checkbox">
                                                <div>
                                                    <input id="checkbox16" type="checkbox" checked="checked" name="notificacion">
                                                    <label for="checkbox16"></label>
                                                </div>
                                            </div> <p>Deseo recibir una notificaci&oacute;n cuando la Campa&ntilde;a haya sido enviada.</p>
                                            <div class="cleaner"></div>
                                        </div><!--fin configuracionenvio_mensaje-->
                                    </div><!--fin content-2-->
                                </div>
                            </div><!--pestanias_envio-->
                        </div><!--configurar_envio-->
                        <div id="opciones_pasos">
                            <a id="guardarysalir" href="{{ route('campanias') }}" class="btn_guardar" y="salir">GUARDAR Y SALIR</a>
                            <ul>
                                <li><a href="{{ URL::previous() }}" id="anterior">ANTERIOR</a></li>
                                <li><a href="{{ route('paso_4') }}" id="siguiente" class="btn_guardar" y="seguir">SIGUIENTE</a></li>
                            </ul>
                            <div class="cleaner"></div>
                        </div><!--opciones_pasos-->
                    </form>
                </div><!--infocont-->
            </div><!--content-->
        </section>
    </div>

@stop
