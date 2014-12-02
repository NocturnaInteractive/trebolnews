<script>
    $(function(){
        $('#form_contacto #saveForm').one('click', form_contacto_handler);

        function form_contacto_handler(e) {
            e.preventDefault();

            $('#form_contacto #saveForm').on('click', function(e){
                e.preventDefault();
            });

            $('#form_contacto').ajaxSubmit({
                success: function(data) {
                    if(data.status == 'ok') {
                        noty({
                            type: 'success',
                            text: data.mensaje,
                            layout: 'topCenter',
                            timeout: 5000,
                            maxVisible: 10
                        });
                    } else {
                        notys(data.validator);
                    }
                },
                complete: function() {
                    $('#form_contacto #saveForm').one('click', form_contacto_handler);
                }
            });
        }
    });
</script>

<div id="infocontacto">
    <form id="form_contacto" action="{{ action('ExtraController@guardar_comentario') }}" method="post">
        <ul>
            <li id="formizq">
                <ul>
                    <li class="izq" >
                        <input name="nombre" type="text" class="element text medium" id="element_1" placeholder="&nbsp;*Nombre:" />
                    </li>

                    <li class="der" >
                        <input name="apellido" type="text" class="element text medium"  placeholder="&nbsp;*Apellido:" />
                    </li>
                    <div class="cleaner"></div>

                    <li class="izq" >
                        <input id="element_2" name="telefono" class="element text medium" type="text" placeholder="Tel&eacute;fono:"  />
                    </li>

                    <li class="der" >
                        <input id="element_5" name="empresa" class="element text medium" type="text" placeholder="Empresa:" />
                    </li>

                    <div class="cleaner"></div>
                    <li>
                        <input id="element_3" name="email" class="element text medium" type="text" placeholder="&nbsp;*Email:"  />
                    </li>
                    <p style="margin-top:20px; font-size:14px; color:#FFF">*&nbsp;Campos obligatorios </p>
                </ul>
            </li>

            <li id="formder">
                <ul>
                    <li id="li_6" >
                        <textarea id="element_6" name="comentario" placeholder="&nbsp;*Comentario:" class="element textarea medium"></textarea>
                    </li>
                    <li id="botonesform" class="buttons">
                        <input type="button" value="ENVIAR" name="submit1" id="saveForm" />
                        <input class="btn"  id="borrar" type="reset" value="BORRAR" name="Enviar2" />
                        <div class="cleaner"></div>
                    </li>
                </ul>
            </li>

            <div class="cleaner"></div>
        </ul>
    </form>
</div><!--fin infocontacto-->
