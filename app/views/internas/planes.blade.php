<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TrebolNEWS / Precios y Planes</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>

        {{ HTML::style('internas/css/style.css') }}

      {{ HTML::script('js/jquery-1.11.0.min.js') }}
      <!--chat-->
	    {{ HTML::script('home/js/modernizr.custom.js') }}
      <!--chat-->

    </head>
    <body>
       <header>
    <div id="conheader">
    <h1><a href="{{ url('/') }}">TrebolNEWS</a></h1>

<div id="menu" class="cbp-fbscroller" >
  @include('menu')
  <input type="hidden" id="menu_principal" value="planes" />
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
			  <h2>Precios y Planes</h2>
			  <div class="infocont">

 <div id="planes">

      <div id="pfree">
      <h3>Plan Gratuito</h3>
      <p>Dise&ntilde;ado para negocios o proyectos peque&ntilde;os, este plan permite experimentar la plataforma y los servicios que ofrece TrebolNews.<br>No se requieren los datos de la tarjeta de cr&eacute;dito. &iexcl;Prueba gratis hasta 500 env&iacute;os!</p>
      <div class="infoplanes">
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">500<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;Gratis</span></h4>
      </div>
      <div class="grisinfo"><img class="xicon" src="{{ asset('internas/imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="verdeinfo"><img class="xicon" src="{{ asset('internas/imagenes/cruziconverde.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="grisinfo"><img class="xicon" src="{{ asset('internas/imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="verdeinfo"><img class="xicon" src="{{ asset('internas/imagenes/cruziconverde.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="grisinfo"><img class="xicon" src="{{ asset('internas/imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="verdeinfo"><img class="xicon" src="{{ asset('internas/imagenes/cruziconverde.png') }}" width="38px" height="38px" alt="icono"></div>
      <div class="grisinfo"><img class="xicon" src="{{ asset('internas/imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
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
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">2.500<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">5.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">10.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">20.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">25.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">50.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">100.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">M&aacute;s</span><img src="{{ asset('internas/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">100.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
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
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">2.500<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">5.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">10.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">20.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">50.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo">
      <h4><span class="hastaplan">Hasta</span><img src="{{ asset('internas/imagenes/planegris.png') }}" width="18px" height="18px" alt="icono">100.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="verdeinfo">
      <h4><span class="hastaplan">M&aacute;s</span><img src="{{ asset('internas/imagenes/plane.png') }}" width="18px" height="18px" alt="icono">100.000<span class="hastaenv"> Envios</span><span class="precioplan">&nbsp;$0</span></h4>
      </div>
      <div class="grisinfo"><img class="xicon" src="{{ asset('internas/imagenes/cruzicongris.png') }}" width="38px" height="38px" alt="icono"></div>
      </div><!--infoplanes-->
      <div class="bot">
      <a href="#" class="botondecompra">COMPRAR AHORA</a>
      <div class="cleaner"></div>
      </div>
      </div><!--mensuales-->


      <div class="cleaner"></div>
      </div><!--planes-->


      <div id="formasdepago">
      <h6>Medios de pagos online</h6>
      <img src="{{ asset('internas/imagenes/formasdepago.png') }}" width="934" height="80" alt="formas de pago">
      <div class="cleaner"></div>
      </div><!--formasdepago-->



		</div> <!--infocont-->
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
  		<script src="js/chat.js"></script>
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