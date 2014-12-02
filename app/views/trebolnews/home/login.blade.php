<script>
$(function(){

    $('#loginentrar').one('click', login_handler);

    function login_handler(e) {
        e.preventDefault();

        $('#loginentrar').on('click', function(e) {
            e.preventDefault();
        });

        $('#frm_login').ajaxSubmit({
            success: function(data) {
                if(data.status == 'ok') {
                    location.reload();
                } else {
                    $('#validator').css('display', 'none');
                    if(data.validator) {
                        $.each(data.validator, function(i, v) {
                            $('#validator').text(v);
                            return false;
                            // noty({
                            //     text: v,
                            //     layout: 'topCenter',
                            //     timeout: 5000
                            // });
                    });
                        $('#validator').fadeIn(50, function(){
                            setTimeout(function(){
                                $('#validator').fadeOut(50, function() {
                                    $('#validator').text('').css('display', 'block');
                                });
                            }, 5000)
                        });
                    } else {
                        $('#validator').text(data.mensaje);
                        $('#validator').fadeIn(50, function(){
                            setTimeout(function(){
                                $('#validator').fadeOut(50, function(){
                                    $('#validator').text('').css('display', 'block');
                                });
                            }, 5000)
                        });
                        // noty({
                        //     text: data.mensaje,
                        //     layout: 'topCenter',
                        //     timeout: 5000
                        // });
                    }
                }
            },
            complete: function() {
                $('#loginentrar').one('click', login_handler);
            }
        });
    }

    $('#frm_login input').on('keypress', function(e) {
        if(e.which == 13) {
            $('#loginentrar').trigger('click');
        }
    });

});
</script>

<div id="sublogin"><a href="#" id="login"><img src="{{ asset('imagenes/iconlogin.png') }}" width="12px" height="14px" alt="icono de login">Iniciar Sesi&oacute;n</a>
    <ul>
        <span id="subflecha"></span>
        <div id="formasublogin">
            <form id="frm_login" action="{{ action('UsuarioController@login') }}" method="post">
                <li class="loginizq"><input name="email" type="text"  id="loginemail" placeholder="Email:" /></li>
                <li class="loginder"><input name="password" type="password"  id="loginpass"  placeholder="Password:" /></li>
                <li class="loginizq"><input class="btn"  id="loginborrar" type="reset" value="BORRAR" name="Enviar2" /></li>
                <li class="loginder"><input type="button" value="ENTRAR" name="submit1" id="loginentrar" /></li>
            </form>
            <div class="cleaner"></div>
            <li><p id="validator"></p></li>
            <li><hr></li>
            <li class="loginizq"><a href="{{ action('UsuarioController@facebook_login') }}" id="face">Connect</a></li>
            <li class="loginder"><a href="{{ route('registro') }}" id="registro">Reg&iacute;strate Gratis</a></li>
            <li><a href="#" id="olvido" popup="{{ url('popup/recuperar_password') }}">&iquest;Olvidaste tu contrase&ntilde;a?</a></li>
        </div>
    </ul>
    <div class="cleaner"></div>
</div>
