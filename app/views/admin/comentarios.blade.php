@extends('admin/master')

@section('titulo')
    Contactos
@stop

@section('contenido')
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Empresa</th>
            <th>E-mail</th>
            <th>Comentario</th>
        </tr>
        @foreach($comentarios as $comentario)
        <tr>
            <td>{{ $comentario->nombre }}</td>
            <td>{{ $comentario->apellido }}</td>
            <td>{{ $comentario->telefono }}</td>
            <td>{{ $comentario->empresa }}</td>
            <td>{{ $comentario->email }}</td>
            <td>{{ $comentario->comentario }}</td>
        </tr>
        @endforeach
    </table>
@stop
