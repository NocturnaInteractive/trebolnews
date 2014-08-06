<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TrebolNEWS / Resumen y Envio</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>

        {{ HTML::style('internas/css/style.css') }}
        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        <!--chat-->
	    {{ HTML::script('home/js/modernizr.custom.js') }}
        <!--chat-->


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
			  <h2>Resumen y Envio</h2>
              <a id="volver" href="#"><img src="imagenes/iconovolver.png" alt="volver" width="26" height="26"></a>

                    <div class="infocont">
					<ul id="pasoscam">
                    <li id="pasocam1">Paso 1<div class="linea"></div><div class="circulo"></div></li>
                    <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                    <li id="pasocam2">Paso 2<div class="linea"></div><div class="circulo"></div></li>
                    <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                    <li id="pasocam3">Paso 3<div class="linea"></div><div class="circulo"></div></li>
                    <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                    <li id="pasocam4">Paso 4<div class="linea"></div><div class="circulo"></div></li>
                    <li class="separadorpasos"> <div class="separadorlinea"></div></li>
                    <li id="pasocam5">Paso 5<div class="linea"></div><div class="circulo  pasosactivado"></div></li>
                    <div class="cleaner"></div>
                    </ul><!--pasoscam-->


<div id="infocont">

<div id="configuracion_resumen" class="resumen_bien">
<div class="tiyulos_resumen">
<h3>Configuraci&oacute;n</h3>
<a class="editar_resumen" href="#">editar</a>
<div class="cleaner"></div>
</div><!--tiyulos_resumen-->
<p class="secciones">Informaci&oacute;n B&aacute;sica</p>
<table width="100%"  cellpadding="0" cellspacing="0" class="perfiltabla">
              <tr class="primeraperfil">
   			  <th scope="col" width="250px" class="tipoperfil">Nombre de la Campa&ntilde;a:</th>
    		  <th class="datoperfil" scope="col" width="684px">{{ Session::get('campania.nombre') }}</th>
   			  </tr>
              <tr>
              <td class="tipoperfil">Asunto:</td>
              <td class="datoperfil">{{ Session::get('campania.asunto') }}</td>
  			  </tr>
              <tr>
        	  <td class="tipoperfil">Nombre del Remitente:</td>
              <td class="datoperfil">{{ Session::get('campania.remitente') }}</td>
  			  </tr>
              <tr>
        	  <td class="tipoperfil">Email del Remitente:</td>
              <td class="datoperfil">{{ Session::get('campania.email') }}</td>
  			  </tr>
              <tr>
        	  <td class="tipoperfil">Email de Respuesta:</td>
              <td class="datoperfil">{{ Session::get('campania.respuesta') }}</td>
  			  </tr>
</table>

<div id="resumen_destinatarios">
<p class="secciones">Destinatarios Elegidos</p>
<table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
  <tr class="primeralinea">
     <th scope="col" width="355px">Nombre de Lista</th>
    <th scope="col" width="250px">Fecha de Creaci&oacute;n</th>
    <th scope="col" width="149px">Editado el</th>
    <th scope="col" width="180px">Suscriptores</th>
  </tr>
  <tr>

    <td>Newsletter de Computaci&oacute;n</td>
    <td>15 / 02 / 2013</td>
    <td>01 / 05 / 2013</td>
    <td>8154</td>
  </tr>
</table>
</div><!--resumen_destinatarios-->

<div id="resumen_redes">
<p class="secciones">Redes Sociales Elegidas </p>

