@extends('admin/master')

@section('titulo')
    Librería
@stop

@section('contenido')
    <div>
        <ul>
            <li><a href="{{ route('admin/imagen') }}">Agregar imagen</a></li>
        </ul>
    </div>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Opciones</th>
        <tr>
        @foreach($carpeta_imagenes->imagenes as $imagen)
        <tr>
            <td>{{ $imagen->nombre }}</td>
            <td><img src="{{ asset('img/libreria/' . $imagen->archivo) }}" /></td>
            <td>
                <a href="{{ route('admin/imagen', $imagen->id) }}">Editar</a>
                <a href="{{ route('admin/eliminar_imagen', $imagen->id) }}">Eliminar</a>
            </td>
        </tr>
        @endforeach
    </table>
@stop
