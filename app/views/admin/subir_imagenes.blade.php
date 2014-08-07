<html>
    <head>
        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        {{ HTML::script('js/jquery.form.min.js') }}
        {{ HTML::script('js/jquery.noty.packaged.min.js') }}
        {{ HTML::script('js/trebolnews.js') }}

        {{ HTML::style('css/admin.css') }}

        <script>
        $(function(){
            $('#btn_subir_imagenes').one('click', subir_imagenes_handler);

            function subir_imagenes_handler(e) {
                e.preventDefault();

                $('#btn_subir_imagenes').on('click', function(e){
                    e.preventDefault();
                });

                $('#frm_subir_imagenes').ajaxSubmit({
                    success: function(data) {
                        if(data.status == 'ok') {
                            window.location = data.route;
                        } else {
                            notys(data.validator);
                        }
                    },
                    complete: function() {
                        $('#btn_subir_imagenes').one('click', subir_imagenes_handler);
                    }
                });
            }
        });
        </script>
    </head>
    <body>
        <h2>Subir imágenes para el template <em>{{ $template->nombre }}</em></h2>
        <form id="frm_subir_imagenes" action="{{ action('TemplateController@subir_imagenes') }}" method="post">
            <input type="hidden" name="id" value="{{ $template->id }}" />
            @foreach($imagenes as $imagen)
            <p>
                <label>{{ $imagen }}</label>
                <input type="file" name="{{ $imagen }}" />
            </p>
            @endforeach
            <input id="btn_subir_imagenes" type="submit" value="Enviar" />
        </form>
    </body>
</html>