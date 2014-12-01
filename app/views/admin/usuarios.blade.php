@extends('admin/master')

@section('titulo')
    Usuarios
@stop

<h4>
    <a href="{{ route('admin/home') }}">Menú principal</a>
</h4>

@section('contenido')
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Empresa</th>
            <th>Ciudad</th>
            <th>País</th>
            <th>FB</th>
            <th>Confirmación</th>
            <th>Confirmada</th>
            <th>Newsletter</th>
            <th>Último login</th>
            <th>Creado</th>
            <th>Editado</th>
            <th>Eliminado</th>
        </tr>
        @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->nombre }}</td>
            <td>{{ $usuario->apellido }}</td>
            <td>{{ $usuario->telefono }}</td>
            <td>{{ $usuario->empresa }}</td>
            <td>{{ $usuario->ciudad }}</td>
            <td>{{ $usuario->pais }}</td>
            <td>{{ $usuario->fb_id }}</td>
            <td>{{ $usuario->confirmation }}</td>
            <td>{{ $usuario->confirmed ? 'Si' : 'No' }}</td>
            <td>{{ $usuario->newsletter ? 'Si' : 'No' }}</td>
            <td>{{ $usuario->last_login }}</td>
            <td>{{ $usuario->created_at }}</td>
            <td>{{ $usuario->updated_at }}</td>
            <td>{{ $usuario->deleted_at }}</td>
        </tr>
        @endforeach
    </table>
@stop