<div id="agregar_red_resumen">
<p>Compartin en:</p>
<div class="iconosredes_resumentop" id="face_resumen"></div>
<div class="iconosredes_resumentop" id="tw_resumen"></div>
<div class="iconosredes_resumentop noelegidored" id="link_resumen"></div>
<div class="iconosredes_resumentop" id="gplus_resumen"></div>
<div class="iconosredes_resumentop" id="p_resumen"></div>
<div class="iconosredes_resumentop noelegidored" id="b_resumen"></div>
<div class="cleaner"></div>
<div class="iconosredes_resumenbottom noelegidored" id="meneame_resumen"></div>
<div class="iconosredes_resumenbottom noelegidored" id="tumbl_resumen"></div>
<div class="iconosredes_resumenbottom noelegidored" id="reddit_resumen"></div>
<div class="iconosredes_resumenbottom" id="digg_resumen"></div>
<div class="iconosredes_resumenbottom noelegidored" id="delicius_resumen"></div>
<div class="cleaner"></div>
</div><!--agregar_red_resumen-->

<div id="publicar_resumen">
<p>Publicar en:</p>
<div id="rconectar_face" class="conected_resumen">CONECTAR</div>
<div id="rconectar_tw" class="conected_resumen  noelegidored">CONECTAR</div>

<div class="cleaner"></div>

<div id="rconectar_lk" class="conected_resumen  noelegidored">CONECTAR</div>
<div id="rconectar_g" class="conected_resumen">CONECTAR</div>

<div class="cleaner"></div>

</div><!--publicar_resumen-->

<div class="cleaner"></div>

<div id="segundasopciones">

<div id="plugins_redes_resumen">
<p>Plugins</p>
     <div id="plugins_iconos_resumen">
     <div class="iconosindividuales_plugins" id="facebook_plugins"></div>
     <div class="iconosindividuales_plugins noelegidored" id="googleplugins"></div>
     <div class="iconosindividuales_plugins ultimoprinterest" id="pinterestplugins"></div>
     <div class="cleaner"></div>
     </div>
</div><!--plugins_redes-->



<div id="canalrss_resumen">
<p>Canal RSS</p>
<div id="textarea_redes_resumen"><p>texto que se escribi&oacute;</p></div>
</div><!--canalrss-->

<div class="cleaner"></div>
</div><!--segundasopciones-->


</div><!--resumen_redes-->



<div id="resumen_envio">
<p class="secciones">Env&iacute;o de la Campa&ntilde;a</p>
<img src="imagenes/inmediato_social.png" width="107" height="100">
<p id="horario_programado">Env&iacute;o Inmediato:<br>La Campa&ntilde;a se enviar&aacute; al momento en el que hagas click en ENVIAR.</p>
<div class="cleaner"></div>
</div><!--resumen_envio-->

</div><!--configuracion_resumen-->




<div id="contenidoyprueba_resumen">

<div id="contenido_resumen" class="resumen_mal" >
<div class="tiyulos_resumen">
<h3>Contenido</h3>
<a class="editar_resumen" href="#">editar</a>
<a class="ver_resumen" href="#">ver</a>
<div class="cleaner"></div>
</div><!--tiyulos_resumen-->
<table cellpadding="0" cellspacing="0" id="campania_resumen">
<tr><td>Campa&ntilde;a<br>Preview</td></tr>
</table>
</div><!--contenido_resumen-->


<div id="probarenvio_resumen">
<h3>Prueba</h3>
<p>Realice un envi&oacute; de prueba. Separar emails por punto y coma.</p>
<form>
<textarea  class="emaildeprueba" class="textarea">Emailderegistro@login.com;</textarea>
<div id="boton_prueba">
<input type="button" value="PROBAR" id="probar_boton" />
<div class="cleaner"></div>
</div>
</form>
</div><!--probarenvio_resumen-->


<div class="cleaner"></div>
</div><!--contenidoyprueba_resumen-->



<div id="opciones_pasos">
<a id="guardarysalir" href="#">GUARDAR Y SALIR</a>
<ul>
<li><a href="campaniaclasica.html" id="anterior">ANTERIOR</a></li>
<li><a href="#" id="siguiente">ENVIAR</a></li>
</ul>
<div class="cleaner"></div>
</div><!--opciones_pasos-->
</div><!--infocont-->






        </div><!--content-->
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