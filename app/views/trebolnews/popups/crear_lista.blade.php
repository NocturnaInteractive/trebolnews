<script>
$(function() {
    $('#frm_guardar_lista #saveForm').one('click', guardar_lista_handler);

    function guardar_lista_handler(e) {
        e.preventDefault();

        $('#frm_guardar_lista #saveForm').on('click', function(e) {
            e.preventDefault();
        });

        $('#frm_guardar_lista').ajaxSubmit({
            success: function(data) {
                if(data.status == 'ok') {
                    location.reload();
                } else {
                    notys(data.validator);
                }
            },
            complete: function() {
                $('#frm_guardar_lista #saveForm').one('click', guardar_lista_handler);
            }
        });
    }

    $('#frm_guardar_lista input').on('keypress', function(e) {
        if(e.which == 13) {
            e.preventDefault();
            $('#frm_guardar_lista #saveForm').trigger('click');
        }
    });
});
</script>

<div id="bg_popup">
    <div id="container_popup" class="popup_listasuscriptores">
        <div id="encabeezado">
            <h3>Crear lista de suscriptores</h3>
            <a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
            <div class="cleaner"></div>
        </div><!--encabeezado-->
        <div id="info_popup">
            <form class="formpopup" id="frm_guardar_lista" action="{{ action('ListaController@guardar') }}" method="post">
                <input name="nombre" type="text" class="unico" placeholder="Nombre de Lista:" />
                <div id="botones_popup">
                    <input type="button" value="GUARDAR" name="submit" id="saveForm" />
                    <input class="btn" id="borrar" type="reset" value="BORRAR" name="Enviar2" />
                    <div class="cleaner"></div>
                </div>
            </form>
        </div><!--info_popup-->
    </div><!--container_popup-->
</div><!--bg_popup-->
