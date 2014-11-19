<script>
$(function(){

    $('#frm_eliminar_lista_multi #data').append($('.checkbox input:checked').not('.todos').clone().attr('name', 'ids[]'));

    $('#bg_popup #borrar').on('click', function(e){
        e.preventDefault();
        $('#cerrar_popup').trigger('click');
    });

    $('#bg_popup #saveForm').one('click', eliminar_lista_multi_handler);

    function eliminar_lista_multi_handler(e) {
        e.preventDefault();

        $('#bg_popup #saveForm').on('click', function(e){
            e.preventDefault();
        });

        $('#frm_eliminar_lista_multi').ajaxSubmit({
            success: function(data) {
                location.reload();
            },
            complete: function() {
                $('#bg_popup #saveForm').one('click', eliminar_lista_multi_handler);
            }
        });
    }

});
</script>

<div id="bg_popup">
    <div id="container_popup" class="popup_eliminar">
        <div id="encabeezado">
            <h3>Eliminar lista de Suscriptores</h3>
            <a href="#" id="cerrar_popup"><img src="{{ asset('imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
            <div class="cleaner"></div>
        </div><!--encabeezado-->
        <div id="info_popup">
            <p id="pregunta_popup">&iquest;Est&aacute; seguro que desea eliminar las listas seleccionadas de forma permanente?</p>
            <div id="botones_popup">
                <form id="frm_eliminar_lista_multi" action="{{ action('ListaController@eliminar_multi') }}" method="post">
                    <input type="button" value="SI" name="submit" id="saveForm" />
                    <input class="btn" id="borrar" type="reset" value="NO" name="Enviar2" />
                    <div id="data" style="display:none;"></div>
                </form>
            <div class="cleaner"></div>
        </div>
        </div><!--info_popup-->
    </div><!--container_popup-->
</div><!--bg_popup-->
