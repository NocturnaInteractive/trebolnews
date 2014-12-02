<script>
$(function() {
    $('#saveForm3').one('click', mover_imagen_handler);

    function mover_imagen_handler(e) {
        e.preventDefault();

        $('#saveForm3').on('click', function(e) {
            e.preventDefault();
        });

        $('#frm_mover_imagen').ajaxSubmit({
            beforeSerialize: function() {
                $('#frm_mover_imagen #formdata').html('');
                $('#frm_mover_imagen #formdata').append($('[name="chk_imagen[]"]:checked').clone());
            },
            success: function(data) {
                if(data.status == 'ok') {
                    location.reload();
                } else {
                    notys(data.validator);
                }
            },
            complete: function() {
                $('#saveForm3').one('click', mover_imagen_handler);
            }
        });
    }

    $('#frm_mover_imagen input').on('keypress', function(e) {
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
            <h3>Mover imágenes</strong></h3>
            <a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
            <div class="cleaner"></div>
        </div><!--encabeezado-->
        <div id="info_popup">
            <form class="formpopup" id="frm_mover_imagen" action="{{ action('ImagenController@mover') }}" method="post">
                <div id="formdata" style="display: none;"></div>
                <label>Seleccione una carpeta:</label>
                <select name="id_carpeta">
                    <option value="">---</option>
                    @foreach($carpetas as $carpeta)
                    <option value="{{ $carpeta->id }}">{{ Str::title($carpeta->descripcion) }}</option>
                    @endforeach
                </select>
                <div id="botones_popup">
                    <input type="button" value="ACEPTAR" name="submit" id="saveForm3" />
                    <!-- <input class="btn"  id="borrar3" type="reset" value="BORRAR" name="Enviar2" /> -->
                    <div class="cleaner"></div>
                </div>
            </form>
        </div><!--info_popup-->
    </div><!--container_popup-->
</div><!--bg_popup-->
