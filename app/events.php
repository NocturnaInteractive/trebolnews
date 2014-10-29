<?php

Event::listen('auth.login', function(Usuario $usuario) {
    $usuario->last_login = new DateTime;
    $usuario->save();
});

Event::listen('nuevo_registro', function(Usuario $usuario) {
    Mail::send('emails/emailregistro', array(
        'usuario' => $usuario
    ), function($mail) use($usuario) {
        $mail->from('info@trebolnews.com', 'TrebolNEWS')
            ->to($usuario->email)
            ->subject('Bienvenido a TrebolNEWS');
    });

    Carpeta::create(array(
        'id_usuario' => $usuario->id,
        'nombre' => 'basura'
    ));

    Carpeta::create(array(
        'id_usuario' => $usuario->id,
        'nombre' => 'mis imágenes'
    ));
});
