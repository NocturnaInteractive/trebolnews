<?php

Event::listen('auth.login', function($user) {
    $user->last_login = new DateTime;
    $user->save();
});

Event::listen('nuevo_registro', function($usuario) {
    Carpeta::create(array(
        'id_usuario' => $usuario->id,
        'nombre' => 'basura'
    ));
});