@foreach($listas as $lista)
    <tr>
        <td>
            <div class="checkbox">
                <input type="checkbox" name="chk_lista[]" value="{{ $lista->id }}" />
                <label></label>
            </div>
        </td>
        <td><a href="{{ route('lista', $lista->id) }}">{{ $lista->nombre }}</a></td>
        <td>{{ $lista->created_at->format('d/m/Y') }}</td>
        <td>{{ $lista->updated_at->format('d/m/Y') }}</td>
        <td>{{ count($lista->contactos) }}</td>
        <td>
            <a class="descargarlista" href="#">
                <img src="{{ asset('internas/imagenes/descargarlista.png') }}" alt="descargar lista" width="25" height="25">
            </a>
            <a class="editarcampam" href="#" popup="{{ url('popup/editar_lista' . '/' . $lista->id) }}">
                <img src="{{ asset('internas/imagenes/editarcamania.png') }}" alt="cambiar nombre" width="25" height="25">
            </a>
            <a class="borrarcam" href="#" popup="{{ url('popup/eliminar_lista' . '/' . $lista->id) }}">
                <img src="{{ asset('internas/imagenes/borrarcamania.png') }}" alt="borrar lista" width="25" height="25">
            </a>
            <div class="cleaner"></div>
        </td>
    </tr>
@endforeach
