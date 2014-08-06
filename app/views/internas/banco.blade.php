 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TrebolNEWS / Banco de Im&aacute;genes</title>
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
    <input type="hidden" id="menu_principal" value="librerias" />
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
			  <h2>Banco de Im&aacute;genes</h2>
              <a id="volver" href="libreria.html"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>

			  <div class="infocont">

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
              <ul id="subiralibreria_banco">
              <li><a href="#">SUBIR A LIBRER&Iacute;A</a></li>
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
     </div><!--submenulibreria   -->

     <table width="100%"  cellpadding="0" cellspacing="10px" class="tablabanco">

  <tr>
    <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox1" value="valor1" />
     <label for="checkbox1"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox1"><img src="{{ asset('internas/imagenes/libreriaimg1.jpg') }}" width="126" height="75"></label></a></td></tr>
    </table>
    </td>

    <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox2" value="valor2" />
     <label for="checkbox2"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox2"><img src="{{ asset('internas/imagenes/libreriaimg6.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

    <td>
    <table cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox3" value="valor3" />
     <label for="checkbox3"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox3"><img src="{{ asset('internas/imagenes/libreriaimg7.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>


        <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox4" value="valor4" />
     <label for="checkbox4"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox4"><img src="{{ asset('internas/imagenes/libreriaimg8.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

        <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox5" value="valor5" />
     <label for="checkbox5"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox5"><img src="{{ asset('internas/imagenes/libreriaimg9.jpg') }}" width="108" height="75"></label></a></td></tr>
    </table>
    </td>
  </tr>

  <tr>
  <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox6" value="valor6" />
     <label for="checkbox6"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox6"><img src="{{ asset('internas/imagenes/libreriaimg10.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

  <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox7" value="valor7" />
     <label for="checkbox7"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox7"><img src="{{ asset('internas/imagenes/libreriaimg11.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

  <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox8" value="valor8" />
     <label for="checkbox8"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox8"><img src="{{ asset('internas/imagenes/libreriaimg2.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

  <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox9" value="valor9" />
     <label for="checkbox9"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox9"><img src="{{ asset('internas/imagenes/libreriaimg12.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

  <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox10" value="valor10" />
     <label for="checkbox10"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox10"><img src="{{ asset('internas/imagenes/libreriaimg5.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>
  </tr>

  <tr>
  <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox11" value="valor11" />
     <label for="checkbox11"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox11"><img src="{{ asset('internas/imagenes/libreriaimg13.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

  <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox12" value="valor12" />
     <label for="checkbox12"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox12"><img src="{{ asset('internas/imagenes/libreriaimg4.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

<td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox13" value="valor13" />
     <label for="checkbox13"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox13"><img src="{{ asset('internas/imagenes/libreriaimg14.jpg') }}" width="118" height="75"></label></a></td></tr>
    </table>
    </td>

<td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox14" value="valor14" />
     <label for="checkbox14"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox14"><img src="{{ asset('internas/imagenes/libreriaimg15.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

<td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox15" value="valor15" />
     <label for="checkbox15"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox15"><img src="{{ asset('internas/imagenes/libreriaimg3.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>
  </tr>

  <tr>

  <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox16" value="valor16" />
     <label for="checkbox16"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox16"><img src="{{ asset('internas/imagenes/libreriaimg3.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

<td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox17" value="valor17" />
     <label for="checkbox17"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox17"><img src="{{ asset('internas/imagenes/libreriaimg8.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

<td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox18" value="valor18" />
     <label for="checkbox18"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox18"><img src="{{ asset('internas/imagenes/libreriaimg11.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>

<td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox19" value="valor19" />
     <label for="checkbox19"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox19"><img src="{{ asset('internas/imagenes/libreriaimg1.jpg') }}" width="126" height="75"></label></a></td></tr>
    </table>
    </td>

    <td>
    <table  cellpadding="0" cellspacing="0">
    <tr class="banco_opciones" height="20px">
    <th scope="col"></th>
    <th scope="col" width="30px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox20" value="valor20" />
     <label for="checkbox20"></label>
     </form>
    </th>
    <th scope="col" width="25px"><a class="banco_ver" href="detalle.html">ver</a></th>
    </tr>
    <tr><td colspan="3"><a class="banco_img" href="#"><label for="checkbox20"><img src="{{ asset('internas/imagenes/libreriaimg10.jpg') }}" width="113" height="75"></label></a></td></tr>
    </table>
    </td>
  </tr>

  </table>
<div class="cleaner"></div>
</div><!--banco -->


        <div id="paginador">
		<ul>
        <li><a href="#">Primera</a></li>
        <li><a href="#" class="flechapag"><img src="{{ asset('internas/imagenes/flechaizq.png') }}" width="12" height="18"></a></li>
        <li><a href="#" class="apretado">01</a></li>
        <li><a href="#">02</a></li>
        <li><a href="#">03</a></li>
        <li><a href="#">04</a></li>
        <li><a href="#">05</a></li>
        <li><a href="#"><strong>...</strong></a></li>
        <li><a href="#">12</a></li>
        <li><a href="#" class="flechapag"><img src="{{ asset('internas/imagenes/flechader.png') }}" width="12" height="18"></a></li>
        <li><a href="#">&Uacute;ltima</a></li>
        </ul>
		</div><!--paginador-->
	 	<div class="cleaner"></div>



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
         <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

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