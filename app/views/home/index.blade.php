<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <title>TrebolNEWS</title>

        <link rel="shortcut icon" href="favicon.ico">
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css' />
        {{ HTML::style('home/css/estilo.css') }}
        {{ HTML::style('home/css/form.css') }}
        {{ HTML::style('home/css/style2.css') }}

        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        {{ HTML::script('js/jquery.form.min.js') }}
        {{ HTML::script('js/jquery.noty.packaged.min.js') }}
        {{ HTML::script('home/js/modernizr.custom.js') }}
        {{ HTML::script('home/js/js/modernizr.custom.28468.js') }}
        {{ HTML::script('home/js/js/jquery.cslider.js') }}
        {{ HTML::script('home/js/jquery.easing.min.js') }}
        {{ HTML::script('home/js/waypoints.min.js') }}
        {{ HTML::script('home/js/jquery.debouncedresize.js') }}
        {{ HTML::script('home/js/cbpFixedScrollLayout.min.js') }}
        <script>
        $(function() {
            $('#loginentrar').one('click', login_handler);

            function login_handler(e) {
                e.preventDefault();

                $('#loginentrar').on('click', function(e) {
                    e.preventDefault();
                });

                $('#frm_login').ajaxSubmit({
                    beforeSubmit: function() {
                        $('*').css('cursor', 'wait');
                    },
                    success: function(data) {
                        if(data.status == 'ok') {
                            location.reload();
                        } else {
                            $('#validator').css('display', 'none');
                            if(data.validator) {
                                $.each(data.validator, function(i, v) {
                                    $('#validator').text(v);
                                    return false;
                                    // noty({
                                    //     text: v,
                                    //     layout: 'topCenter',
                                    //     timeout: 5000
                                    // });
                                });
                                $('#validator').fadeIn(50, function(){
                                    setTimeout(function(){
                                        $('#validator').fadeOut(50, function() {
                                            $('#validator').text('').css('display', 'block');
                                        });
                                    }, 5000)
                                });
                            } else {
                                $('#validator').text(data.mensaje);
                                $('#validator').fadeIn(50, function(){
                                    setTimeout(function(){
                                        $('#validator').fadeOut(50, function(){
                                            $('#validator').text('').css('display', 'block');
                                        });
                                    }, 5000)
                                });
                                // noty({
                                //     text: data.mensaje,
                                //     layout: 'topCenter',
                                //     timeout: 5000
                                // });
                            }
                        }
                    },
                    complete: function() {
                        $('#loginentrar').one('click', login_handler);
                        $('*').css('cursor', 'auto');
                    }
                });
            }

            $('#frm_login input').on('keypress', function(e) {
                if(e.which == 13) {
                    $('#loginentrar').trigger('click');
                }
            });

            $('#login').on('click', function(e) {
                e.preventDefault();
            });

            $('#face').on('click', function(e) {
                e.preventDefault();

                FB.getLoginStatus(function(response) {
                    if(response.status === 'connected') {
                        FB.api('/me', function(response) {
                            login_con_fb(response);
                        });
                    } else if(response.status == 'not_authorized') {
                        FB.login(function(response) {
                            if(response.status === 'connected') {
                                FB.api('/me', function(response) {
                                    login_con_fb(response);
                                });
                            }
                        });
                    } else {
                        FB.login(function(response) {
                            if(response.status === 'connected') {
                                login_con_fb(response);
                            }
                        });
                    }
                });
            });
        });

        function login_con_fb(response) {
            $.ajax({
                url: $('#face').attr('ajax'),
                type: 'post',
                data: response,
                success: function(data) {
                    if(data.status == 'ok') {
                        location.reload();
                    }
                }
            });
        }
        </script>
    </head>

    <body>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
            appId: '594990277275305',
            xfbml: true,
            version: 'v2.0'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_LA/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

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
                    <div id="sublogin"><a href="#" id="login"><img src="{{ asset('home/imagenes/iconlogin.png') }}" width="12px" height="14px" alt="icono de login">Iniciar Sesi&oacute;n</a>
                    <ul>
                        <span id="subflecha"></span>
                        <div id="formasublogin">
                            <form id="frm_login"  action="{{ action('UsuarioController@login') }}" method="post">
                                <li class="loginizq"><input name="email" type="text"  id="loginemail" placeholder="Email:" /></li>
                                <li class="loginder"><input name="password" type="password"  id="loginpass"  placeholder="Password:" /></li>
                                <li class="loginizq"><input class="btn"  id="loginborrar" type="reset" value="BORRAR" name="Enviar2" /></li>
                                <li class="loginder"><input type="button" value="ENTRAR" name="submit1" id="loginentrar" /></li>
                            </form>
                            <div class="cleaner"></div>
                            <li><p style="height: 16px; display: block;" id="validator"></p></li>
                            <li><hr></li>
                            <li class="loginizq"><a href="#" id="face" ajax="{{ action('UsuarioController@login_con_fb') }}">Connect</a></li>
                            <li class="loginder"><a href="{{ url('registro') }}" id="registro">Reg&iacute;strate Gratis</a></li>
                            <li><a href="#" id="olvido">&iquest;Olvidaste tu contrase&ntilde;a?</a></li>
                        </div>
                    </ul>
                    <div class="cleaner"></div>
                    </div>
                </nav>
            <div class="cleaner"></div>
            </div>
        </div>

        <div id="chat">
            <button id="showRight">Chatee con un operador</button>
                <div class="cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
                <h3>Consultas</h3><div id="formah3"></div>
                <div class="cleaner"></div>

                <form id="consultachat"  action="" method="post">
                    <ul>
                        <li class="izq_consultachat"><input name="nombre" type="text" placeholder="&nbsp;*Nombre:" /></li>
                        <li class="der_consultachat"><input name="apellido" type="text" placeholder="&nbsp;*Apellido:" /></li>
                        <div class="cleaner"></div>
                        <li class="izq_consultachat"><input name="telefono" type="text" placeholder="Tel&eacute;fono:" /></li>
                        <li class="der_consultachat"><input name="empresa" type="text" placeholder="Empresa:" /></li>
                        <div class="cleaner"></div>
                        <li class="email_chat"><input name="email" type="text" placeholder="&nbsp;*Email:" /></li>
                        <li><textarea name="comentario" placeholder="&nbsp;*Comentario:"></textarea></li>
                    </ul>
                    <p>*&nbsp;Campos obligatorios </p>

                    <div id="botones_consultachat">
                    <input class="btn"  id="borrar" type="reset" value="BORRAR" name="borrar" />
                    <input type="button" value="ENVIAR" name="enviar" onClick="enviar(this.form)" id="saveForm" />
                    <div class="cleaner"></div>
                    </div><!--botones_consultachat-->
                </form>
            </div><!--cbp-spmenu-s2-->
        </div><!--chat-->
    </header>
      <div id="conteiner" class="cbp-fbscroller">

      <section id="fbsection1">


      <div id="banner">
      <div id="da-slider" class="da-slider">
                <div class="da-slide">
                <h2>Desarrolla, gestiona y env&iacute;a tus campa&ntilde;as de email marketing.</h2>
                <p>&iexcl;Simple y efectivo!<br>
                PROBAR GRATIS HASTA 500 ENV&Iacute;OS POR MES.</p>
                <div class="da-img"><img src="{{ asset('home/imagenes/banner1.png') }}" width="1280" height="400" /></div>
                </div>


                <div class="da-slide">
                <h2>Accede a un variado cat&aacute;logo de im&aacute;genes gratis.</h2>
                <p>&iexcl;Aprov&eacute;chalo en todas tus campa&ntilde;as!</p>
                <div class="da-img"><img src="{{ asset('home/imagenes/banner2.png') }}" width="1280" height="400" /></div>
                </div>


                <div class="da-slide">
                <h2>Monitorea la evoluci&oacute;n de tu acci&oacute;n de email marketing.</h2>
                <p>Realiza un seguimiento detallado de los env&iacute;os mediante nuestro s&oacute;lido sistemas de reportes y estad&iacute;sticas.<br>
