{{ HTML::script('home/js/chat.js') }}

<script>
    $(function(){
        var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
            showRight = document.getElementById( 'showRight' ),
            showTop = document.getElementById( 'showTop' ),
            body = document.body;

        showRight.onclick = function() {
            classie.toggle( this, 'active' );
            classie.toggle( menuRight, 'cbp-spmenu-open' );
            disableOther( 'showRight' );
        };
    });

    function disableOther( button ) {
        if( button !== 'showRight' ) {
            classie.toggle( showRight, 'disabled' );
        }
    }
</script>

<div id="chat">
    <button id="showRight">Chatee con un operador</button>
    <div class="cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
        <h3>Consultas</h3>
        <div id="formah3"></div>
        <div class="cleaner"></div>
        <form id="consultachat" action="" method="post">
            <ul>
                <li class="izq_consultachat" ><input name="nombre" type="text" placeholder="&nbsp;*Nombre:" /></li>
                <li class="der_consultachat" ><input name="apellido" type="text" placeholder="&nbsp;*Apellido:" /></li>
                <div class="cleaner"></div>
                <li class="izq_consultachat" ><input name="telefono" type="text" placeholder="Tel&eacute;fono:"  /></li>
                <li class="der_consultachat" ><input name="empresa" type="text" placeholder="Empresa:" /></li>
                <div class="cleaner"></div>
                <li class="email_chat"><input name="email" type="text" placeholder="&nbsp;*Email:"  /></li>
                <li><textarea name="comentario" placeholder="&nbsp;*Comentario:"></textarea></li>
            </ul>
            <p>*&nbsp;Campos obligatorios</p>
            <div id="botones_consultachat">
                <input class="btn" id="borrar2" type="reset" value="BORRAR" name="borrar" />
                <input type="button" value="ENVIAR" name="enviar" id="saveForm2" />
                <div class="cleaner"></div>
            </div><!--botones_consultachat-->
        </form>
    </div><!--cbp-spmenu-s2-->
</div><!--chat--><!-- #EndLibraryItem -->
