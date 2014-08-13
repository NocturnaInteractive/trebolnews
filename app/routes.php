<?php

Route::get('resetdb', function() {
    Artisan::call('dump-autoload');
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed');
});

Route::get('ver/{carpeta}/{vista}', function($carpeta, $vista) {
    if(Auth::guest()) { Auth::loginUsingId(2); }
    return View::make("$carpeta/$vista");
});

Route::get('ver/{vista}', function($vista) {
    if(Auth::guest()) { Auth::loginUsingId(2); }
    return View::make($vista);
});

Route::get('aux', function(){
    $usuario = Usuario::find(1);

    Mail::send('emails/emailregistro', array(
        'usuario' => $usuario
    ), function($mail) {
        $mail->from('info@trebolnews.com')
            ->to('maimar@gmail.com')
            ->subject('Bienvenido a TrebolNEWS');
    });
});

Route::get('session', function() {
    var_dump(Session::all());
});

// desde acá

// front end

Route::get('/', function() {
    if(Auth::check()) {
        return Redirect::route('campanias');
    } else {
        return View::make('home/index');
    }
});

Route::get('registro', array(
    'as' => 'registro',
    function() {
        return View::make('internas/registro');
    }
));

Route::get('gracias', array(
    'as' => 'post_registro',
    function() {
        return View::make('home/post_registro');
    }
));

// back end

Route::get('logout', function() {
    Auth::logout();
    return Redirect::to('/');
});

Route::get('confirmar/{hash}', function($hash) {
    $usuario = Usuario::where('confirmation', '=', $hash)->first();

    if($usuario) {
        $usuario->confirmed = true;
        $usuario->confirmation = null;
        $usuario->save();
    }

    return Redirect::to('/');
});

Route::group(array(
    'before' => 'auth'
), function() {

    Route::get('perfil', array(
        'as' => 'perfil',
        function() {
            return View::make('internas/perfil');
        }
    ));

    Route::get('editar-perfil', array(
        'as' => 'editar_perfil',
        function() {
            return View::make('internas/editarperfil');
        }
    ));

    Route::get('campañas', array(
        'as' => 'campanias',
        function() {
            return View::make('internas/campanias');
        }
    ));

    Route::get('campaña/{id}', array(
        'as' => 'campania',
        'uses' => 'CampaniaController@campania'
    ));

    Route::get('campaña-nueva', array(
        'as' => 'nueva_campania',
        function() {
            Session::forget('campania');
            return View::make('internas/campaniasnueva');
        }
    ));

    Route::get('eliminar_campaña/{id}', array(
        'as' => 'eliminar_campania',
        'uses' => 'CampaniaController@eliminar_campania'
    ));

    Route::get('paso-2', array(
        'as' => 'paso_2',
        function() {
            switch(Session::get('campania.tipo')) {
                case 'clasica':
                    return View::make('internas/campaniaclasica');
                    break;
                case 'social':
                    return View::make('internas/campaniasocial');
                    break;
            }
        }
    ));

    Route::get('paso-3', array(
        'as' => 'paso_3',
        function() {
            switch(Session::get('campania.tipo')) {
                case 'clasica':
                    return View::make('internas/campaniaclasica_paso3');
                    break;
                case 'social':
                    return View::make('internas/campaniasocial_paso3');
                    break;
            }
        }
    ));

    Route::get('paso-4', array(
        'as' => 'paso_4',
        function() {
            switch(Session::get('campania.subtipo')) {
                case 'blanco':
                    return View::make('internas/campaniaenblanco_paso4');
                    break;
                case 'template':
                    return View::make('internas/campaniatemplate_paso4');
                    break;
                case 'url':
                    return View::make('internas/campaniaurl_paso4');
                    break;
                case 'html':
                    return View::make('internas/campaniaenblanco_paso4');
                    break;
            }
        }
    ));

    Route::get('paso-5', array(
        'as' => 'paso_5',
        function() {
            switch(Session::get('campania.tipo')) {
                case 'clasica':
                    return View::make('internas/campaniaclasica_paso5');
                    break;
                case 'social':
                    return View::make('internas/campaniasocial_paso5');
                    break;
            }
        }
    ));

    Route::get('suscriptores', array(
        'as' => 'suscriptores',
        function() {
            $listas = Auth::user()->listas()->paginate(5);

            return View::make('internas/listascontactos', array(
                'listas' => $listas
            ));
        }
    ));

    Route::get('lista/{id_lista}', array(
        'as' => 'lista',
        function($id_lista) {
            $lista = Lista::find($id_lista);
            $contactos = $lista->contactos()->paginate(5);

            return View::make('internas/listascontactos2', array(
                'lista' => $lista,
                'contactos' => $contactos
            ));
        }
    ));

    Route::get('librerías', array(
        'as' => 'librerias',
        function() {
            $carpeta_imagenes = Carpeta::find(1);
            $carpeta_basura = Auth::user()->carpetas()->where('nombre', '=', 'basura')->first();
            $carpetas = Auth::user()->carpetas()->where('nombre', '!=', 'basura')->orderBy('nombre', 'asc')->get();
            $imagenes = $carpeta_imagenes->imagenes()->paginate(5);

            return View::make('internas/libreria', array(
                'carpeta_imagenes' => $carpeta_imagenes,
                'carpeta_basura' => $carpeta_basura,
                'carpetas' => $carpetas,
                'imagenes' => $imagenes
            ));
        }
    ));

    Route::get('carpeta/{id_carpeta}', array(
        'as' => 'carpeta',
        function($id_carpeta) {
            $carpeta_seleccionada = Carpeta::find($id_carpeta);
            $carpeta_imagenes = Carpeta::find(1);
            $carpeta_basura = Auth::user()->carpetas()->where('nombre', '=', 'basura')->first();
            $carpetas = Auth::user()->carpetas()->where('nombre', '!=', 'basura')->orderBy('nombre', 'asc')->get();
            $imagenes = $carpeta_seleccionada->imagenes()->paginate(5);

            return View::make('internas/libreria', array(
                'carpeta_seleccionada' => $carpeta_seleccionada,
                'carpeta_imagenes' => $carpeta_imagenes,
                'carpeta_basura' => $carpeta_basura,
                'carpetas' => $carpetas,
                'imagenes' => $imagenes
            ));
        }
    ));

    Route::get('planes', array(
        'as' => 'planes',
        function() {
            return View::make('internas/planes');
        }
    ));

    Route::get('soporte', array(
        'as' => 'soporte',
        function() {
            return View::make('internas/soporte');
        }
    ));

    Route::get('banco', array(
        'as' => 'banco',
        function() {
            return View::make('internas/banco');
        }
    ));
});

