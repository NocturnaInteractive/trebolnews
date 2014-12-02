<script>
$(function() {
    $('#saveForm3').one('click', guardar_imagen_handler);

    function guardar_imagen_handler(e) {
        e.preventDefault();

        $('#saveForm3').on('click', function(e) {
            e.preventDefault();
        });

        $('#frm_guardar_imagen').ajaxSubmit({
            success: function(data) {
                if(data.status == 'ok') {
                    location.reload();
                } else {
                    console.log(data);
                }
            },
            complete: function() {
                $('#saveForm3').one('click', guardar_imagen_handler);
            }
        });
    }

    $('#frm_guardar_imagen input').on('keypress', function(e) {
        if(e.which == 13) {
            e.preventDefault();
            $('#saveForm3').trigger('click');
        }
    });
});
</script>

<div id="bg_popup">
    <div id="container_popup" class="popup_listasuscriptores">
        <div id="encabeezado">
            <h3>Cambiar nombre a la imagen</strong></h3>
            <a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
            <div class="cleaner"></div>
        </div><!--encabeezado-->
        <div id="info_popup">
            <form class="formpopup" id="frm_guardar_imagen" action="{{ action('ImagenController@guardar') }}" method="post">
                <input type="hidden" name="id" value="{{ $imagen->id }}" />
                <input name="nombre" type="text" class="unico" placeholder="Nombre:" value="{{ $imagen->nombre }}" />
                <div id="botones_popup">
                    <input type="button" value="GUARDAR" name="submit" id="saveForm3" />
                    <input class="btn"  id="borrar3" type="reset" value="BORRAR" name="Enviar2" />
                    <div class="cleaner"></div>
                </div>
            </form>
        </div><!--info_popup-->
    </div><!--container_popup-->
</div><!--bg_popup-->
