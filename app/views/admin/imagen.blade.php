@extends('admin/master')

@section('titulo')

    {{ $imagen ? 'Editar imagen' : 'Agregar imagen' }}

@stop

@section('script')

<script>
    $(function(){
        $('#btn_imagen').one('click', imagen_handler);

        function imagen_handler(e) {
            e.preventDefault();

            $('#btn_imagen').on('click', function(e){
                e.preventDefault();
            });

            $('#frm_imagen').ajaxSubmit({
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
                    $('#btn_imagen').one('click', imagen_handler);
                }
            });
        }

        $('#frm_imagen input').on('keypress', function(e){
            if(e.which == 13) {
                e.preventDefault();

                $('#btn_imagen').trigger('click');
            }
        });

        $('#ipt_imagen').on('change', function(){
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_imagen').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

    });
</script>

@stop

<h4>
    <a href="{{ route('admin/home') }}">Menú principal</a>
</h4>

@section('contenido')

    <form id="frm_imagen" action="{{ action('ImagenController@guardar_interna') }}" method="post">
        @if($imagen)
            <input type="hidden" name="id" value="{{ $imagen->id }}" />
        @endif
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="{{ $imagen ? $imagen->nombre : '' }}" />
        </p>

        <p>
            <label for="archivo">Archivo:</label>
            <input id="ipt_imagen" type="file" name="archivo" />
        </p>

        <p>
            <label for="categoria">Categoria:</label>
            <select name="id_categoria">
                <option value="">---</option>
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ $imagen ? ($imagen->id == $categoria->id ? 'selected' : '') : '' }} >{{ $categoria->descripcion }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <img id="img_imagen" src="{{ $imagen ? asset($imagen->archivo) : '' }}" />
        </p>

        <p>
            <input type="submit" id="btn_imagen" value="Enviar" />
        </p>
    </form>

@stop
