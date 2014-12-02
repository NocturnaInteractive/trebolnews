<script>
$(function(){
    $('#saveForm3').one('click', subir_imagen_handler);

    function subir_imagen_handler(e) {
        e.preventDefault();

        $('#saveForm3').on('click', function(e) {
            e.preventDefault();
        });

        $('#subirdesdepc').ajaxSubmit({
            data: {
                id_carpeta: $('#id_carpeta').val() // esta data está en views/trebolnews/libreria
            },
            success: function(data) {
                if(data.status == 'ok') {
                    location.reload();
                } else {
                    notys(data.validator);
                }
            },
            complete: function() {
                $('#saveForm3').one('click', subir_imagen_handler);
            }
        });
    }
});
</script>

<div id="bg_popup">
    <div id="container_popup" class="popup_listasuscriptores">
        <div id="encabeezado">
            <h3>Subir desde Mi PC</h3>
            <a href="#" id="cerrar_popup">
                <img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18">
            </a>
            <div class="cleaner"></div>
        </div><!--encabeezado-->
        <div id="info_popup">
            <form id="subirdesdepc" action="{{ action('ImagenController@guardar') }}" method="post">
                <input name="imagen" type="file" id="file" />
                <div id="botones_popup">
                    <input type="button" value="SUBIR" name="submit" id="saveForm3" />
                    <div class="cleaner"></div>
                </div>
            </form>
        </div><!--info_popup-->
    </div><!--container_popup-->
</div><!--bg_popup-->
