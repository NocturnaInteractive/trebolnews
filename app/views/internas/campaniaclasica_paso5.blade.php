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
    {{ HTML::script('ckeditor/ckeditor.js') }}
    {{ HTML::script('ckeditor/adapters/jquery.js') }}
    {{ HTML::script('js/jquery.form.min.js') }}
    {{ HTML::script('js/jquery.noty.packaged.min.js') }}
    {{ HTML::script('js/trebolnews.js') }}
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
        <script>
        $(function() {
            $('.btn_guardar').one('click', guardar_handler);

            function guardar_handler(e) {
                e.preventDefault();

                $(this).on('click', function(e) {
                    e.preventDefault();
                });

                var boton = $(this);

                $.ajax({
                    type: 'post',
                    url: $(this).parents('[ajax]').attr('ajax'),
                    data: {
                        y: boton.attr('y')
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

            $('#redes_seleccionadas').children().each(function(i, e) {
                $('#resumenredes_clasica [red="' + $(e).val() + '"]').removeClass('noelegidored');
            });
        });
        </script>
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
        <h2>Resumen y Envio</h2>
              <a id="volver" href="{{ route('paso_4') }}"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>

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

<div id="configuracion_resumen"> <!-- class="resumen_mal" -->
<div class="tiyulos_resumen">
<h3>Configuraci&oacute;n</h3>
<a class="editar_resumen" href="#" id="btn_editar_informacion_basica">editar</a>
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
            <td class="tipoperfil">Email del Remitente:</td> {{-- existe class="cont_faltante" --}}
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
  @foreach(Session::get('campania.listas') as $id_lista)
  <?php $lista = Lista::find($id_lista) ?>
  <tr>
    <td>{{ $lista->nombre }}</td>
    <td>{{ $lista->created_at->format('d/m/Y') }}</td>
    <td>{{ $lista->updated_at->format('d/m/Y') }}</td>
    <td>{{ count($lista->contactos) }}</td>
  </tr>
  @endforeach
</table>
</div><!--resumen_destinatarios-->

<div id="resumen_redes">
<p class="secciones">Redes Sociales Elegidas</p>
<div id="resumenredes_clasica">
    <div class="iconosredes_resumencla noelegidored" id="face_resumen" red="facebook"></div>
    <div class="iconosredes_resumencla noelegidored" id="tw_resumen" red="twitter"></div>
    <div class="iconosredes_resumencla noelegidored" id="link_resumen" red="linkedin"></div>
    <div class="iconosredes_resumencla noelegidored" id="gplus_resumen" red="google"></div>
    <div class="iconosredes_resumencla noelegidored" id="p_resumen" red="pinterest"></div>
    <div class="iconosredes_resumencla noelegidored" id="b_resumen" red="blogger"></div>
    <div class="iconosredes_resumencla noelegidored" id="meneame_resumen" red="meneame"></div>
    <div class="iconosredes_resumencla noelegidored" id="tumbl_resumen" red="tumblr"></div>
    <div class="iconosredes_resumencla noelegidored" id="reddit_resumen" red="reddit"></div>
    <div class="iconosredes_resumencla noelegidored" id="digg_resumen" red="digg"></div>
    <div class="iconosredes_resumencla noelegidored" id="delicius_resumen" red="delicious"></div>
    <div style="display: none;" id="redes_seleccionadas">
    @if(Session::has('campania.redes'))
    @foreach(Session::get('campania.redes') as $red)
    <input type="hidden" value="{{ $red }}" />
    @endforeach
    @endif
</div>
<div class="cleaner"></div>
</div><!--resumenredes_clasica-->
</div><!--resumen_redes-->

<div id="resumen_envio">
    <p class="secciones">Env&iacute;o de la Campa&ntilde;a</p>
    @if(Session::has('campania.programacion'))
    <img src="{{ asset('internas/imagenes/programar_clasico.png') }}" width="107" height="100">
    <p id="horario_programado">Entrega Programada:<br>
    <?php
      $prog = Carbon::createFromFormat('d/m/Y', Session::get('campania.programacion'));
      $dias = Config::get('trebolnews.dias');
      $meses = Config::get('trebolnews.meses');
    ?>
    {{ $dias[$prog->format('w')] . ' ' . $prog->format('j') . ' de ' . $meses[$prog->format('n') - 1] . ' de ' . $prog->format('Y g:i A') }}
    </p>
    @else
    <img src="{{ asset('internas/imagenes/inmediato_clasico.png') }}" width="107" height="100">
    <p id="horario_programado">Envío Inmediato</p>
    @endif
    <div class="cleaner"></div>
</div><!--resumen_envio-->

</div><!--configuracion_resumen-->




<div id="contenidoyprueba_resumen">

<div id="contenido_resumen" class="resumen_bien" >
<div class="tiyulos_resumen">
<h3>Contenido</h3>
<a class="editar_resumen" href="#">editar</a>
<a class="ver_resumen" href="#">ver</a>
<div class="cleaner"></div>
</div><!--tiyulos_resumen-->
<table cellpadding="0" cellspacing="0" id="campania_resumen">
<tr><td>{{ Session::get('campania.contenido') }}</td></tr>
</table>
</div><!--contenido_resumen-->


<div id="probarenvio_resumen">
<h3>Prueba</h3>
<p>Realice un envi&oacute; de prueba. Separar emails por punto y coma.</p>
<form>
<textarea class="emaildeprueba" class="textarea" placeholder="emailderegistro@login.com"></textarea>
<div id="boton_prueba">
<input type="button" value="PROBAR" id="probar_boton" />
<div class="cleaner"></div>
</div>
</form>
</div><!--probarenvio_resumen-->


<div class="cleaner"></div>
</div><!--contenidoyprueba_resumen-->



<div id="opciones_pasos" ajax="{{ action('CampaniaController@guardar_campania') }}">
<a id="guardarysalir" href="{{ route('campanias') }}" class="btn_guardar" y="salir">GUARDAR Y SALIR</a>
<ul>
<li><a href="{{ route('paso_4') }}" id="anterior">ANTERIOR</a></li>
<li><a href="{{ route('campanias') }}" id="siguiente" class="btn_guardar" y="confirmar">
  @if(Session::get('campania.envio') == 'inmediato')
  ENVIAR
  @elseif(Session::get('campania.envio') == 'programado')
  PROGRAMAR
  @endif
</a></li>
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