@extends('admin/master')

@section('titulo')

    Administración TREBOLnews

@stop

@section('contenido')

    <ul>
        <li><a href="{{ route('admin/usuarios') }}">Usuarios</a></li>
        <li><a href="{{ route('admin/campanias') }}">Campañas</a></li>
        <li><a href="{{ route('admin/templates') }}">Templates</a></li>
        <li><a href="{{ route('admin/libreria') }}">Librería</a></li>
        <li><a href="{{ route('admin/contactos') }}">Contactos</a></li>
    </ul>

@stop
