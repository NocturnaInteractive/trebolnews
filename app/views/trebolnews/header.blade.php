<script>
$(function() {
    $('nav ul li a').removeClass('apretado');
    $('nav ul li a[menu_principal="' + $('#menu_principal').val() + '"]').addClass('apretado');
});
</script>

<div class="information-header">
    <div class="center">
        <!--p>SUSCRIPTORES: <span class="yellow">{{Auth::user()->availableSuscriptors}}</span> comprados.</p-->
        <p><strong>ENVIOS DISPONIBLES<span class="yellow" style="margin-left:10px;">{{Auth::user()->availableMails}}</span></strong></p>
    </div>
</div>

<header>
    <div id="conheader">
        <h1><a href="{{ url('/') }}">TrebolNEWS</a></h1>
        <div id="menu" class="cbp-fbscroller">
            <nav>
                <ul>
                    <li><a href="{{ route('campanias') }}" menu_principal="campanias">Campa&ntilde;as</a></li>
                    <li><a href="{{ route('suscriptores') }}" menu_principal="suscriptores">Suscriptores</a></li>
                    <li><a href="{{ route('librerias') }}" menu_principal="librerias">Librer&iacute;as</a></li>
                    <li><a href="{{ route('planes') }}" menu_principal="planes">Planes</a></li>
                    <li><a href="{{ route('soporte') }}" menu_principal="soporte">Soporte</a></li>
                    <li>
                        <a href="#" id="logout">
                            @if(Auth::user()->nombre)
                            {{ trim(Auth::user()->nombre . ' ' . Auth::user()->apellido) }}
                            @else
                            {{ substr(Auth::user()->email, 0, strpos(Auth::user()->email, '@') + 2) . '...' }}
                            @endif
                            <img src="{{ asset('internas/imagenes/engrane.png') }}" width="20" height="20" alt="engranaje">
                            <div class="cleaner"></div>
                        </a>
                        <ul>
                            <li><a href="{{ route('perfil') }}">Configuraci&oacute;n de cuenta</a></li>
                            <li><a href="{{ url('logout') }}">Cerrar sesi&oacute;n</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="cleaner"></div>
        </div>
    </div>
</header>
