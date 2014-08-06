<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrebolNEWS / Suscriptores</title>
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
    <script>
    $(function() {
      // $('.editarcampam, .borrarcam').on('click', function(e) {
      //   e.preventDefault();

      //   $.ajax({
      //     url: $(this).attr('ajax'),
      //     success: function(data) {
      //       $('#popup').html('');
      //       $('#popup').html(data.popup);
      //       $('#popup').fadeIn(400);
      //     }
      //   });
      // });
    });
    </script>
    </head>
    <body>
      <input type="hidden" id="popup_url" value="{{ url('popup') }}" />
      <header>
    <div id="conheader">
    <h1><a href="{{ url('/') }}">TrebolNEWS</a></h1>

<div id="menu" class="cbp-fbscroller" >
  @include('menu')
  <input type="hidden" id="menu_principal" value="suscriptores" />
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
        <h2>Listas de Suscriptores</h2>
        <div class="infocont">
              <div class="submenu">
              <form>
              <input class="search" type="text" placeholder="BUSCAR" name="Search" />
              </form>
              <ul class="opciones">
              <li><a class="importarlista" href="#">OPCIONES</a>
              <ul>
              <li><a href="#">Importar lista</a></li>
              <li><a href="#">Exportar listas</a></li>
              </ul>
              </li>
              <li><a class="crearlista" href="#" popup="{{ url('popup/crearlista') }}">CREAR LISTA</a></li>
              </ul>
              <div class="cleaner"></div>
              </div><!--submenu-->

     <div id="submenulibreria">
     <ul id="filtroselecionados">
     <li><p>Seleccionados: 0 de {{ count($listas) }}</p></li>
     <li><a id="borrarselecionados" href="popup_eliminar_listasuscriptor_multi.html">Eliminar</a></li>
     </ul>

     <ul id="cantidad" class="btosuscriptores">
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

     <table width="100%"  cellpadding="0" cellspacing="0" class="listacampanias">
  <tr class="primeralinea">
    <th scope="col" width="40px">
     <form class="checkbox">
     <input type="checkbox"  id="checkbox1" name="" onclick="marcar(this)" />
     <label for="checkbox1"></label>
     </form>
    </th>
    <th scope="col" width="305px">Nombre de Lista</th>
    <th scope="col" width="200px">Fecha de Creaci&oacute;n
    <a href="#" class="flechatabla"></a>
    </th>
    <th scope="col" width="149px">Editado el</th>
    <th scope="col" width="140px">Suscriptores</th>
    <th scope="col" width="100px"></th>
  </tr>
  @foreach($listas as $lista)
  <tr>
    <td>
     <form class="checkbox">
     <input type="checkbox"  id="checkbox2" name="" value="valor1" />
     <label for="checkbox2"></label>
     </form>

    </td>
    <td><a href="{{ route('lista', $lista->id) }}">{{ $lista->nombre }}</a></td>
    <td>{{ $lista->created_at->format('d/m/Y') }}</td>
    <td>{{ $lista->updated_at->format('d/m/Y') }}</td>
    <td>{{ count($lista->contactos) }}</td>
    <td>
      <a class="descargarlista" href="#">
        <img src="{{ asset('internas/imagenes/descargarlista.png') }}" alt="editar campa&ntilde;a" width="25" height="25">
      </a>
      <a class="editarcampam" href="#" popup="{{ url('popup/editar_lista' . '/' . $lista->id) }}">
        <img src="{{ asset('internas/imagenes/editarcamania.png') }}" alt="editar campa&ntilde;a" width="25" height="25">
      </a>
      <a class="borrarcam" href="#" popup="{{ url('popup/eliminar_lista' . '/' . $lista->id) }}">
        <img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar campa&ntilde;a" width="25" height="25">
      </a>
      <div class="cleaner"></div></td>
  </tr>
  @endforeach
</table>

  <div id="paginador">
    @if(count($listas) > 0)
      {{ $listas->links('paginador') }}
    @endif
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