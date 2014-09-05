<div id="foo">
    <div id="foo_text">
        <div id="foo_izq">
            <h6>TrebolNEWS</h6>
            <p>www.trebolnews.com - Copyright 2013</p>
        </div>
        <div id="foo_der">
            <a href="#" class="twe">Seguinos por Tweeter</a>
            <a href="#" class="face">Estamos en Facebook</a>
            <form id="subanewsletter" method="post" action=""> <!-- es necesario que coincida el nombre de este archivo php con el que aparece en el campo action -->
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
