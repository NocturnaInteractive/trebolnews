<?php

Event::listen('auth.login', function($user) {
    $user->last_login = new DateTime;
    $user->save();
});

Event::listen('nuevo_registro', function($usuario) {
    $data = (object) array(
        'usuario' => $usuario
    );

    try {
        Mail::queue('emails/emailregistro', array(
            'usuario' => $usuario
        ), function($mail) use($data) {
            $mail->from('info@trebolnews.com')
                 ->to($data->usuario->email)
                 ->subject('Bienvenido a TrebolNEWS');
        });
    } catch (Exception $data) {
        return Response::json(array(
            'status' => 'error',
            'mensaje' => $data
        ));
    }


    Carpeta::create(array(
        'id_usuario' => $usuario->id,
        'nombre' => 'basura'
    ));
});