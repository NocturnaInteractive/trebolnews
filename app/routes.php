<?php

Route::get('ver/{carpeta}/{vista}', function($carpeta, $vista) {
    if(Auth::guest()) { Auth::loginUsingId(2); }
    return View::make("$carpeta/$vista");
});

Route::get('ver/{vista}', function($vista) {
    if(Auth::guest()) { Auth::loginUsingId(2); }
    return View::make($vista);
});

Route::get('aux', function(){
    $template = Template::find(1);

    echo('<img src="' . public_path("templates/{$template->archivo}/{$template->archivo}/img/bg_info.png") . '" />');

});

Route::get('session', function() {
    var_dump(Session::all());
});

// desde acá

// front end

// home
Route::get('/', function() {
    if(Auth::check()) {
        return Redirect::route('campanias');
    } else {
        $action = 'index';
        return App::make('HomeController')->$action();
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

Route::get('/checkout/{id}',function($id){
    $action = 'index';
    if(Auth::check()) {
        return App::make('CheckoutController')->$action($id);
    } else {
        return Redirect::to('/');   
    }
});
Route::get('/checkout-success', 'CheckoutController@success');
Route::get('/notifications',    'CheckoutController@notifications');


// back end

Route::get('logout', function() {
    Session::flush();
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
            return View::make('trebolnews/campanias');
        }
    ));

    Route::get('campaña/{id}', array(
        'as' => 'campania',
        'uses' => 'CampaniaController@campania'
    ));

    Route::get('nueva-campaña', array(
        'as' => 'nueva_campania',
        function() {
            Session::forget('campania');
            return View::make('trebolnews/nueva-campania');
        }
    ));

    Route::get('eliminar_campaña/{id}', array(
        'as' => 'eliminar_campania',
        'uses' => 'CampaniaController@eliminar_campania'
    ));

    Route::get('campaña-clasica', array(
        'as' => 'campania_clasica',
        function() {
            return View::make('trebolnews/campania-clasica');
        }
    ));

    Route::get('campaña-social', array(
        'as' => 'campania_social',
        function() {
            return View::make('trebolnews/campania-social');
        }
    ));

    Route::get('información-básica/{id?}', array(
        'as' => 'paso_3',
        function($id = null) {
            if($id) {
                $campania = Campania::find($id);
            }
            switch(Session::get('campania.tipo')) {
                case 'clasica':
                    return View::make('trebolnews/informacion-basica-clasica', array(
                        'campania' => isset($campania) ? $campania : null
                    ));
                    break;
                case 'social':
                    return View::make('internas/informacion-basica-social', array(
                        'campania' => isset($campania) ? $campania : null
                    ));
                    break;
            }
        }
    ));

    Route::get('contenido', array(
        'as' => 'paso_4',
        function() {
            switch(Session::get('campania.subtipo')) {
                case 'blanco':
                    return View::make('internas/campaniaenblanco_paso4');
                    break;
                case 'template':
                    $templates = Template::paginate(12);

                    $templates->each(function($template){

                    });

                    return View::make('trebolnews/subtipo-template', array(
                        'templates' => $templates
                    ));
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

    Route::get('visualizar/{id}', array(
        'as' => 'preview',
        function($id) {
            $template = Template::find(1);

            return View::make('trebolnews.preview');
        }
    ));

    Route::get('revisión', array(
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

            return View::make('trebolnews/listas-suscriptores', array(
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

        Route::get('recuperar_password', function(){
            return Response::json(array(
                'popup' => View::make('trebolnews/popups/recuperar_password')->render()
            ));
        });

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
        'as' => 'admin/login',
        function() {
            return View::make('admin/login');
        }
    ));

    Route::post('login', 'AdminController@login');

    Route::group(array(
        'before' => 'admin'
    ), function() {

        Route::get('home', array(
            'as' => 'admin/home',
            function() {
                return View::make('admin/home');
            }
        ));

        Route::get('usuarios', array(
            'as' => 'admin/usuarios',
            function() {
                $usuarios = Usuario::all();

                return View::make('admin/usuarios', array(
                    'usuarios' => $usuarios
                ));
            }
        ));

        Route::get('campañas', array(
            'as' => 'admin/campanias',
            function() {
                $campanias = Campania::withTrashed()->get();

                return View::make('admin/campanias', array(
                    'campanias' => $campanias
                ));
            }
        ));

        Route::get('reestablecer_campania/{id}', 'CampaniaController@reestablecer');

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

});