@extends('admin/master')

@section('titulo')
    Administración TREBOLnews
@stop

@section('script')
    <script>
    $(function(){
        $('#btn_login').one('click', login_handler);

        function login_handler(e) {
            e.preventDefault();

            $('#btn_login').on('click', function(e){
                e.preventDefault();
            });

            $('#frm_login').ajaxSubmit({
                success: function(data) {
                    if(data.status == 'ok') {
                        window.location = data.route;
                    } else {
                        if(data.validator) {
                            notys(data.validator);
                        } else {
                            noty({
                                text: data.mensaje,
                                layout: 'topCenter',
                                timeout: 5000
                            });
                        }
                    }
                },
                complete: function() {
                    $('#btn_login').one('click', login_handler);
                }
            });
        }

        $('#frm_login input').on('keypress', function(e){
            if(e.which == 13) {
                e.preventDefault();
                $('#btn_login').trigger('click');
            }
        });
    });
    </script>
@stop

@section('contenido')

    <form id="frm_login" action="{{ action('AdminController@login') }}" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" />

        <label for="password">Contraseña:</label>
        <input type="password" name="password" />

        <input type="button" value="Login" id="btn_login" />
    </form>

@stop
