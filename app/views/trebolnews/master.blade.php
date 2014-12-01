<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es-ES" class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            @yield('title')
        </title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="shortcut icon" href="favicon.ico">
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,900,700,600,500,300,200,100' rel='stylesheet' type='text/css'>

        {{ HTML::style('internas/css/style.css') }}
        {{ HTML::style('css/trebolnews.css') }}

        {{ HTML::script('js/jquery-1.11.0.min.js') }}
        {{ HTML::script('js/jquery-ui-1.10.4.min.js') }}
        {{ HTML::script('js/jquery.form.min.js') }}
        {{ HTML::script('js/jquery.noty.packaged.min.js') }}
        {{ HTML::script('js/trebolnews.js') }}
        {{ HTML::script('home/js/modernizr.custom.js') }}

        @yield('script')
        @yield('head')
    </head>
    <body>
        <div style="display: none;">
            @section('data')

            <input type="hidden" id="session_url" value="{{ url('session') }}" />
            <input type="hidden" id="preference_url" value="{{ url('set_preference') }}" />

            @show
        </div>

        @include('trebolnews/header')

        @include('trebolnews/chat')

        @yield('contenido')

        @include('trebolnews/footer')
        <div id="popup">

        </div>
    </body>
</html>