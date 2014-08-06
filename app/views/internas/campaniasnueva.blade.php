<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TrebolNEWS / Campa&ntilde;a Nueva</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>

    {{ HTML::style('internas/css/style.css') }}
    {{ HTML::script('js/jquery-1.11.0.min.js') }}
    {{ HTML::script('js/trebolnews.js') }}
    <!--chat-->
    {{ HTML::script('home/js/modernizr.custom.js') }}
    <!--chat-->
		{{ HTML::script('home/js/js/modernizr.custom.28468.js') }}

		<!--[if lt IE 9]>
			<style>
				.content{
					height: auto;
					margin: 0;
				}
				.content div {
					position: relative;
				}
			</style>
		<![endif]-->
    </head>
    <body>
      <input type="hidden" id="session_url" value="{{ url('session') }}" />
        <header>
    <div id="conheader">
    <h1><a href="{{ url('/') }}">TrebolNEWS</a></h1>

<div id="menu" class="cbp-fbscroller" >
  @include('menu')
  <input type="hidden" id="menu_principal" value="campanias" />
<div class="cleaner"></div>
</div>

    </div><!-- #BeginLibraryItem "/Library/chat.lbi" --><div id="chat">
    <button id="showRight">Chatee con un operador</button>

    		<div class="cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
			<h3>Consultas</h3><div id="formah3"></div>
	        <div class="cleaner"></div>

       <form id="consultachat"  action="" method="post">

      	<ul>
		<li  class="izq_consultachat" ><input name="nombre" type="text" placeholder="&nbsp;*Nombre:" /></li>

        <li class="der_consultachat" ><input name="apellido" type="text" placeholder="&nbsp;*Apellido:" /></li>

        <div class="cleaner"></div>

        <li class="izq_consultachat" ><input name="telefono" type="text" placeholder="Tel&eacute;fono:"  /></li>


        <li class="der_consultachat" ><input name="empresa" type="text" placeholder="Empresa:" /></li>

        <div class="cleaner"></div>

        <li class="email_chat"><input name="email" type="text" placeholder="&nbsp;*Email:"  /></li>


        <li><textarea name="comentario" placeholder="&nbsp;*Comentario:"></textarea></li>

        </ul>

		<p>*&nbsp;Campos obligatorios</p>

	 	<div id="botones_consultachat">
        <input class="btn"  id="borrar" type="reset" value="BORRAR" name="borrar" />
        <input type="button" value="ENVIAR" name="enviar" onClick="enviar(this.form)" id="saveForm" />
        <div class="cleaner"></div>
	    </div><!--botones_consultachat-->
		</form>

		</div><!--cbp-spmenu-s2-->

    </div><!--chat--><!-- #EndLibraryItem --></header>
<div id="container">


			<section class="tabs">


	          <div class="content">
			  <h2>Crear campa&ntilde;a nueva</h2>
              <a id="volver" href="campanias.html"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
                    <div class="infocont">
					<ul id="pasoscam">

                    <li id="pasocam1">Paso 1<div class="linea"></div><div class="circulo pasosactivado"></div></li>
                    <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                    <li id="pasocam2">Paso 2<div class="linea"></div><div class="circulo"></div></li>
                    <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                    <li id="pasocam3">Paso 3<div class="linea"></div><div class="circulo"></div></li>
                    <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                    <li id="pasocam4">Paso 4<div class="linea"></div><div class="circulo"></div></li>
                    <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                    <li id="pasocam5">Paso 5<div class="linea"></div><div class="circulo"></div></li>
                    <div class="cleaner"></div>
                    </ul><!--pasoscam-->


                     <a id="campanacla" href="{{ route('paso_2') }}" session="campania.tipo:clasica">
                     <h4>Secci&oacute;n Campa&ntilde;a Cl&aacute;sica</h4>
                     <img src="{{ asset('internas/imagenes/camclasica.png') }}" width="160" height="150" alt="campa&ntilde;a clasica">
                     <p>Cree sus propias campa&ntilde;as. &Oacute; suba su campa&ntilde;a ya dise&ntilde;ada en html o por url.</p>
                     </a>
                     <a id="campanasocial" href="{{ route('paso_2') }}" session="campania.tipo:social">
                     <h4>Campa&ntilde;as Social<br>Media</h4>
                     <img src="{{ asset('internas/imagenes/camsicial.png') }}" width="160" height="150" alt="campa&ntilde;a social">
                     <p>Integre las campa&ntilde;as con las redes Facebook y Tw para viralizar sus env&iacute;os.</p>
                     </a>
                     <a id="testsocial" href="#">
                     <h4>Test de Campa&ntilde;as</h4>
                     <img src="{{ asset('internas/imagenes/testdecam.png') }}" width="160" height="150" alt=" test de campa&ntilde;as">
                     <p>Una vez que tengas campa&ntilde;as creadas, podr&aacute; testearlas envi&aacute;ndosela por mail.</p>
                     </a>

                     <div class="cleaner"></div>
                     </div><!--infocont-->




        </div>
        </section>
        </div><!--conteiner--><!-- #BeginLibraryItem "/Library/footer_internas.lbi" --><div id="foo">
      <div id="foo_text">

		<div id="foo_izq">
        <h6>TrebolNEWS</h6>
        <p>www.trebolnews.com - Copyright 2013</p>
        </div>

		<div id="foo_der">
        <a href="#" class="twe">Seguinos por Tweter</a>
        <a href="#" class="face">Estamos en Facebook</a>

        <form id="subanewsletter" method="post"  action=""> <!-- es necesario que coincida el nombre de este archivo php con el que aparece en el campo action -->
	    <input type="text" name="email" class="compo-form" id="newsletter" placeholder="Suscr&iacute;bete a nuestro Newsletter"  style=" color:#FFF; font-size:12px;"  />
	    <input type="submit" id="button" value="ENVIAR" />
        </form>

        <div class="cleaner"></div>
        </div>

      <div class="cleaner"></div>

       <div id="botones_footer">
       <ul>
       <li><a href="campanias.html">Campa&ntilde;as</a></li>
       <li><a href="listascontactos.html">Suscriptores</a></li>
       <li><a href="libreria.html">Libre&iacute;as</a></li>
       <li><a href="planes.html">Planes</a></li>
       <li><a href="soporte.html">Soporte</a></li>
       <li><a href="terminosycondiciones.html" class="ultimo_boton_footer" target="_blank">Terminos y Condiciones</a></li>
       </ul>
       <div class="cleaner"></div>
       </div><!--botones_footer-->

      </div><!--fin de foo_text-->
      </div>

	  <!--fin de footer--><!-- #EndLibraryItem --><!--chat-->
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