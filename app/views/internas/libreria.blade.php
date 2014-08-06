<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TrebolNEWS / Librer&iacute;a</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>

        {{ HTML::style('internas/css/style.css') }}

        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        {{ HTML::script('js/jquery.form.min.js') }}
        {{ HTML::script('js/jquery.noty.packaged.min.js') }}
        {{ HTML::script('js/trebolnews.js') }}
      <!--chat-->
	    {{ HTML::script('home/js/modernizr.custom.js') }}
      <!--chat-->

    </head>
    <body>
      <input type="hidden" id="id_carpeta" value="{{ isset($carpeta_seleccionada) ? $carpeta_seleccionada->id : '' }}" />
      <header>
    <div id="conheader">
    <h1><a href="{{ url('/') }}">TrebolNEWS</a></h1>

<div id="menu" class="cbp-fbscroller">

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
			  <h2>Librer&iacute;a</h2>
			  <div class="infocont">
              <div class="submenu">
              <form>
              <input  class="searchlibroteca" type="text" placeholder="BUSCAR" name="Search" />
              </form>
              <ul id="subiralibreria">
              <li><a class="subiralibreria">SUBIR A LIBRER&Iacute;A</a>
              <ul>
              <li><a id="btn_mipc" href="subir" popup="{{ url('popup/libreria_mipc') }}">Mi PC</a></li>
              <li><a id="btn_redes" href="subir" popup="{{ url('popup/libreria_redes') }}">Redes Sociales</a></li>
              <li><a href="{{ route('banco') }}">Banco de im&aacute;genes</a></li>
              </ul>
              </li>
              </ul>
              <div class="cleaner"></div>
              </div><!--submenu-->


    <div id="filtrolibreria">
    <ul>
        <?php
        $cantidad = 0;
        ?>
        @foreach($carpetas as $carpeta)
        <?php $cantidad += count($carpeta->imagenes); ?>
        @endforeach
        <li><a href="{{ route('librerias') }}" id="filtrotodo" {{ isset($carpeta_seleccionada) ? '' : 'class="apretado"' }}>Todo <span>({{ $cantidad + count($carpeta_imagenes->imagenes) }})</span></a></li>
        <li><a href="{{ route('carpeta', 1) }}" id="filtroimag" {{ isset($carpeta_seleccionada) ? ( $carpeta_seleccionada->id == 1 ? 'class="apretado"' : '' ) : '' }}>Im&aacute;genes <span>({{ count($carpeta_imagenes->imagenes) }})</span></a></li>
        @foreach($carpetas as $carpeta)
        <li><a href="{{ route('carpeta', $carpeta->id) }}" id="filtrocarpeta" {{ isset($carpeta_seleccionada) ? ($carpeta_seleccionada->id == $carpeta->id ? 'class="apretado"' : '') : '' }}>{{ $carpeta->nombre }} <span>({{ count($carpeta->imagenes) }})</span></a></li>
        @endforeach
        <li><a href="{{ route('carpeta', $carpeta_basura->id) }}" id="filtrobasura" {{ isset($carpeta_seleccionada) ? ($carpeta_seleccionada->id == $carpeta_basura->id ? 'class="apretado"' : '') : '' }}>Basura <span>({{ count($carpeta_basura->imagenes) }})</span></a></li>
        <li><a href="#" id="filtrocrear" popup="{{ url('popup/crear_carpeta_libreria') }}">Crear carpeta</a></li>
    </ul>
    </div><!--filtrolibreria-->

     <div id="tablalibreria">

     <div id="submenulibreria">
     <ul id="filtroselecionados">
     <li><p>Seleccionados: 0 de 5 </p></li>
     <li><a id="agregarcapeta" href="#">Mover a</a></li>
     <li><a id="borrarselecionados" href="#">Eliminar</a></li>
     </ul>


     <ul id="filtrover">
     <li><a id="filtroiconlinsta" class="apretado" href="#"><img src="{{ asset('internas/imagenes/filtroiconlinsta.png') }}" width="25" height="25"></a></li>
     <li><a id="filtroiconimagen" href="#"><img src="{{ asset('internas/imagenes/filtroiconimagen.png') }}" width="25" height="25"></a></li>
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

     <table width="100%"  cellpadding="0" cellspacing="0" class="libret">
  <tr class="primeralibre">
    <th scope="col" width="40px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox1" name="" onclick="marcar(this)" />
     <label for="checkbox1"></label>
     </form>
    </th>
    <th scope="col" width="170px">Visualizaci&oacute;n</th>
    <th scope="col" width="200px">Nombre</th>
    <th scope="col" width="125px">Dimensiones</th>
    <th scope="col" width="99px">Tama&ntilde;o</th>
    <th scope="col" width="100px"></th>
  </tr>
  @foreach($imagenes as $imagen)
  <?php if(isset($carpeta_seleccionada) && $carpeta_seleccionada->id != 1) { $ruta = 'uploads/imagenes/'; } else { $ruta = 'img/libreria/'; } ?>
  <tr>
    <td>
     <form class="checkbox">
     <input type="checkbox"  id="checkbox2" name="" value="valor1" />
     <label for="checkbox2"></label>
     </form>
    </td>
    <td class="libre_img"><a href="#"><label for="checkbox2"><img src="{{ asset($ruta . $imagen->archivo) }}" height="75"></label></a></td>
    <td class="nombrelibreria">{{ $imagen->nombre }}</td>
    <?php $dim = getimagesize(public_path() . '/' . $ruta . $imagen->archivo); ?>
    <td>{{ $dim[0] . ' x ' . $dim[1] }}</td>
    <td>{{ round(filesize(public_path() . '/' . $ruta . $imagen->archivo) / 1024, 2, PHP_ROUND_HALF_DOWN) . ' Kb' }}</td>
    <td><a class="ver_libreria" href="#"><img src="{{ asset('internas/imagenes/ojoicono.png') }}" width="28" height="25"></a><a class="editarcampam" href="#"><img src="{{ asset('internas/imagenes/editarcamania.png') }}" alt="editar campa&ntilde;a" width="25" height="25"></a><a class="borrarcam" href="#"><img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar campa&ntilde;a" width="25" height="25"></a><div class="cleaner"></div></td>
  </tr>
  @endforeach
</table>
<div id="paginador">
  @if(count($imagenes) > 0)
    {{ $imagenes->links('paginador') }}
  @endif
</div><!--paginador-->
</div><!--tablalibreria-->

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
    <div id="popup">

    </div>
    </body>
</html>