<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TrebolNEWS / Campa&ntilde;as Enviadas</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>

        {{ HTML::style('internas/css/style.css') }}
        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        <!--chat-->
	    {{ HTML::script('home/js/modernizr.custom.js') }}
        <!--chat-->


<script type="text/javascript">
	function marcar(source)
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llam&oacute; (Marcar/Desmarcar Todos)
			}
		}
	}
</script>

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
    <h1>TrebolNEWS</h1>

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
			  <h2>Campa&ntilde;as Enviadas</h2>
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


<div id="info_basica">
<div class="submenu">
              <form>
              <input  class="search" type="text" name="" placeholder="BUSCAR" name="Search" />
              </form>
              <div class="cleaner"></div>
              </div>
<table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
  <tr class="primeralinea">
    <th scope="col" width="100px" >Tipo</th>
    <th scope="col" width="315px">Nombre de Campa&ntilde;a</th>
    <th scope="col" width="275px">Asunto</th>
    <th scope="col" width="179px">Fecha de Envio</th>
    <th scope="col" width="65px"></th>
  </tr>
  <tr>
    <td >Clasica</td>
    <td><a href="#">Newsletter de Noviembre 2013</a></td>
    <td>Noticias de Noviembre</td>
    <td>01 / 11 / 2013</td>
    <td><a class="duplicamania" href="#"><img src="{{ asset('internas/imagenes/duplicamania.png') }}" alt="editar campa&ntilde;a" width="25" height="25"></a><a class="borrarcam" href="#"><img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar campa&ntilde;a" width="25" height="25"></a><div class="cleaner"></div></td>
  </tr>
  <tr>
    <td>Social</td>
    <td><a href="#">Newsletter de Octubre 2013</a></td>
    <td>Noticias de Octubre  </td>
    <td>01 / 10 / 2013</td>
    <td><a class="duplicamania" href="#"><img src="{{ asset('internas/imagenes/duplicamania.png') }}" alt="editar campa&ntilde;a" width="25" height="25"></a><a class="borrarcam" href="#"><img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar campa&ntilde;a" width="25" height="25"></a><div class="cleaner"></div></td>
  </tr>
  <tr>
    <td>Clasica</td>
    <td><a href="#">Newsletter de Septiembre 2013</a></td>
    <td>Noticias de Septiembre  </td>
    <td>01 / 09 / 2013</td>
    <td><a class="duplicamania" href="#"><img src="{{ asset('internas/imagenes/duplicamania.png') }}" alt="editar campa&ntilde;a" width="25" height="25"></a><a class="borrarcam" href="#"><img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar campa&ntilde;a" width="25" height="25"></a><div class="cleaner"></div></td>
  </tr>
</table>

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