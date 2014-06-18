
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TrebolNEWS / Editar perfil</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>

      {{ HTML::style('internas/css/style.css') }}
      {{ HTML::script('js/jquery-1.11.0.min.js') }}
      {{ HTML::script('js/jquery.form.min.js') }}
      {{ HTML::script('js/jquery.noty.packaged.min.js') }}
      <!--chat-->
	    {{ HTML::script('home/js/modernizr.custom.js') }}
      <!--chat-->
        <script>
        $(function() {
            $('#saveForm').one('click', editar_perfil_handler);

            function editar_perfil_handler(e) {
                e.preventDefault();

                $('#saveForm').on('click', function(e) {
                    e.preventDefault();
                });

                $('#formularioperfil').ajaxSubmit({
                    success: function(data) {
                        if(data.status == 'ok') {
                            window.location = data.url;
                        } else {
                            $.each(data.validator, function(i, v) {
                                noty({
                                    text: v,
                                    layout: 'topCenter',
                                    timeout: 5000
                                });
                            });
                        }
                    },
                    complete: function() {
                        $('#saveForm').one('click', editar_perfil_handler);
                    }
                });
            }
        });
      </script>
    </head>
    <body>
       <header>
    <div id="conheader">
    <h1>TrebolNEWS</h1>

<div id="menu" class="cbp-fbscroller" >
  @include('menu')
  <input type="hidden" id="menu_principal" value="" />
  <div class="cleaner"></div>
</div>

    </div><!-- #BeginLibraryItem "/Library/chat.lbi" --><div id="chat">
    <button id="showRight">Chatee con un operador</button>

    		<div class="cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
			<h3>Consultas</h3><div id="formah3"></div>
	        <div class="cleaner"></div>

       <form id="consultachat" action="" method="post">

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
        <input type="button" value="ENVIAR" name="enviar" id="saveForm2" />
        <div class="cleaner"></div>
	    </div><!--botones_consultachat-->
		</form>

		</div><!--cbp-spmenu-s2-->

    </div><!--chat--><!-- #EndLibraryItem --></header>
<div id="container">


			<section class="tabs">

	          <div class="content">
			  <h2>Editar perfil</h2>
              <a id="volver" href="{{ route('perfil') }}"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
			  <div class="infocont">



       <form id="formularioperfil" action="{{ action('UsuarioController@editar_perfil') }}" method="post">
        <input type="hidden" name="id" value="{{ Auth::user()->id }}" />
		<input name="nombre" type="text" class="text" placeholder="Nombre:" value="{{ Auth::user()->nombre }}" />
        <input name="apellido" type="text" class="text der" placeholder="Apellido:" value="{{ Auth::user()->apellido }}" />
        <input name="telefono" type="text" class="text" placeholder="Tel&eacute;fono:" value="{{ Auth::user()->telefono }}" />
		<input name="email" type="text" class="text der" placeholder="Email:" value="{{ Auth::user()->email }}" disabled />
		<input name="empresa" type="text" class="text empresa" placeholder="Empresa:" value="{{ Auth::user()->empresa }}" />
        <input name="ciudad" type="text" class="text" placeholder="Ciudad:" value="{{ Auth::user()->ciudad }}" />

        <select name="pais" class="select der" SIZE="1">
          <option value="" selected="1">Pa&iacute;s</option>
          <option>Argentina</option>
          <option>Bolivia</option>
          <option>Brasil</option>
          <option>Chile</option>
          <option>Colombia</option>
          <option>Costa Rica</option>
          <option>Cuba</option>
          <option>Ecuador</option>
          <option>El Salvador</option>
          <option>Guayana Francesa</option>
          <option>Granada</option>
          <option>Guatemala</option>
          <option>Guayana</option>
          <option>Haití</option>
          <option>Honduras</option>
          <option>Jamaica</option>
          <option>México</option>
          <option>Nicaragua</option>
          <option>Paraguay</option>
          <option>Panamá</option>
          <option>Perú</option>
          <option>Puerto Rico</option>
          <option>República Dominicana</option>
          <option>Surinam</option>
          <option>Uruguay</option>
          <option>Venezuela</option>
        </select>
        <div class="cleaner"></div>
        <!-- <textarea name="comentario" placeholder="Consulta:" class="textarea"></textarea> -->


        <!-- <div id="checkbox">
        <h4>Eleg&iacute; una opci&oacute;n</h4>

        <p>Opci&oacute;n 1</p>
        <div class="checkbox">
        <input type="checkbox"  id="checkbox1" name="" checked="checked" />
        <label for="checkbox1"></label>
        </div>
        <p>Opci&oacute;n 2</p>
        <div class="checkbox">
        <input type="checkbox"  id="checkbox2" name="" />
        <label for="checkbox2"></label>
        </div>
        <p>Opci&oacute;n 3</p>
        <div class="checkbox">
        <input type="checkbox"  id="checkbox3" name="" />
        <label for="checkbox3"></label>
        </div>


        </div> -->

        <!-- <div id="radio">
        <h4>Eleg&iacute; una opci&oacute;n</h4>
        <p>Opci&oacute;n 1</p>
        <div class="radio">
        <input type="radio" id="opcion1" name="opcion" checked="checked" />
        <label for="opcion1"></label>
        </div>
        <p>Opci&oacute;n 2</p>
        <div class="radio">
        <input type="radio" id="opcion2" name="opcion" />
        <label for="opcion2"></label>
        </div>
        <p>Opci&oacute;n 3</p>
        <div class="radio">
        <input type="radio" id="opcion3" name="opcion" />
        <label for="opcion3"></label>
        </div>
        </div> -->


		<div class="cleaner"></div>
        <div id="botonesform" class="buttons">
        <input type="button" value="GUARDAR" name="submit1" id="saveForm" />
        <input class="btn"  id="borrar" type="reset" value="BORRAR" name="Enviar2" />
        <div class="cleaner"></div>
		</div>

		</form>




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


    </body>
</html>