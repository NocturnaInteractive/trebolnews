<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TrebolNEWS</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/estilo.css') }}" />
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>
        {{ HTML::script('js/jquery-1.11.1.min.js') }}
        {{ HTML::script('js/jquery.form.min.js') }}
        {{ HTML::script('js/jquery.noty.packaged.min.js') }}
        {{ HTML::script('js/trebolnews.js') }}
        <script>
        $(function(){
            $('#bothome').one('click', recuperar_handler);

            function recuperar_handler(e) {
                e.preventDefault();

                $('#bothome').on('click', function(e){
                    e.preventDefault();
                });

                $('#frm_recuperar_password').ajaxSubmit({
                    success: function(data) {
                        if(data.status == 'ok') {
                            window.location = data.url;
                        } else {
                            notys(data.validator);
                        }
                    },
                    complete: function() {
                        $('#bothome').one('click', recuperar_handler);
                    }
                });
            }

            $('#frm_recuperar_password input').on('keypress', function(e){
                if(e.which == 13) {
                    e.preventDefault();
                    $('#bothome').trigger('click');
                }
            });
        });
        </script>
    </head>
    <body style="background-color:#17A387; background-image:url(../imagenes/confirma_bg.png); background-repeat:no-repeat; background-position: bottom center; background-size:auto; height:auto">
        <div id="conteinerco">
            <a href="{{ route('home') }}"><h1>TrebolNEWS</h1></a><br>
            <h2>Escriba una contraseña nueva</h2>
            <p></p>
            <form id="frm_recuperar_password" action="{{ action('UsuarioController@cambiar_password') }}" method="post">
                <input type="hidden" name="usuario_id" value="{{ $usuario->id }}" />
                <input type="password" name="password" />
                <input type="password" name="password_confirmation" />
            </form>
            <div id="bothome"><a href="#">CAMBIAR CONTRASEÑA</a></div>
        </div>
    </body>
</html>
