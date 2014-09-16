<div id="bg_popup">
    <div id="container_popup" class="popup_recuperar_cont">
        <div id="encabeezado">
            <h3>Recupera tu Contrase&ntilde;a</h3>
            <a href="#" id="cerrar_popup"><img src="{{ asset('internas/imagenes/cerrar_popup.png') }}" alt="Cerrar Ventana" width="18" height="18"></a>
            <div class="cleaner"></div>
        </div><!--encabeezado-->
        <div id="info_popup">
            <form id="formpopup"  action="" method="post">
                <input name="nombre" type="text" class="unico" placeholder="Email:" />
                <div id="botones_popup">
                    <input type="button" value="ENVIAR" name="submit" onClick="enviar(this.form)" id="saveForm" />
                    <input class="btn"  id="borrar" type="reset" value="BORRAR" name="Enviar2" />
                    <div class="cleaner"></div>
                </div>
            </form>
        </div><!--info_popup-->
    </div><!--container_popup-->
</div><!--bg_popup-->
