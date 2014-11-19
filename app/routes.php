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

});

Route::get('session', function(){
    var_dump(Session::all());
});

Route::get('auth', function(){
    var_dump(Auth::user());
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
Route::post('/notifications',    'CheckoutController@notifications');
Route::get('/test',    'CheckoutController@test');

Route::get('/payments',function(){
    $action = 'payments';
    if(Auth::check()) {
        return App::make('CheckoutController')->$action();
    } else {
        return Redirect::to('/');
    }
});

// back end

Route::get('logout', function() {
    Session::flush();
    Auth::logout();
    return Redirect::to('/');
});

Route::group(array(
    'before' => 'auth'
), function() {

    Route::get('templates/{id}', array(
        'uses' => 'CampaniaController@getTemplate'
    ));

    Route::post('templates/fetch/', array(
        'uses' => 'CampaniaController@fetchUrl'
    ));

    Route::get('campañas', array(
        'as' => 'campanias',
        function() {
            return View::make('campaigns/campaign_main');
        }
    ));

    Route::get('campaña/{id}', array(
        'as' => 'campania',
        'uses' => 'CampaniaController@campania'
    ));

    Route::get('mail/test', array(
        'uses' => 'MailController@test'
    ));

    Route::get('campaign/step1', array(
        'as' => 'nueva_campania',
        function() {
            Session::forget('campania');
            return View::make('campaigns/new_campaign_step1');
        }
    ));

    Route::get('eliminar_campaña/{id}', array(
        'as' => 'eliminar_campania',
        'uses' => 'CampaniaController@eliminar_campania'
    ));

    Route::get('campaign/step2', array(
        'as' => 'step2',
        function() {
            return View::make('campaigns/new_campaign_step2');
        }
    ));

    Route::get('campaña-social', array(
        'as' => 'campania_social',
        function() {
            return View::make('trebolnews/campania-social-obsolete');
        }
    ));

    Route::get('campaign/step3/{id?}', array(
        'as' => 'step3',
        function($id = null) {
            if($id) {
                $campania = Campania::find($id);
            }
            switch(Session::get('campania.tipo')) {
                case 'clasica':
                    return View::make('campaigns/new_campaign_step3', array(
                        'campania' => isset($campania) ? $campania : null
                    ));
                    break;
                case 'social':
                    return View::make('internas/informacion-basica-social-obsolete', array(
                        'campania' => isset($campania) ? $campania : null
                    ));
                    break;
            }
        }
    ));

    Route::get('campaign/step4', array(
        'as' => 'step4',
        function() {
            switch(Session::get('campania.subtipo')) {
                case 'editor':
                    return View::make('campaigns/new_campaign_step4_editor');
                    break;
                case 'gallery':
                    return View::make('campaigns/new_campaign_step4_gallery');
                    break;
                case 'url':
                    return View::make('campaigns/new_campaign_step4_url');
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

    Route::get('campaign/review', array(
        'as' => 'step5',
        function() {
            switch(Session::get('campania.tipo')) {
                case 'clasica':
                    return View::make('campaigns/new_campaign_step5');
                    break;
                case 'social':
                    return View::make('internas/campaniasocial_paso5');
                    break;
            }
        }
    ));

    Route::get('campaign/view/{campaignId}/{contactId}/{verification}', 'MailController@renderMail');

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
    Route::post('eliminar_lista_multi', 'ListaController@eliminar_multi');

    Route::post('guardar_contacto', 'ContactoController@guardar');
    Route::post('eliminar_contacto', 'ContactoController@eliminar');
    Route::post('eliminar_contacto_multi', 'ContactoController@eliminar_multi');

    Route::post('guardar_carpeta', 'CarpetaController@guardar');
    Route::post('eliminar_carpeta', 'CarpetaController@eliminar');

    Route::post('guardar_imagen', 'ImagenController@guardar');
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

        Route::get('libreria', array(
            'as' => 'admin/libreria',
            function() {
                $carpeta_imagenes = Carpeta::find(1);

                return View::make('admin/libreria', array(
                    'carpeta_imagenes' => $carpeta_imagenes
                ));
            }
        ));

        Route::get('imagen/{id?}', array(
            'as' => 'admin/imagen',
            function($id = null) {
                if($id) {
                    $imagen = Imagen::find($id);
                }

                return View::make('admin/imagen', array(
                    'imagen' => isset($imagen) ? $imagen : null
                ));
            }
        ));

        Route::post('imagen', array(
            'as'   => 'admin/guardar_imagen',
            'uses' => 'ImagenController@guardar_interna'
        ));

        Route::get('eliminar_imagen/{id}', array(
            'as'   => 'admin/eliminar_imagen',
            'uses' => 'ImagenController@eliminar_interna'
        ));

        Route::get('contactos', array(
            'as' => 'admin/contactos',
            function() {
                $comentarios = Comentario::orderBy('created_at', 'desc')->get();

                return View::make('admin/comentarios', array(
                    'comentarios' => $comentarios
                ));
            }
        ));

    });

});

// acciones con el usuario

    // login con facebook
    Route::get('facebook', 'UsuarioController@facebook_login');

    // login normal
    Route::post('login', 'UsuarioController@login');

    // link para activar la cuenta
    Route::get('confirmar/{hash}', function($hash) {
        $usuario = Usuario::where('confirmation', '=', $hash)->first();

        if($usuario) {
            $usuario->confirmed = true;
            $usuario->confirmation = null;
            $usuario->save();
        }

        return View::make('trebolnews/cuenta-activa');
    });

    // envío de mail con código para recuperar la contraseña
    Route::post('recuperar_password_enviar_mail', 'UsuarioController@pre_recuperar_password');

    // post para modificar la contraseña
    Route::post('cambiar_password', 'UsuarioController@cambiar_password');


// fin acciones con el usuario

// páginas del sitio

    // home
    Route::get('/', array(
        'as' => 'home',
        function() {
            if(Auth::check()) {
                return Redirect::route('campanias');
            } else {
                $action = 'index';
                return App::make('HomeController')->$action();
            }
        }
    ));

    // registro de cuenta nueva
    Route::get('registro', array(
        'as' => 'registro',
        function() {
            return View::make('internas/registro');
        }
    ));

    // aviso de que se envío el mail para recuperar contraseña
    Route::get('mail-enviado', array(
        'as' => 'recuperar_password_mail_enviado',
        function() {
            return View::make('trebolnews.pre_recuperar_password');
        }
    ));

    // Route::get('recupero', function(){
    //     return View::make('trebolnews.form_recuperar_password');
    // });

    // form recuperar contraseña
    Route::get('recuperar/{hash}', array(
        'as' => 'mostrar_form_recuperar_password',
        'uses' => 'UsuarioController@mostrar_form_recuperar_password'
    ));

    // confirmación contraseña modificada
    Route::get('contraseña-modificada', array(
        'as' => 'password_cambiado',
        function() {
            return View::make('trebolnews.confirmacion_password_cambiado');
        }
    ));

    // paginas que requieren estar logueado
    Route::group(array(
        'before' => 'auth'
    ), function() {

        // perfil e información del usuario
        Route::get('perfil', array(
            'as' => 'perfil',
            function() {
                $empresa = json_decode(Auth::user()->empresa);

                return View::make('trebolnews/perfil', array(
                    'empresa' => $empresa
                ));
            }
        ));

        // base listas de suscriptores
        Route::get('suscriptores', array(
            'as' => 'suscriptores',
            function() {
                $listas = Auth::user()->listas()->paginate(5);
                $listas->setBaseUrl('lista-suscriptores');

                $html = View::make('trebolnews.listas.suscriptores', array(
                    'listas' => $listas
                ))->render();

                return View::make('trebolnews.listas-suscriptores', array(
                    'listas' => $listas,
                    'html'   => $html
                ));
            }
        ));

        // tabla listas de suscriptores
        Route::get('lista-suscriptores', array(
            'as' => 'lista-suscriptores',
            function() {
                if(Session::has('search-term')) {
                    $listas = Auth::user()->listas()->where('nombre', 'like', '%' . Input::get('search-term') . '%')->paginate(5);
                } else {
                    $listas = Auth::user()->listas()->paginate(5);
                }
                $listas->setBaseUrl('lista-suscriptores');

                return Response::json(array(
                    'html'      => View::make('trebolnews.listas.suscriptores', array(
                        'listas' => $listas
                    ))->render(),
                    'paginador' => $listas->links('trebolnews.paginador-ajax')->render(),
                    'total'     => $listas->count()
                ));
            }
        ));

        Route::any('list-search', 'ListaController@search');
        Route::get('exportar/{id?}', 'ListaController@export');
        Route::post('importar', 'ListaController@import');

        // base listas de contactos
        Route::get('lista/{id_lista}', array(
            'as' => 'lista',
            function($id_lista) {
                $lista = Lista::find($id_lista);
                $contactos = $lista->contactos()->paginate(5);
                $contactos->appends(array('lista' => $id_lista));
                $contactos->setBaseUrl('../lista-contactos');

                $html = View::make('trebolnews.listas.contactos', array(
                    'contactos' => $contactos
                ))->render();

                return View::make('trebolnews.listas-contactos', array(
                    'lista'     => $lista,
                    'contactos' => $contactos,
                    'html'      => $html
                ));
            }
        ));

        // tabla listas de contactos
        Route::get('lista-contactos', array(
            'as' => 'lista-contactos',
            function() {
                $lista = Lista::find(Input::get('lista'));
                $contactos = $lista->contactos()->paginate(5);
                $contactos->appends(array('lista' => $lista->id));
                $contactos->setBaseUrl('../lista-contactos');

                return Response::json(array(
                    'html'      => View::make('trebolnews.listas.contactos', array(
                        'contactos' => $contactos
                    ))->render(),
                    'paginador' => $contactos->links('trebolnews.paginador-ajax')->render(),
                    'total'     => $contactos->count()
                ));
            }
        ));

        Route::any('contact-search', 'ContactoController@search');

        // banco de imágenes
        Route::get('librerías', array(
            'as' => 'librerias',
            function() {
                $carpeta_imagenes = Carpeta::find(1); // esta es la carpeta de imágenes de trebolnews (ver seeder)
                $carpeta_basura = Auth::user()->carpetas()->where('nombre', '=', 'basura')->first(); // los usuarios tienen una carpeta 'basura' (ver eventos)
                $carpetas = Auth::user()->carpetas()->where('nombre', '!=', 'basura')->orderBy('nombre', 'asc')->get();
                $imagenes = $carpeta_imagenes->imagenes()->paginate(5);

                return View::make('trebolnews/libreria', array(
                    'carpeta_imagenes' => $carpeta_imagenes,
                    'carpeta_basura' => $carpeta_basura,
                    'carpetas' => $carpetas,
                    'imagenes' => $imagenes
                ));
            }
        ));

        // dry
        Route::get('carpeta/{id_carpeta}', array(
            'as' => 'carpeta',
            function($id_carpeta) {
                $carpeta_seleccionada = Carpeta::find($id_carpeta);
                $carpeta_imagenes = Carpeta::find(1);
                $carpeta_basura = Auth::user()->carpetas()->where('nombre', '=', 'basura')->first();
                $carpetas = Auth::user()->carpetas()->where('nombre', '!=', 'basura')->orderBy('nombre', 'asc')->get();
                $imagenes = $carpeta_seleccionada->imagenes()->paginate(5);

                return View::make('trebolnews/libreria', array(
                    'carpeta_seleccionada' => $carpeta_seleccionada,
                    'carpeta_imagenes' => $carpeta_imagenes,
                    'carpeta_basura' => $carpeta_basura,
                    'carpetas' => $carpetas,
                    'imagenes' => $imagenes
                ));
            }
        ));

        // planes
        Route::get('planes', array(
            'as' => 'planes',
            function() {
                $res = array(
                    'plans' => Plan::all()
                );

                return View::make('trebolnews/planes', $res);
            }
        ));

        // soporte
        Route::get('soporte', array(
            'as' => 'soporte',
            function() {
                return View::make('trebolnews/soporte');
            }
        ));

    });

// fin páginas del sitio

// popups

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

    });

// fin popups
