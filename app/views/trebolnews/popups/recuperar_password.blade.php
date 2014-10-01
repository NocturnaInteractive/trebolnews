<script>
$(function(){

    $('#formpopup #saveForm').one('click', recuperar_password_handler);

    function recuperar_password_handler(e) {
        e.preventDefault();

        $('#formpopup #saveForm').on('click', function(e){
            e.preventDefault();
        });

        $('#formpopup').ajaxSubmit({
            success: function(data) {
                if(data.status == 'ok') {
                    window.location = data.url;
                } else {
                    noty({
                        type: 'error',
                        text: data.mensaje,
                        layout: 'topCenter',
                        timeout: 5000,
                        maxVisible: 10
                    });
                }
            },
            complete: function() {
                $('#formpopup #saveForm').one('click', recuperar_password_handler);
            }
        });
    }

    $('#formpopup input').on('keypress', function(e){
        if(e.which == 13) {
            e.preventDefault();
            $('#formpopup #saveForm').trigger('click');
        }
    });

});
</script>

<div id="bg_popup">
    <div id="container_popup" class="popup_recuperar_cont">
        <div id="encabeezado">
            <h3>Recupera tu Contrase&ntilde;a</h3>
            <a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
            <div class="cleaner"></div>
        </div><!--encabeezado-->
        <div id="info_popup">
            <form id="formpopup" action="{{ action('UsuarioController@pre_recuperar_password') }}" method="post">
                <input name="email" type="text" class="unico" placeholder="Email:" />
                <div id="botones_popup">
                    <input type="button" value="ENVIAR" name="submit" id="saveForm" />
                    <input class="btn" id="borrar" type="reset" value="BORRAR" name="Enviar2" />
                    <div class="cleaner"></div>
                </div>
            </form>
        </div><!--info_popup-->
    </div><!--container_popup-->
</div><!--bg_popup-->
