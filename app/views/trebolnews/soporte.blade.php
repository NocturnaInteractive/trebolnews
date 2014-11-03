@extends('trebolnews/master')

@section('title')

    TrebolNEWS / Soporte

@stop

@section('script')

<script>
    $(function(){
        $('#form_contacto input[type="button"]').one('click', form_contacto_handler);

        function form_contacto_handler(e) {
            e.preventDefault();

            $('#form_contacto input[type="button"]').on('click', function(e){
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
                        $('#form_contacto')[0].reset();
                    } else {
                        notys(data.validator);
                    }
                },
                complete: function() {
                    $('#form_contacto input[type="button"]').one('click', form_contacto_handler);
                }
            });
        }
    });
</script>

@stop

@section('contenido')

    <div id="container">
        <section class="tabs">
            <div class="content">
                <h2>Soporte</h2>
                <div class="infocont">
                    <div id="consulta">
                    <h3>Dejanos tu consulta</h3>
                    <form id="form_contacto" action="{{ action('ExtraController@guardar_comentario') }}" method="post">
                        <input type="hidden" name="nombre" value="{{ Auth::user()->nombre ?: 'N/A' }}" />
                        <input type="hidden" name="apellido" value="{{ Auth::user()->apellido ?: 'N/A' }}" />
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}" />
                        <textarea name="comentario" class="textarea" placeholder="Consulta:"></textarea>
                        <div id="botonesform" class="buttons">
                            <input type="button" value="ENVIAR" name="submit1" id="saveForm" />
                            <input class="btn" id="borrar" type="reset" value="BORRAR" name="Enviar2" />
                        </div>
                    </form>
                    </div><!--consulta-->
                </div> <!--infocont-->
            </div>
        </section>
    </div>

@stop
