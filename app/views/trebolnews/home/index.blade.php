<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrebolNEWS</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo.css') }}" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css' />
    <script src="{{ asset('js/modernizr.custom.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/form.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style2.css') }}" />
    <script type="text/javascript" src="{{ asset('js/modernizr.custom.28468.js') }}"></script>
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
    {{ HTML::script('js/jquery.form.min.js') }}
    {{ HTML::script('js/jquery.noty.packaged.min.js') }}
    {{ HTML::script('js/trebolnews.js') }}
    {{ HTML::style('css/trebolnews.css') }}
    {{ HTML::style('css/general.css') }}

    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
        $(function() {

            $('#login').on('click', function(e) {
                e.preventDefault();
            });

            $('#face').on('click', function(e) {
                e.preventDefault();

                popupWindow($('#face').attr('href'), '', 575, 417);
            });

            $('[btn_menu]').on('click', function(e){
                e.preventDefault();

                $('a[href="' + $(this).attr('btn_menu') + '"]').trigger('click');
            });

        });

</script>
</head>
<body>
    <header>
        <div id="conheader">
            <a href="{{ url('/') }}"><h1>TrebolNEWS</h1></a>

            <div id="menu" class="cbp-fbscroller" >
                <nav>
                    <a href="#fbsection1"></a>
                    <a href="#fbsection2" class="apretado">&iquest;Qu&eacute; es Trebol News?</a>
                    <a href="#fbsection3">Servicios</a>
                    <a href="#fbsection4">&iquest;Por qu&eacute; elegirnos?</a>
                    <a href="#fbsection5">Planes</a>
                    <a href="#fbsection6">Contacto</a>
                    @include('trebolnews/home/login')
                </nav>
                <div class="cleaner"></div>
            </div>

        </div>
        <!-- <div id="chat">
            <button id="showRight">Chatee con un operador</button>

            <div class="cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
                <h3>Consultas</h3><div id="formah3"></div>
                <div class="cleaner"></div>

                <form id="consultachat" action="" method="post">
                    <ul>
                        <li class="izq_consultachat" ><input name="nombre" type="text" placeholder="&nbsp;*Nombre:" /></li>
                        <li class="der_consultachat" ><input name="apellido" type="text" placeholder="&nbsp;*Apellido:" /></li>
                        <div class="cleaner"></div>
                        <li class="izq_consultachat" ><input name="telefono" type="text" placeholder="Tel&eacute;fono:" /></li>
                        <li class="der_consultachat" ><input name="empresa" type="text" placeholder="Empresa:" /></li>
                        <div class="cleaner"></div>
                        <li class="email_chat"><input name="email" type="text" placeholder="&nbsp;*Email:"  /></li>
                        <li><textarea name="comentario" placeholder="&nbsp;*Comentario:"></textarea></li>
                    </ul>

                    <p>*&nbsp;Campos obligatorios </p>

                    <div id="botones_consultachat">
                        <input class="btn" id="borrar" type="reset" value="BORRAR" name="borrar" />
                        <input type="button" value="ENVIAR" name="enviar" id="saveForm" />
                        <div class="cleaner"></div>
                    </div>
                </form>

            </div>

        </div> -->
    </header>
    <div id="conteiner" class="cbp-fbscroller">
        <section id="fbsection1">
            <div id="banner">
                <div id="da-slider" class="da-slider">
                    <div class="da-slide">
                        <h2>Desarrolla, gestiona y env&iacute;a tus campa&ntilde;as de email marketing.</h2>
                        <p>&iexcl;Simple y efectivo!<br>
                            PROBAR GRATIS HASTA 500 ENV&Iacute;OS POR MES.</p>
                            <div class="da-img"><img src="{{ asset('imagenes/banner1.png') }}" width="1280" height="400" /></div>
                        </div>

                        <div class="da-slide">
                            <h2>Accede a un variado cat&aacute;logo de im&aacute;genes gratis.</h2>
                            <p>&iexcl;Aprov&eacute;chalo en todas tus campa&ntilde;as!</p>
                            <div class="da-img"><img src="{{ asset('imagenes/banner2.png') }}" width="1280" height="400" /></div>
                        </div>

                        <div class="da-slide">
                            <h2>Monitorea la evoluci&oacute;n de tu acci&oacute;n de email marketing.</h2>
                            <p>Realiza un seguimiento detallado de los env&iacute;os mediante nuestro s&oacute;lido sistemas de reportes y estad&iacute;sticas.<br>
                                Analiza los resultados para planificar con eficacia tu pr&oacute;xima campa&ntilde;a.</p>
                                <div class="da-img"><img src="{{ asset('imagenes/banner3.png') }}" width="1280" height="400" /></div>
                            </div>

                            <div class="da-slide">
                                <h2>Crea, optimiza y gestiona tu lista de suscriptores.</h2>
                                <p>Administra y segmenta f&aacute;cilmente tus listas de contactos.<br>
                                    Comunica un mensaje personalizado y contundente a tu p&uacute;blico objetivo.</p>
                                    <div class="da-img"><img src="{{ asset('imagenes/banner4.png') }}" width="1280" height="400" /></div>
                                </div>

                                <div class="da-slide">
                                    <h2>Integra tu campa&ntilde;a de email marketing a las redes sociales.</h2>
                                    <p>Potencia la viralidad de tus mensajes y alcanza a toda tu audiencia.</p>
                                    <div class="da-img"><img src="{{ asset('imagenes/banner5.png') }}" width="1280" height="400" /></div>
                                </div>
                                <nav class="da-arrows">
                                    <span class="da-arrows-prev"></span>
                                    <span class="da-arrows-next"></span>
                                </nav>
                            </div>
                            <div class="cleaner"></div>
                        </div><!--banner-->

                        <div id="registrateg">
                            <h2>Es simple, r&aacute;pido &iexcl;y gratis hasta 500 env&iacute;os!</h2>
                            <div id="botgra"><a href="{{ route('registro') }}">REG&Iacute;STRATE GRATIS</a></div>
                        </div>

                    </section>

                    <section id="fbsection2">
                        <div id="fonquees">
                            <h2>&iquest;Qu&eacute; es TrebolNEWS?
                                <div id="tri"><img src="{{ asset('imagenes/flecha.png') }}" alt="flecha" /></div></h2>
                                <div id="quees">
                                    <div id="queinfo">
                                        <div id="txtque"><p>TrebolNews es una plataforma online que te da la posibilidad de crear campa&ntilde;as de email marketing, enviarlas a tu base de datos e integrarlas a las redes sociales, y hacer un seguimiento completo a trav&eacute;s de un poderoso sistema de reportes y estad&iacute;sticas. &iexcl;Todo de manera simple y &aacute;gil!
                                            La plataforma ofrece plantillas predise&ntilde;adas y un banco de im&aacute;genes para usar de manera gratuita en tus campa&ntilde;as. En caso de que desees un dise&ntilde;o exclusivo para tu newsletter, nuestro equipo de profesionales lo elaborar&aacute;. Si ya dispones de un dise&ntilde;o de newsletter, podr&aacute;s importar el c&oacute;digo html y utilizarlo en tus env&iacute;os.</p> <p id="txtque_sub">&iquest;C&oacute;mo se usa TrebolNews? &iexcl;En solo cuatro pasos!</p>
                                        </div>
                                        <img class="iconoque"  id="monitor" src="{{ asset('imagenes/monitor.png') }}" width="240" height="240" alt="icono de monitor">
                                        <div class="txtpaso" id="texpaso1"><p><span><span>1</span> Paso</span><br>Crea tu cuenta y establece la cantidad de env&iacute;os que quieres hacer.</p></div>
                                        <img class="iconoque" id="carta" src="{{ asset('imagenes/carta.png') }}" width="210" height="210" alt="icono de carta">
                                        <img class="iconoque" id="noticias" src="{{ asset('imagenes/noticias.png') }}" width="210" height="210" alt="icono de noticias">
                                        <img class="iconoque" id="mapa" src="{{ asset('imagenes/mapa.png') }}" width="210" height="210" alt="icono de mapa">
                                        <img class="iconoque" id="fotos" src="{{ asset('imagenes/fotos.png') }}" width="210" height="210" alt="icono de fotos">
                                        <div class="txtpaso" id="texpaso2"><p><span><span>2</span> Paso</span><br>Elige una plantilla de dise&ntilde;o o importa tu propio html dise&ntilde;ado.</p></div>
                                        <img class="iconoque" id="gente" src="{{ asset('imagenes/gente.png') }}" width="240" height="240" alt="icono de gente">
                                        <img class="iconoque" id="sobre" src="{{ asset('imagenes/sobre.png') }}" width="240" height="240" alt="icono de sobre">
                                        <div class="txtpaso" id="texpaso3"><p><span><span>3</span> Paso</span><br>Env&iacute;a la campa&ntilde;a a tu base de datos.</p></div>
                                        <img class="iconoque" id="datos" src="{{ asset('imagenes/datos.png') }}" width="240" height="240" alt="icono de datos">
                                        <div class="txtpaso" id="texpaso4"><p><span><span>4</span> Paso</span><br>Haz un seguimiento de reportes y estad&iacute;sticas.</p></div>
                                    </div><!--queinfo-->
                                </div><!--quees-->
                            </div><!--fonquees-->
                        </section>

                        <section id="fbsection3">
                            <div id="servicios">
                                <h2>Servicios</h2>
                                <p>&iquest;Qu&eacute; servicios ofrece TrebolNews?</p>
                                <div id="serarriba">

                                    <div class="servinter">
                                        <img src="{{ asset('imagenes/1serv.png') }}" width="164" height="80" alt="icono">
                                        <h6>Editor de plantilla:</h6><p>Arma tu dise&ntilde;o de manera sencilla y eficiente.</p>
                                    </div>
                                    <div class="servinter">
                                        <img src="{{ asset('imagenes/2serv.png') }}" width="164" height="80" alt="icono">
                                        <h6>Banco de im&aacute;genes:</h6><p>Elige entre un abanico de im&aacute;genes.</p>
                                    </div>
                                    <div class="servinter">
                                        <img src="{{ asset('imagenes/3serv.png') }}" width="164" height="80" alt="icono">
                                        <h6>Newsletter</h6><p>Sube tu newsletter en html y ed&iacute;talo online. Revisa c&oacute;mo lucir&aacute; tu campa&ntilde;a antes de enviarla.</p>
                                    </div>
                                    <div class="servinter">
                                        <img src="{{ asset('imagenes/4serv.png') }}" width="164" height="80" alt="icono">
                                        <h6>Historial:</h6><p>Accede al historial de campa&ntilde;as que has creado.</p>
                                    </div>
                                    <div class="servsin">
                                        <img src="{{ asset('imagenes/5serv.png') }}" width="164" height="80" alt="icono">
                                        <h6>Viralizaci&oacute;n:</h6><p>Integra tu campa&ntilde;a a las redes sociales para ampliar el alcance de tus emails.</p>
                                    </div>
                                    <div class="cleaner"></div>

                                </div><!--serarriba-->

                                <div id="serabajo">

                                    <div class="servinter">
                                        <img src="{{ asset('imagenes/6serv.png') }}" width="164" height="80" alt="icono">
                                        <h6>Programaci&oacute;n de env&iacute;os:</h6><p>Define en qu&eacute; tiempos y horarios quieres expedir tus mensajes, cuantas veces necesites.</p>
                                    </div>
                                    <div class="servinter">
                                        <img src="{{ asset('imagenes/7serv.png') }}" width="164" height="80" alt="icono">
                                        <h6>Reenv&iacute;o autom&aacute;tico:</h6><p>Vuelve a enviar tus publicaciones de manera autom&aacute;tica.</p>
                                    </div>
                                    <div class="servinter">
                                        <img src="{{ asset('imagenes/8serv.png') }}" width="164" height="80" alt="icono">
                                        <h6>Base de datos:</h6><p>Importa tu base de datos y ed&iacute;tala online.</p>
                                    </div>
                                    <div class="servinter">
                                        <img src="{{ asset('imagenes/9serv.png') }}" width="164" height="80" alt="icono">
                                        <h6>Reportes y estad&iacute;sticas:</h6><p>Monitorea constante-<br>mente los resultados de tu campa&ntilde;a. Mide su impacto con Google Analytics.</p>
                                    </div>
                                    <div class="servsin">
                                        <img src="{{ asset('imagenes/10serv.png') }}" width="164" height="80" alt="icono">
                                        <h6>Soporte t&eacute;cnico:</h6><p>Ante cualquier emergencia o consulta, comun&iacute;cate con nuestro soporte t&eacute;cnico mediante el chat online.</p>
                                    </div>
                                    <div class="cleaner"></div>

                                </div><!--serabajo-->

                            </div><!--servicios-->
                        </section>

                        <section id="fbsection4">
                            <div id="porque">
                                <h2>&iquest;Por qu&eacute; elegirnos?</h2>
                                <div id="porinfo">
                                    <div id="tecno" class="porinfoespacio">
                                        <img src="{{ asset('imagenes/1porq.png') }}" width="80px" height="80px" alt="icono">
                                        <h5>TECNOLOG&Iacute;A</h5>
                                        <p>Porque contamos con una herramienta online robusta y confiable, hosteada en servidores con filtros antivirus, que puedes utilizar en los distintos dispositivos, sean PC, tablets o smartphones.</p>
                                    </div>
                                    <div id="envio" class="porinfoespacio">
                                        <img src="{{ asset('imagenes/2porq.png') }}" width="80px" height="80px" alt="icono">
                                        <h5>ENV&Iacute;OS</h5>
                                        <p>Porque garantizamos m&eacute;todos de env&iacute;o veloces, seguros y efectivos. La configuraci&oacute;n de la herramienta se almacena en nuestra nube y se implementa en los tiempos establecidos.</p>
                                    </div>
                                    <div id="soporte" class="porinfoespacio">
                                        <img src="{{ asset('imagenes/3porq.png') }}" width="80px" height="80px" alt="icono">
                                        <h5>SOPORTE T&Eacute;CNICO ONLINE</h5>
                                        <p>Porque, dispones de un chat online que te guiar&aacute; paso a paso en lo que necesites para configurar o enviar tu campa&ntilde;a.</p>
                                    </div>
                                    <div id="seguridad" class="porinfo">
                                        <img src="{{ asset('imagenes/4porq.png') }}" width="80px" height="80px" alt="icono">
                                        <h5>SEGURIDAD</h5>
                                        <p>Como la seguridad de la plataforma es nuestra prioridad y queremos que nuestros usuarios se sientan tranquilos, trabajamos con potentes filtros antivirus y permanentemente hacemos pruebas para verificar la calidad de la seguridad de nuestro propio sistema.</p>
                                    </div>
                                    <div class="cleaner"></div>
                                </div>
                            </div><!--porque-->
                        </section>

                        <section id="fbsection5">
                            <h2>Planes y Precios</h2>
                            <div id="planes">
                                <select class="select-precios" id="planes-home">
                                    <option value="pesos">Pesos Argentinos</option>
                                    <option value="dolares">Dolares estadounidenses</option>
                                </select>
                                <script>
                                    var moneda = 'pesos';
                                    function precio(moneda){
                                        switch(moneda){
                                            case 'pesos':
                                                $('.moneda').html('$');
                                                break;
                                            case 'dolares':
                                                $('.moneda').html('U$S');
                                                break;
                                        }
                                    }

                                    $( ".select-precios" ).change(function() {
                                        precio( $(this).val() );
                                    });
                                    $(document).ready(function(){
                                        precio('pesos');
                                    });
                                </script>
                                <div id="pfree">
                                    <h3>Plan Gratuito</h3>
                                    <p>Dise&ntilde;ado para negocios o proyectos peque&ntilde;os, este plan permite experimentar la plataforma y los servicios que ofrece TrebolNews.<br>No se requieren los datos de la tarjeta de cr&eacute;dito. &iexcl;Prueba gratis hasta 500 env&iacute;os!</p>
                                    <div class="infoplanes">
                                        <div class="verdeinfo">
                                            <h4>
                                                <span class="hastaplan">Hasta</span>
                                                <img src="{{ asset('imagenes/plane.png') }}" width="18px" height="18px" alt="icono">500
                                                <div class="cleaner"></div>
                                                <span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;Gratis</span>
                                            </h4>
                                        </div>
                                        <div class="grisinfo"><img class="xicon" src="{{ asset('imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
                                        <div class="verdeinfo"><img class="xicon" src="{{ asset('imagenes/cruziconverde.png') }}" width="38px" height="38px" alt="icono"></div>
                                        <div class="grisinfo"><img class="xicon" src="{{ asset('imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
                                        <div class="verdeinfo"><img class="xicon" src="{{ asset('imagenes/cruziconverde.png') }}" width="38px" height="38px" alt="icono"></div>
                                        <div class="grisinfo"><img class="xicon" src="{{ asset('imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
                                        <div class="verdeinfo"><img class="xicon" src="{{ asset('imagenes/cruziconverde.png') }}" width="38px" height="38px" alt="icono"></div>
                                    </div><!--infoplanes-->
                                </div><!--pfree-->

                                <div id="individual">
                        <h3>Plan Individual</h3>
                        <p>Exclusivo paquete preparado para realizar envíos con poca frecuencia. S contrata la cantidad de envíos que necesite. No hay límite de tiempo ni vencimientos de la compra.<br> </p>
                        <div class="infoplanes">
                            <?php
                            $class = 'verde';
                            $icon = '';
                            $i = 0;
                            foreach ($plans as $plan) {
                                if (!$plan->isSuscription) {
                            ?>
                            <div class="{{ $class }}info single plan">
                                <div class="radioplanes radioplanes_corto">
                                    <input type="radio" name="opcion" tipo-plan="envio" data-plan="{{ $plan->id }}" data-plan-name="{{ $plan->nombre }}" />
                                    <label></label>
                                </div>
                                <h4><span class="hastaplan">Hasta</span><img src="imagenes/plane{{ $icon }}.png" width="18px" height="18px" alt="icono">{{ $plan->envios }}</h4>
                                <div class="cleaner"></div>
                                <h4 class="segundalinea_plan"><span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;<span class="moneda"></span><span class="price" data-price="{{ $plan->precio }}">{{ $plan->precio }}</span></span></h4>
                                <div class="cleaner"></div>
                            </div>
                            <?php
                                $class = ($class==='verde')? 'gris' : 'verde';
                                $icon = ($icon==='')? 'gris' : '';
                                $i++;
                                }
                            }
                            ?>
                        </div><!--infoplanes-->
                    </div><!--individual-->
                    <div id="mensuales">
                        <h3>Planes Mensuales</h3>
                        <p>Ideal para grandes envíos de campañas. Se abona sólo la cantidad de suscriptores que necesita. Además, no hay límite de envíos. Estos planes tienen una validez de 30 día para ser consumidos.</p>
                        <div class="infoplanes">
                            <?php
                            $class = 'verde';
                            $icon = '';
                            $i = 0;
                            foreach ($plans as $plan) {
                                if ($plan->isSuscription) {
                            ?>
                            <div class="{{ $class }}info suscription plan">
                                <div class="radioplanes radioplanes_corto">
                                    <input type="radio" id="radio{{ $i }}" name="opcion" tipo-plan="suscriptor" data-plan="{{ $plan->id }}" data-plan-name="{{ $plan->nombre }}" />
                                    <label for="radio{{ $i }}"></label>
                                </div>
                                <h4><span class="hastaplan">Hasta</span><img src="imagenes/plane{{$icon}}.png" width="18px" height="18px" alt="icono">{{$plan->envios}}</h4>
                                <div class="cleaner"></div>
                                <h4 class="segundalinea_plan"><span class="hastaenv">Suscriptores</span><span class="precioplan">&nbsp;<span class="moneda"></span><span class="price" data-price="{{ $plan->precio }}">{{ $plan->precio }}</span></span></h4>
                                <div class="cleaner"></div>
                            </div>
                            <?php
                                $class = ($class === 'verde') ? 'gris' : 'verde';
                                $icon = ($icon === '') ? 'gris' : '';
                                $i++;
                                }
                            }
                            ?>

                        </div><!--infoplanes-->
                    </div><!--mensuales-->

                                <div class="content-comprar-ahora">
                                        <div class="bot">
                                            <a href="{{ route('registro') }}" class="botondecompra">COMPRAR AHORA</a>
                                            <div class="cleaner"></div>
                                        </div>
                                    </div>
                                <div class="cleaner"></div>
                            </div><!--planes-->

                            <div id="planesexclusivos">
                                <h5>&iquest;Necesitas alg&uacute;n plan a medida? &iexcl;Cont&aacute;ctanos!</h5>
                                <div id="botex"><a href="#" btn_menu="#fbsection6">CONTACTO</a></div>
                            </div><!--planesexclusivos-->

                            <div id="formasdepago">
                                <h6>Medios de pagos online</h6>
                                <img src="{{ asset('imagenes/formasdepago.png') }}" width="1024" height="80" alt="formas de pago">
                                <div class="cleaner"></div>
                            </div><!--formasdepago-->

                        </section>


                        <section id="fbsection6">
                            <div id="contacto">
                                <h2>Contacto</h2>
                                @include('trebolnews.home.contacto')
                            </div><!--fin contacto-->
                            <div class="cleaner"></div>
                        </section>

                        <div id="foo">
                            <div id="foo_text">
                                <div id="foo_izq">
                                    <h6>TrebolNEWS</h6>
                                    <p>www.trebolnews.com - Copyright 2014</p>
                                </div>
                                <div id="foo_der"> <a href="{{ Config::get('trebolnews.social.pages.twitter') }}" class="twe">Seguinos por Tweter</a> <a href="{{ Config::get('trebolnews.social.pages.facebook') }}" class="face">Estamos en Facebook</a>
                                    <script>
                                    $(function(){
                                        $('#frm_suscripcion #button').one('click', suscripcion_handler);

                                        function suscripcion_handler(e) {
                                            e.preventDefault();

                                            $('#frm_suscripcion #button').on('click', function(e){
                                                e.preventDefault();
                                            });

                                            $('#frm_suscripcion').ajaxSubmit({
                                                success: function(data) {
                                                    if(data.status == 'ok') {
                                                        noty({
                                                            type: 'success',
                                                            text: data.mensaje,
                                                            layout: 'topCenter',
                                                            timeout: 5000,
                                                            maxVisible: 10
                                                        });
                                                        $('#frm_suscripcion')[0].reset();
                                                    } else {
                                                        notys(data.validator);
                                                    }
                                                },
                                                complete: function() {
                                                    $('#frm_suscripcion #button').one('click', suscripcion_handler);
                                                }
                                            });
                                        }
                                    });
                                    </script>
                                    <form id="frm_suscripcion" method="post" action="{{ action('ExtraController@guardar_suscripcion') }}">
                                        <input type="text" name="email" class="compo-form" id="newsletter" placeholder="Suscr&iacute;bete a nuestro Newsletter"  style=" color:#FFF; font-size:12px;"  />
                                        <input type="submit" id="button" value="ENVIAR" />
                                    </form>
                                    <div class="cleaner"></div>
                                </div>
                                <div class="cleaner"></div>
                                <div id="botones_footer">
                                    <ul>
                                        <li><a href="#" btn_menu="#fbsection2">Nosotros</a></li>
                                        <!-- <li><a href="#">Trabaj&aacute; con Nosotros</a></li> -->
                                        <li><a href="#" btn_menu="#fbsection4">&iquest;Por qu&eacute; Elegirnos?</a></li>
                                        <li><a href="#" btn_menu="#fbsection5">Planes y Precios</a></li>
                                        <li><a href="#" btn_menu="#fbsection6">Contacto</a></li>
                                        <li><a href="{{ route('tyc') }}" class="ultimo_boton_footer" target="_blank">Terminos y Condiciones</a></li>
                                    </ul>
                                    <div class="cleaner"></div>
                                </div>
                                <!--botones_footer-->
                            </div>
                            <!--fin de foo_text-->
                        </div>
                        <!--fin de footer-->






                    </div><!--fin conteiner-->

                    <!--banner-->
                    <script type="text/javascript" src="{{ asset('js/jquery.cslider.js') }}"></script>
                    <script type="text/javascript">
                        $(function() {

                            $('#da-slider').cslider({
                                autoplay  : true,
                                bgincrement : 450
                            });

                        });
                    </script>
                    <!--banner-->





                    <!--scroll-->
                    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>--><!--scadao por el slider-->
                    <!-- jquery.easing by http://gsgd.co.uk/ : http://gsgd.co.uk/sandbox/jquery/easing/ -->
                    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
                    <!-- waypoints jQuery plugin by http://imakewebthings.com/ : http://imakewebthings.com/jquery-waypoints/ -->
                    <script src="{{ asset('js/waypoints.min.js') }}"></script>
                    <!-- jquery-smartresize by @louis_remi : https://github.com/louisremi/jquery-smartresize -->
                    <script src="{{ asset('js/jquery.debouncedresize.js') }}"></script>
                    <script src="{{ asset('js/cbpFixedScrollLayout.min.js') }}"></script>
                    <script>
                        $(function() {
                            cbpFixedScrollLayout.init();
                        });
                    </script>
                    <!--scroll-->









                    <!--chat-->
                    <script src="{{ asset('js/chat.js') }}"></script>
                    <script>
                        // var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
                        // showRight = document.getElementById( 'showRight' ),
                        // showTop = document.getElementById( 'showTop' ),
                        // body = document.body;

                        // showRight.onclick = function() {
                        //     classie.toggle( this, 'active' );
                        //     classie.toggle( menuRight, 'cbp-spmenu-open' );
                        //     disableOther( 'showRight' );
                        // };

                        // function disableOther( button ) {

                        //     if( button !== 'showRight' ) {
                        //         classie.toggle( showRight, 'disabled' );
                        //     }
                        // }
                    </script>
                    <!--chat-->





                    <!--explorer placeholder-->

                    <script type="text/javascript">
                        /* <![CDATA[ */
                        $(function() {
                            var input = document.createElement("input");
                            if(('placeholder' in input)==false) {
                                $('[placeholder]').focus(function() {
                                    var i = $(this);
                                    if(i.val() == i.attr('placeholder')) {
                                        i.val('').removeClass('placeholder');
                                        if(i.hasClass('password')) {
                                            i.removeClass('password');
                                            this.type='password';
                                        }
                                    }
                                }).blur(function() {
                                    var i = $(this);
                                    if(i.val() == '' || i.val() == i.attr('placeholder')) {
                                        if(this.type=='password') {
                                            i.addClass('password');
                                            this.type='text';
                                        }
                                        i.addClass('placeholder').val(i.attr('placeholder'));
                                    }
                                }).blur().parents('form').submit(function() {
                                    $(this).find('[placeholder]').each(function() {
                                        var i = $(this);
                                        if(i.val() == i.attr('placeholder'))
                                            i.val('');
                                    })
                                });
                            }
                        });


</script>

<!--explorer placeholder-->
<div id="popup">

</div>
</body>
</html>