Analiza los resultados para planificar con eficacia tu pr&oacute;xima campa&ntilde;a.</p>
                    <div class="da-img"><img src="{{ asset('home/imagenes/banner3.png') }}" width="1280" height="400" /></div>
                </div>


                <div class="da-slide">
                <h2>Crea, optimiza y gestiona tu lista de suscriptores.</h2>
                <p>Administra y segmenta f&aacute;cilmente tus listas de contactos.<br>
Comunica un mensaje personalizado y contundente a tu p&uacute;blico objetivo.</p>
                    <div class="da-img"><img src="{{ asset('home/imagenes/banner4.png') }}" width="1280" height="400" /></div>
                </div>

                <div class="da-slide">
                <h2>Integra tu campa&ntilde;a de email marketing a las redes sociales.</h2>
                <p>Potencia la viralidad de tus mensajes y alcanza a toda tu audiencia.</p>
                    <div class="da-img"><img src="{{ asset('home/imagenes/banner5.png') }}" width="1280" height="400" /></div>
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
      <div id="tri"><img src="{{ asset('home/imagenes/flecha.png') }}" alt="flecha" /></div></h2>
      <div id="quees">
      <div id="queinfo">
      <div id="txtque"><p>TrebolNews es una plataforma online que te da la posibilidad de crear campa&ntilde;as de email marketing, enviarlas a tu base de datos e integrarlas a las redes sociales, y hacer un seguimiento completo a trav&eacute;s de un poderoso sistema de reportes y estad&iacute;sticas. &iexcl;Todo de manera simple y &aacute;gil!
