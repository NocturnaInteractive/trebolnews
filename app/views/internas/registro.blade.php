<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>TrebolNEWS / Registro</title>

		<link rel="shortcut icon" href="favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>

        {{ HTML::style('internas/css/style.css') }}

		{{ HTML::script('js/jquery-1.11.0.min.js') }}
		{{ HTML::script('js/jquery.form.min.js') }}
		{{ HTML::script('js/jquery.noty.packaged.min.js') }}
    </head>
    <body style="background-color:#17A387; background-image:url(internas/imagenes/registro.png); background-repeat:no-repeat; background-position: bottom center; background-size:auto">
       <header>
    <div id="conheader">
    <a href="{{ url('/') }}"><h1>TrebolNEWS</h1></a>
    <a id="volver" href="{{ url('/') }}"><img src="{{ asset('internas/imagenes/iconovolver.png') }}" alt="volver" width="26" height="26"></a>
    <div class="cleaner"></div>
    </div>
    </header>
<div id="container_registro">
<div id="content_registro" >
<h2>Registro</h2>
<p>Al registrarse a nuestro sitio, le llegar&aacute; un mail de validaci&oacute;n de cuenta.</p>
	<script>
	$(function(){
		$('#saveForm').one('click', registro_handler);

		function registro_handler(e) {
			e.preventDefault();

			$('#saveForm').on('click', function(e) {
				e.preventDefault();
			});

			$('#formulariregistro').ajaxSubmit({
				success: function(data) {
					if(data.status == 'ok') {
						window.location = data.url;
					} else {
						if(data.mensaje) {
							console.log(data.mensaje);
						}
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
					$('#saveForm').one('click', registro_handler);
				}
			});
		}

		$('#formulariregistro input').on('keypress', function(e) {
			if(e.which == 13) {
				e.preventDefault();
				$('#saveForm').trigger('click');
			}
		});
	});
	</script>
    <form id="formulariregistro"  method="post" action="{{ action('UsuarioController@registrar') }}">
    <ul>
	<li><input name="email" type="text" class="text" placeholder="Email:" /></li>
    <li><input name="password" type="password" class="text" placeholder="Password:" /></li>
    <li><input name="password_confirmation" type="password" class="text" placeholder="Confirmaci&oacute;n del password:" /></li>
    </ul>
    <ul id="registrocheckbox">
    <li><div class="checkbox">
    <input type="checkbox"  id="checkbox1" name="newsletter" checked="checked" />
    <label for="checkbox1"></label>
    </div>
    <p>Deseo suscribirme al Newsletter</p></li>

    <li><div class="checkbox">
    <input type="checkbox" id="checkbox2" name="tyc" />
    <label for="checkbox2"></label>
    </div>
    <p>Acepto los <a href="{{ route('tyc') }}" target="_blank">T&eacute;rminos y Condiciones</a></p></li>
    </ul>
    <div class="buttons">
    <input type="button" value="REGISTRARSE" name="submit1" id="saveForm" />
    <div class="cleaner"></div>
	</div>
	</form>
</div><!--content_registro-->
</div><!--container_registro-->




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