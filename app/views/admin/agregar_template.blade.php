<html>
    <head>
        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        {{ HTML::script('js/jquery.form.min.js') }}
        {{ HTML::script('js/jquery.noty.packaged.min.js') }}
        {{ HTML::script('js/trebolnews.js') }}

        {{ HTML::style('css/admin.css') }}

        <script>
        $(function(){
            $('#btn_agregar_template').one('click', agregar_template_handler);

            function agregar_template_handler(e) {
                e.preventDefault();

                $('#btn_agregar_template').on('click', function(e){
                    e.preventDefault();
                });

                $('#frm_agregar_template').ajaxSubmit({
                    success: function(data) {
                        if(data.status == 'ok') {
                            window.location = data.route;
                        } else {
                            if(data.validator) {
                                notys(data.validator);
                            } else {
                                noty({
                                    text: data.mensaje,
                                    layout: 'topCenter',
                                    timeout: 5000,
                                });
                            }
                        }
                    },
                    complete: function() {
                        $('#btn_agregar_template').one('click', agregar_template_handler);
                    }
                });
            }
        });
        </script>
    </head>
    <body>
        <form id="frm_agregar_template" action="{{ action('TemplateController@guardar') }}" method="post" enctype="multipart/form-data">
            <p>
                <label for="name">
                    Nombre:
                </label>
                <input type="text" name="name" />
            </p>

            <p>
                <label for="category">
                    Categoría:
                </label>
                <input type="text" name="category" />
            </p>

            <p>
                <label for="thumbnail">
                    Thumbnail:
                </label>
                <input type="file" name="thumbnail" />
            </p>

            <p>
                <label for="content">
                    Contenido:<br>
                    (images paths must be without "/". Eg: src="image.png")
                </label><br>
                <textarea style="width:100%; min-height:400px;" name="content"></textarea>
            </p>

            <p>
                <input id="btn_agregar_template" type="submit" value="Enviar" />
            </p>
        </form>
    </body>
</html>