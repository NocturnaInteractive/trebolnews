<script>
$(function(){
    $('#subanewsletter input[type="submit"]').one('click', subscripcion_handler);

    function subscripcion_handler(e) {
        e.preventDefault();

        $('#subanewsletter input[type="submit"]').on('click', function(e){
            e.preventDefault();
        });

        $('#subanewsletter').ajaxSubmit({
            success: function(data) {
                if(data.status == 'ok') {
                    noty({
                        type: 'success',
                        text: data.mensaje,
                        layout: 'topCenter',
                        timeout: 1000
                    });
                    $('#subanewsletter')[0].reset();
                } else {
                    notys(data.validator);
                }
            },
            complete: function() {
                $('#subanewsletter input[type="submit"]').one('click', subscripcion_handler);
            }
        });
    }
});
</script>

<div id="foo">
    <div id="foo_text">
        <div id="foo_izq">
            <h6>TrebolNEWS</h6>
            <p>www.trebolnews.com - Copyright 2013</p>
        </div>
        <div id="foo_der">
            <a href="{{ Config::get('trebolnews.twitter_page') }}" class="twe">Seguinos por Tweeter</a>
            <a href="{{ Config::get('trebolnews.facebook_page') }}" class="face">Estamos en Facebook</a>
            <form id="subanewsletter" method="post" action="{{ action('ExtraController@guardar_suscripcion') }}">
                <input type="text" name="email" class="compo-form" id="newsletter" placeholder="Suscr&iacute;bete a nuestro Newsletter"  style=" color:#FFF; font-size:12px;"  />
                <input type="submit" id="button" value="ENVIAR" />
            </form>
            <div class="cleaner"></div>
        </div>
        <div class="cleaner"></div>
        <div id="botones_footer">
            <ul>
                <li><a href="{{ route('campanias') }}">Campa&ntilde;as</a></li>
                <li><a href="{{ route('suscriptores') }}">Suscriptores</a></li>
                <li><a href="{{ route('librerias') }}">Librer&iacute;as</a></li>
                <li><a href="{{ route('planes') }}">Planes</a></li>
                <li><a href="{{ route('soporte') }}">Soporte</a></li>
                <li><a href="{{ route('tyc') }}" class="ultimo_boton_footer" target="_blank">Terminos y Condiciones</a></li>
            </ul>
            <div class="cleaner"></div>
        </div><!--botones_footer-->
    </div><!--fin de foo_text-->
</div>
