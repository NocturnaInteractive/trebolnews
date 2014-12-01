@extends('admin/master')

@section('titulo')

    Categorías de imágenes

@stop

<h4>
    <a href="{{ route('admin/home') }}">Menú principal</a>
</h4>

@section('contenido')

    <div>
        <ul>
            <li><a href="{{ route('admin/categoria') }}">Agregar categoria</a></li>
        </ul>
    </div>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Opciones</th>
        <tr>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->nombre }}</td>
            <td>{{ $categoria->descripcion }}</td>
            <td>
                <a href="{{ route('admin/categoria', $categoria->id) }}">Editar</a>
            </td>
        </tr>
        @endforeach
    </table>

@stop
