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

        $('#consultachat input[type="submit"]').one('click', consultachat_handler);

        function consultachat_handler(e) {
            e.preventDefault();

            $('#consultachat input[type="submit"]').on('click', function(e){
                e.preventDefault();
            });

            $('#consultachat').ajaxSubmit({
                success: function(data) {
                    if(data.status == 'ok') {
                        noty({
                            type: 'success',
                            text: data.mensaje,
                            layout: 'topCenter',
                            timeout: 5000,
                            maxVisible: 10
                        });
                        $('#showRight').trigger('click');
                        $('#consultachat')[0].reset();
                    } else {
                        notys(data.validator);
                    }
                },
                complete: function() {
                    $('#consultachat input[type="submit"]').one('click', consultachat_handler);
                }
            });
        }

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
        <form id="consultachat" action="{{ action('ExtraController@guardar_comentario') }}" method="post">
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
                <input class="btn" id="borrar" type="reset" value="BORRAR" name="borrar" />
                <input type="submit" value="ENVIAR" name="enviar" id="saveForm" />
                <div class="cleaner"></div>
            </div><!--botones_consultachat-->
        </form>
    </div><!--cbp-spmenu-s2-->
</div><!--chat--><!-- #EndLibraryItem -->