Route::get('términos-y-condiciones', array(
    'as' => 'tyc',
    function() {
        return View::make('internas/terminosycondiciones');
    }
));

Route::group(array(
    'before' => 'ajax'
), function() {

    Route::post('registrar', 'UsuarioController@registrar');

    Route::post('login', 'UsuarioController@login');
    Route::post('login_con_fb', 'UsuarioController@login_con_fb');

    Route::post('guardar_lista', 'ListaController@guardar');
    Route::post('eliminar_lista', 'ListaController@eliminar');

    Route::post('guardar_contacto', 'ContactoController@guardar');
    Route::post('eliminar_contacto', 'ContactoController@eliminar');

    Route::post('guardar_carpeta', 'CarpetaController@guardar');
    Route::post('eliminar_carpeta', 'CarpetaController@eliminar');

    Route::post('guardar_imagen', 'ImagenController@guardar');
    // Route::post('eliminar_carpeta', 'CarpetaController@eliminar');

    Route::post('guardar_campania', 'CampaniaController@guardar_campania');

    Route::post('editar_perfil', 'UsuarioController@editar_perfil');

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


    Route::group(array(
        'prefix' => 'popup'
    ), function() {

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

        Route::get('libreria_mipc', function() {
            return Response::json(array(
                'popup' => View::make('internas/popup_libreria_mipc')->render()
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

        Route::get('{popup}', function($popup) {
            return Response::json(array(
                'popup' => View::make("internas/popup_$popup")->render()
            ));
        });

    });

});

Route::group(array(
    'prefix' => 'admin'
), function() {

    Route::get('/', array(
        'as' => 'admin/home',
        function() {
            return 'Panel de administración';
        }
    ));

    Route::get('usuarios', array(
        'as' => 'admin/usuarios',
        function() {
            return View::make('admin/usuarios');
        }
    ));

    Route::get('campañas', array(
        'as' => 'admin/campanias',
        function() {
            return View::make('admin/campanias');
        }
    ));

    Route::get('templates', array(
        'as' => 'admin/templates',
        function() {
            $templates = Template::all();

            return View::make('admin/templates', array(
                'templates' => $templates
            ));
        }
    ));

    Route::get('agregar-template', array(
        'as' => 'admin/agregar_template',
        function() {
            return View::make('admin/agregar_template');
        }
    ));

    Route::post('guardar_template', 'TemplateController@guardar');

    Route::get('subir-imagenes/{id}', array(
        'as' => 'admin/subir_imagenes',
        'uses' => 'TemplateController@form_subir_imagenes'
    ));

    Route::post('subir_imagenes', 'TemplateController@subir_imagenes');

});