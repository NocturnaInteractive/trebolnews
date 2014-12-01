@extends('admin/master')

@section('titulo')

    {{ $categoria ? 'Editar categoría' : 'Agregar categoría' }}

@stop

@section('head')

    <script>
    $(function(){

        $('#btn_categoria').one('click', categoria_handler);

        function categoria_handler(e) {
            e.preventDefault();

            $('#btn_categoria').on('click', preventDefault);

            $('#frm_categoria').ajaxSubmit({
                success: function(data) {
                    if(data.status == 'ok') {
                        window.location = data.route;
                    } else {
                        notys(data.validator);
                    }
                },
                complete: function() {
                    $('#btn_categoria').one('click', categoria_handler);
                }
            });

        }

    });
    </script>

@stop

<h4>
    <a href="{{ route('admin/home') }}">Menú principal</a>
</h4>

@section('contenido')

    <form id="frm_categoria" action="{{ action('CategoriaController@guardar') }}" method="post">
        @if($categoria)
        <input type="hidden" name="id" value="{{ $categoria->id }}" />
        @endif
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="{{ $categoria ? $categoria->nombre : '' }}" />
        </p>

        <p>
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" value="{{ $categoria ? $categoria->descripcion : '' }}" />
        </p>

        <p>
            <input type="submit" id="btn_categoria" value="Enviar" />
        </p>

    </form>

@stop
