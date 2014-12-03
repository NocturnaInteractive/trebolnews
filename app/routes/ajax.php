<?php

Route::group(array(
    'before' => 'ajax'
), function() {

    Route::post('registrar', 'UsuarioController@registrar');

    Route::post('login', 'UsuarioController@login');
    Route::post('login_con_fb', 'UsuarioController@login_con_fb');

    Route::post('guardar_lista', 'ListaController@guardar');
    Route::post('eliminar_lista', 'ListaController@eliminar');
    Route::post('eliminar_lista_multi', 'ListaController@eliminar_multi');

    Route::post('guardar_contacto', 'ContactoController@guardar');
    Route::post('eliminar_contacto', 'ContactoController@eliminar');
    Route::post('eliminar_contacto_multi', 'ContactoController@eliminar_multi');

    Route::post('guardar_carpeta', 'CarpetaController@guardar');
    Route::post('eliminar_carpeta', 'CarpetaController@eliminar');

    Route::post('guardar_imagen', 'ImagenController@guardar');
    Route::post('mover_imagen', 'ImagenController@mover');
    Route::any('trash_image', 'ImagenController@trash');
    Route::post('search_bank', 'ImagenController@search_bank');
    // Route::post('eliminar_carpeta', 'CarpetaController@eliminar');

    Route::post('guardar_campania', 'CampaniaController@guardar_campania');

    Route::post('editar_perfil', 'UsuarioController@editar_perfil');

    Route::post('guardar_comentario', 'ExtraController@guardar_comentario');
    Route::post('guardar_suscripcion', 'ExtraController@guardar_suscripcion');

    Route::post('session', function() {
        if(Input::get('session_data') == 'flush') {
            Session::forget('campania');
        } else {
            $todos = explode(';', Input::get('session_data'));
            foreach($todos as $uno) {
                $final = explode(':', $uno);
                Session::put($final[0], $final[1]);
            }
        }

        return Response::json(array(
            'status' => 'ok',
            'session_data' => Session::all()
        ));
    });

});
