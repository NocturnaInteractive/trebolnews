<html>
    <head>
        <title>
            @yield('titulo')
        </title>

        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        {{ HTML::script('js/jquery.form.min.js') }}
        {{ HTML::script('js/jquery.noty.packaged.min.js') }}
        {{ HTML::script('js/trebolnews.js') }}

        @section('script')
        @show

        {{ HTML::style('css/admin.css') }}
    </head>
    <body>
        <h1>
            @yield('titulo')
        </h1>
        <div id="contenido">
            @section('contenido')
            @show
        </div>
    </body>
</html>