La plataforma ofrece plantillas predise&ntilde;adas y un banco de im&aacute;genes para usar de manera gratuita en tus campa&ntilde;as. En caso de que desees un dise&ntilde;o exclusivo para tu newsletter, nuestro equipo de profesionales lo elaborar&aacute;. Si ya dispones de un dise&ntilde;o de newsletter, podr&aacute;s importar el c&oacute;digo html y utilizarlo en tus env&iacute;os.</p> <p id="txtque_sub">&iquest;C&oacute;mo se usa TrebolNews? &iexcl;En solo cuatro pasos!</p>
      </div>
      <img class="iconoque"  id="monitor" src="{{ asset('home/imagenes/monitor.png') }}" width="240" height="240" alt="icono de monitor">
      <div class="txtpaso" id="texpaso1"><p><span><span>1</span> Paso</span><br>Crea tu cuenta y establece la cantidad de env&iacute;os que quieres hacer.</p></div>
      <img class="iconoque" id="carta" src="{{ asset('home/imagenes/carta.png') }}" width="210" height="210" alt="icono de carta">
      <img class="iconoque" id="noticias" src="{{ asset('home/imagenes/noticias.png') }}" width="210" height="210" alt="icono de noticias">
      <img class="iconoque" id="mapa" src="{{ asset('home/imagenes/mapa.png') }}" width="210" height="210" alt="icono de mapa">
      <img class="iconoque" id="fotos" src="{{ asset('home/imagenes/fotos.png') }}" width="210" height="210" alt="icono de fotos">
      <div class="txtpaso" id="texpaso2"><p><span><span>2</span> Paso</span><br>Elige una plantilla de dise&ntilde;o o importa tu propio html dise&ntilde;ado.</p></div>
      <img class="iconoque" id="gente" src="{{ asset('home/imagenes/gente.png') }}" width="240" height="240" alt="icono de gente">
      <img class="iconoque" id="sobre" src="{{ asset('home/imagenes/sobre.png') }}" width="240" height="240" alt="icono de sobre">
      <div class="txtpaso" id="texpaso3"><p><span><span>3</span> Paso</span><br>Env&iacute;a la campa&ntilde;a a tu base de datos.</p></div>
      <img class="iconoque" id="datos" src="{{ asset('home/imagenes/datos.png') }}" width="240" height="240" alt="icono de datos">
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
      <img src="{{ asset('home/imagenes/1serv.png') }}" width="164" height="80" alt="icono">
      <h6>Editor de plantilla:</h6><p>Arma tu dise&ntilde;o de manera sencilla y eficiente.</p>
      </div>
      <div class="servinter">
      <img src="{{ asset('home/imagenes/2serv.png') }}" width="164" height="80" alt="icono">
      <h6>Banco de im&aacute;genes:</h6><p>Elige entre un abanico de im&aacute;genes.</p>
      </div>
      <div class="servinter">
      <img src="{{ asset('home/imagenes/3serv.png') }}" width="164" height="80" alt="icono">
      <h6>Newsletter</h6><p>Sube tu newsletter en html y ed&iacute;talo online. Revisa c&oacute;mo lucir&aacute; tu campa&ntilde;a antes de enviarla.</p>
      </div>
      <div class="servinter">
      <img src="{{ asset('home/imagenes/4serv.png') }}" width="164" height="80" alt="icono">
      <h6>Historial:</h6><p>Accede al historial de campa&ntilde;as que has creado.</p>
      </div>
      <div class="servsin">
      <img src="{{ asset('home/imagenes/5serv.png') }}" width="164" height="80" alt="icono">
      <h6>Viralizaci&oacute;n:</h6><p>Integra tu campa&ntilde;a a las redes sociales para ampliar el alcance de tus emails.</p>
      </div>
      <div class="cleaner"></div>
      </div><!--serarriba-->

      <div id="serabajo">
      <div class="servinter">
      <img src="{{ asset('home/imagenes/6serv.png') }}" width="164" height="80" alt="icono">
      <h6>Programaci&oacute;n de env&iacute;os:</h6><p>Define en qu&eacute; tiempos y horarios quieres expedir tus mensajes, cuantas veces necesites.</p>
      </div>
      <div class="servinter">
      <img src="{{ asset('home/imagenes/7serv.png') }}" width="164" height="80" alt="icono">
      <h6>Reenv&iacute;o autom&aacute;tico:</h6><p>Vuelve a enviar tus publicaciones de manera autom&aacute;tica.</p>
      </div>
      <div class="servinter">
      <img src="{{ asset('home/imagenes/8serv.png') }}" width="164" height="80" alt="icono">
      <h6>Base de datos:</h6><p>Importa tu base de datos y ed&iacute;tala online.</p>
      </div>
      <div class="servinter">
      <img src="{{ asset('home/imagenes/9serv.png') }}" width="164" height="80" alt="icono">
      <h6>Reportes y estad&iacute;sticas:</h6><p>Monitorea constante-<br>mente los resultados de tu campa&ntilde;a. Mide su impacto con Google Analytics.</p>
      </div>
      <div class="servsin">
      <img src="{{ asset('home/imagenes/10serv.png') }}" width="164" height="80" alt="icono">
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
      <img src="{{ asset('home/imagenes/1porq.png') }}" width="80px" height="80px" alt="icono">
      <h5>TECNOLOG&Iacute;A</h5>
      <p>Porque contamos con una herramienta online robusta y confiable, hosteada en servidores con filtros antivirus, que puedes utilizar en los distintos dispositivos, sean PC, tablets o smartphones.</p>
      </div>
      <div id="envio" class="porinfoespacio">
      <img src="{{ asset('home/imagenes/2porq.png') }}" width="80px" height="80px" alt="icono">
      <h5>ENV&Iacute;OS</h5>
      <p>Porque garantizamos m&eacute;todos de env&iacute;o veloces, seguros y efectivos. La configuraci&oacute;n de la herramienta se almacena en nuestra nube y se implementa en los tiempos establecidos.</p>
      </div>
      <div id="soporte" class="porinfoespacio">
      <img src="{{ asset('home/imagenes/3porq.png') }}" width="80px" height="80px" alt="icono">
      <h5>SOPORTE T&Eacute;CNICO ONLINE</h5>
      <p>Porque, dispones de un chat online que te guiar&aacute; paso a paso en lo que necesites para configurar o enviar tu campa&ntilde;a.</p>
      </div>
      <div id="seguridad" class="porinfo">
      <img src="{{ asset('home/imagenes/4porq.png') }}" width="80px" height="80px" alt="icono">
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

      <div id="pfree">
      <h3>Plan Gratuito</h3>
      <p>Dise&ntilde;ado para negocios o proyectos peque&ntilde;os, este plan permite experimentar la plataforma y los servicios que ofrece TrebolNews.<br>No se requieren los datos de la tarjeta de cr&eacute;dito. &iexcl;Prueba gratis hasta 500 env&iacute;os!</p>
      <div class="infoplanes">
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">500<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;Gratis</span></h4>
      </div>
      <div class="grisinfo"><img class="xicon" src="{{ asset('home/imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="verdeinfo"><img class="xicon" src="{{ asset('home/imagenes/cruziconverde.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="grisinfo"><img class="xicon" src="{{ asset('home/imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="verdeinfo"><img class="xicon" src="{{ asset('home/imagenes/cruziconverde.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="grisinfo"><img class="xicon" src="{{ asset('home/imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="verdeinfo"><img class="xicon" src="{{ asset('home/imagenes/cruziconverde.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="grisinfo"><img class="xicon" src="{{ asset('home/imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
      </div><!--infoplanes-->
      <div class="bot">
      <a href="#" class="botondecompra">COMPRAR AHORA</a>
      <div class="cleaner"></div>
      </div>
      </div><!--pfree-->

<div id="individual">
      <h3>Plan Individual</h3>
      <p>Ideal para env&iacute;os de emails con poca frecuencia, porque se abona s&oacute;lo la cantidad de env&iacute;os que necesita el usuario. Adem&aacute;s, no hay l&iacute;mite de tiempo para efectuarlos.<br> </p>
      <div class="infoplanes">
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">2.500<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">5.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">10.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">20.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">25.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">50.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">100.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">M&aacute;s</span><img src="{{ asset('home/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">100.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      </div><!--infoplanes-->
      <div class="bot">
      <a href="#" class="botondecompra">COMPRAR AHORA</a>
      <div class="cleaner"></div>
      </div>
      </div><!--individual-->


<div id="mensuales">
      <h3>Planes Mensuales</h3>
      <p>Exclusivo paquete preparado para realizar grandes env&iacute;os. Con una suscripci&oacute;n mensual se contrata una cantidad de env&iacute;os y no hay l&iacute;mite de tiempo para hacerlos.</p>
      <div class="infoplanes">
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">2.500<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">5.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">10.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">20.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">50.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('home/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">100.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">M&aacute;s</span><img src="{{ asset('home/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">100.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo"><img class="xicon" src="{{ asset('home/imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
      </div><!--infoplanes-->
      <div class="bot">
      <a href="#" class="botondecompra">COMPRAR AHORA</a>
      <div class="cleaner"></div>
      </div>
      </div><!--mensuales-->


      <div class="cleaner"></div>
      </div><!--planes-->

      <div id="planesexclusivos">
      <h5>&iquest;Necesitas alg&uacute;n plan a medida? &iexcl;Cont&aacute;ctanos!</h5>
      <div id="botex"><a href="#fbsection6">CONTACTO</a></div>
      </div><!--planesexclusivos-->

      <div id="formasdepago">
      <h6>Medios de pagos online</h6>
      <img src="{{ asset('home/imagenes/formasdepago.png') }}" width="1024" height="80" alt="formas de pago">
      <div class="cleaner"></div>
      </div><!--formasdepago-->

      </section>


      <section id="fbsection6">
      <div id="contacto">
      <h2>Contacto</h2>
      <div id="infocontacto">
      <form id="form_contacto"  action="" method="post">

            <ul >
        <li id="formizq"><ul>
        <li  class="izq" >
        <input name="nombre" type="text" class="element text medium" id="element_1" placeholder="&nbsp;*Nombre:" />
        </li>

        <li class="der" >
        <input name="apellido" type="text" class="element text medium"  placeholder="&nbsp;*Apellido:" />
        </li>
        <div class="cleaner"></div>

        <li class="izq" >
        <input id="element_2" name="telefono" class="element text medium" type="text" placeholder="Tel&eacute;fono:"  />
        </li>


        <li class="der" >
        <input id="element_5" name="empresa" class="element text medium" type="text" placeholder="Empresa:" />
        </li>


        <div class="cleaner"></div>
        <li>
        <input id="element_3" name="email" class="element text medium" type="text" placeholder="&nbsp;*Email:"  />
        </li>
        <p style="margin-top:20px; font-size:14px; color:#FFF">*&nbsp;Campos obligatorios </p>
        </ul></li>


        <li id="formder"><ul>
        <li id="li_6" >

        <textarea id="element_6"  name="comentario" placeholder="&nbsp;*Comentario:" class="element textarea medium"></textarea>
        </li>

        <li id="botonesform" class="buttons">
        <input type="button" value="ENVIAR" name="submit1" onClick="enviar(this.form)" id="saveForm" />
        <input class="btn"  id="borrar" type="reset" value="BORRAR" name="Enviar2" />
        <div class="cleaner"></div>
        </li>
        </ul></li>
        <div class="cleaner"></div>
            </ul>
        </form>
      </div><!--fin infocontacto-->
      </div><!--fin contacto-->
      <div class="cleaner"></div>
      </section>




    <div id="foo">
      <div id="foo_text">
        <div id="foo_izq">
          <h6>TrebolNEWS</h6>
          <p>www.trebolnews.com - Copyright 2013</p>
        </div>
        <div id="foo_der"> <a href="#" class="twe">Seguinos por Tweter</a> <a href="#" class="face">Estamos en Facebook</a>
          <form id="subanewsletter" method="post"  action="">
            <!-- es necesario que coincida el nombre de este archivo php con el que aparece en el campo action -->
            <input type="text" name="email" class="compo-form" id="newsletter" placeholder="Suscr&iacute;bete a nuestro Newsletter"  style=" color:#FFF; font-size:12px;"  />
            <input type="submit" id="button" value="ENVIAR" />
          </form>
          <div class="cleaner"></div>
        </div>
        <div class="cleaner"></div>
        <div id="botones_footer">
          <ul>
        <li><a href="#fbsection2">Nosotros</a></li>
        <li><a href="#">Trabaj&aacute; con Nosotros</a></li>
        <li><a href="#fbsection4">&iquest;Por qu&eacute; Elegirnos?</a></li>
        <li><a href="#fbsection5">Planes y Precios</a></li>
        <li><a href="#fbsection6">Contacto</a></li>
        <li><a href="../internas/terminosycondiciones.html" class="ultimo_boton_footer" target="_blank">Terminos y Condiciones</a></li>
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


        <script type="text/javascript">
                    $(function() {

                        $('#da-slider').cslider({
                            autoplay    : true,
                            bgincrement : 450
                        });

                    });
        </script>
        <!--banner-->





        <!--scroll-->

        <!-- jquery.easing by http://gsgd.co.uk/ : http://gsgd.co.uk/sandbox/jquery/easing/ -->

        <!-- waypoints jQuery plugin by http://imakewebthings.com/ : http://imakewebthings.com/jquery-waypoints/ -->
        <!-- jquery-smartresize by @louis_remi : https://github.com/louisremi/jquery-smartresize -->

        <script>
            $(function() {
                cbpFixedScrollLayout.init();
            });
        </script>
        <!--scroll-->









       <!--chat-->
      {{ HTML::script('home/js/chat.js') }}
        <script>
            var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
                showRight = document.getElementById( 'showRight' ),
                showTop = document.getElementById( 'showTop' ),
                body = document.body;

            showRight.onclick = function() {
                classie.toggle( this, 'active' );
                classie.toggle( menuRight, 'cbp-spmenu-open' );
                disableOther( 'showRight' );
            };

            function disableOther( button ) {

                if( button !== 'showRight' ) {
                    classie.toggle( showRight, 'disabled' );
                }
            }
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
/* ]]> */
</script>

 <!--explorer placeholder-->

    </body>
</html>
