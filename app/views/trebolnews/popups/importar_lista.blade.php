<script>
$(function() {

    $('#frm_importar_lista #saveForm').one('click', importar_lista_handler);

    function importar_lista_handler(e) {
        e.preventDefault();

        $('#frm_importar_lista #saveForm').on('click', function(e){
            e.preventDefault();
        });

        $('#frm_importar_lista').ajaxSubmit({
            data: {
                id_lista: $('#id_lista').val()
            },
            success: function(data) {
                if(data.status == 'ok') {
                    window.location = data.route;
                } else {
                    notys(data.validator);
                }
            },
            complete: function() {
                $('#frm_importar_lista #saveForm').one('click', importar_lista_handler);
            }
        });
    }

});
</script>

<div id="bg_popup">
    <div id="container_popup" class="popup_listasuscriptores">
        <div id="encabeezado">
            <h3>Importar lista de suscriptores</h3>
            <a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
            <div class="cleaner"></div>
        </div><!--encabeezado-->
        <div id="info_popup">
            <form class="formpopup" id="frm_importar_lista" action="{{ action('ListaController@import') }}" method="post">
                <input name="archivo" type="file" class="unico" />
                <div id="botones_popup">
                    <input type="button" value="SUBIR" name="submit" id="saveForm" />
                    <!-- <input class="btn" id="borrar" type="reset" value="BORRAR" name="Enviar2" /> -->
                    <div class="cleaner"></div>
                </div>
            </form>
        </div><!--info_popup-->
    </div><!--container_popup-->
</div><!--bg_popup-->
