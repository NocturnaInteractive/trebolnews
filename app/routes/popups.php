<?php

Route::group(array(
    'prefix' => 'popup'
), function() {

    // curados

    Route::get('recuperar_password', function() {
        return Response::json(array(
            'popup' => View::make('trebolnews/popups/recuperar_password')->render()
        ));
    });

    Route::get('crear_lista', function() {
        return Response::json(array(
            'popup' => View::make('trebolnews/popups/crear_lista')->render()
        ));
    });

    Route::get('importar_lista', function() {
        return Response::json(array(
            'popup' => View::make('trebolnews/popups/importar_lista')->render()
        ));
    });

    Route::get('eliminar_lista_multi', function() {
        return Response::json(array(
            'popup' => View::make('trebolnews/popups/eliminar_lista_multi')->render()
        ));
    });

    Route::get('eliminar_suscriptor_multi', function() {
        return Response::json(array(
            'popup' => View::make('trebolnews/popups/eliminar_suscriptor_multi')->render()
        ));
    });

    Route::get('libreria_mipc', function() {
        return Response::json(array(
            'popup' => View::make('trebolnews/popups/libreria_mipc')->render()
        ));
    });

    Route::get('editar_imagen/{id_imagen}', function($id_imagen) {
        $imagen = Imagen::find($id_imagen);

        return Response::json(array(
            'popup' => View::make('trebolnews/popups/editar_imagen', array(
                'imagen' => $imagen
            ))->render()
        ));
    });

    Route::get('mover_imagen/{id_carpeta}', function($id_carpeta) {
        $carpetas = Auth::user()->carpetas()->where('nombre', '!=', 'basura')->where('id', '!=', $id_carpeta)->get();

        return Response::json(array(
            'popup' => View::make('trebolnews/popups/mover_imagen', array(
                'carpetas' => $carpetas
            ))->render()
        ));
    });

    // llamado para usar cuando el popup no requiere data adicional
    Route::get('{popup}', function($popup) {
        return Response::json(array(
            'popup' => View::make("internas/popup_$popup")->render()
        ));
    });

    // fin curados

    Route::get('editar_lista/{id_lista}', function($id_lista) {
        $lista = Lista::find($id_lista);

        return Response::json(array(
            'popup' => View::make('internas/popup_editarlista', array(
                'lista' => $lista
            ))->render()
        ));
    });

    Route::get('eliminar_lista/{id_lista}', function($id_lista) {
        $lista = Lista::find($id_lista);

        return Response::json(array(
            'popup' => View::make('internas/popup_eliminar_listasuscriptor', array(
                'lista' => $lista
            ))->render()
        ));
    });

    Route::get('crear_contacto/{id_lista}', function($id_lista) {
        $lista = Lista::find($id_lista);

        return Response::json(array(
            'popup' => View::make('internas/popup_crearsuscriptor', array(
                'lista' => $lista
            ))->render()
        ));
    });

    Route::get('editar_contacto/{id_contacto}', function($id_contacto) {
        $contacto = Contacto::find($id_contacto);

        return Response::json(array(
            'popup' => View::make('internas/popup_editarsuscriptor', array(
                'contacto' => $contacto
            ))->render()
        ));
    });

    Route::get('eliminar_contacto/{id_contacto}', function($id_contacto) {
        $contacto = Contacto::find($id_contacto);

        return Response::json(array(
            'popup' => View::make('internas/popup_eliminarsuscriptor_individual', array(
                'contacto' => $contacto
            ))->render()
        ));
    });

    Route::get('libreria_redes', function() {
        return Response::json(array(
            'popup' => View::make('internas/popup_libreria_redes')->render()
        ));
    });

    Route::get('crear_carpeta_libreria', function() {
        return Response::json(array(
            'popup' => View::make('internas/popup_crear_carpeta_libreria')->render()
        ));
    });

});
