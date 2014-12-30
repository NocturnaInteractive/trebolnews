<?php

require app_path().'/routes/admin.php';
require app_path().'/routes/popups.php';
require app_path().'/routes/ajax.php';

Route::get('aux', function(){
    // some testing
});

Route::get('session', function(){
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

    Route::get('campaigns/{id}/report', 'ReportController@show');
    Route::get('campaigns/{id}/report/pixel.gif', 'ReportController@pixel');

    Route::get('campaign/view/{campaignId}/{contactId}/{verification}', 'MailController@renderMail');

});

Route::get('términos-y-condiciones', array(
    'as' => 'tyc',
    function() {
        return View::make('internas/terminosycondiciones');
    }
));

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

    // setear una preferencia
    Route::post('set_preference', 'UsuarioController@set_preference');


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
        Route::get('profile', array('as' => 'perfil', 'uses' => 'ProfileController@index'));

        // base listas de suscriptores
        Route::get('suscriptores', array(
            'as' => 'suscriptores',
            function() {
                $cant = empty(Auth::user()->preferences()->cant_listas) ? 10 : Auth::user()->preferences()->cant_listas;

                Session::forget('search-term');
                $listas = Auth::user()->listas()->paginate($cant);
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
                $cant = empty(Auth::user()->preferences()->cant_listas) ? 10 : Auth::user()->preferences()->cant_listas;

                if(Session::has('search-term')) {
                    $listas = Auth::user()->listas()->where('nombre', 'like', '%' . Session::get('search-term') . '%')->paginate(5);
                } else {
                    $listas = Auth::user()->listas()->paginate($cant);
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
        Route::post('importar1', 'ListaController@import');
        Route::post('importar2', 'ListaController@do_import');

        // base listas de contactos
        Route::get('lista/{id_lista}', array(
            'as' => 'lista',
            function($id_lista) {
                $cant = empty(Auth::user()->preferences()->cant_suscriptores) ? 10 : Auth::user()->preferences()->cant_suscriptores;

                Session::forget('search-term');
                $lista = Lista::find($id_lista);
                $contactos = $lista->contactos()->paginate($cant);
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
                $cant = empty(Auth::user()->preferences()->cant_suscriptores) ? 10 : Auth::user()->preferences()->cant_suscriptores;

                $lista = Lista::find(Input::get('lista'));

                if(Session::has('search-term')) {
                    $contactos = $lista->contactos()
                        ->where(function($q) {
                            $q->orWhere('nombre', 'like', '%' . Input::get('search-term', Session::get('search-term')) . '%')
                              ->orWhere('apellido', 'like', '%' . Input::get('search-term', Session::get('search-term')) . '%')
                              ->orWhere('email', 'like', '%' . Input::get('search-term', Session::get('search-term')) . '%');
                        })
                        ->paginate($cant);
                } else {
                    $contactos = $lista->contactos()->paginate($cant);
                }

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

        // base librería
        Route::get('librerías', array(
            'as' => 'librerias',
            function() {
                $cant = empty(Auth::user()->preferences()->cant_libreria) ? 8 : Auth::user()->preferences()->cant_libreria;

                $type = empty(Auth::user()->preferences()->libreria_view) ? 'list' : Auth::user()->preferences()->libreria_view;
                $view = "libreria-$type";

                $carpeta_basura       = Auth::user()->carpeta_basura();
                $carpeta_mis_imagenes = Auth::user()->carpeta_mis_imagenes();
                $carpetas             = Auth::user()->carpetas()->where('nombre', '!=', 'basura')->where('nombre', '!=', 'mis_imagenes')->get();
                $imagenes             = Auth::user()->imagenes()->where('id_carpeta', '!=', $carpeta_basura->id)->orderBy('imagenes.created_at', 'desc')->paginate($cant, array('*', 'imagenes.id', 'imagenes.nombre'));
                $total                = count(Auth::user()->imagenes()->where('id_carpeta', '!=', $carpeta_basura->id)->get());

                $imagenes->setBaseUrl('lista-libreria');

                $html = View::make("trebolnews.listas.$view", array(
                    'imagenes' => $imagenes
                ));

                return View::make('trebolnews/libreria', array(
                    'carpeta_basura'       => $carpeta_basura,
                    'carpeta_mis_imagenes' => $carpeta_mis_imagenes,
                    'carpetas'             => $carpetas,
                    'imagenes'             => $imagenes,
                    'total'                => $total,
                    'type'                 => $type,
                    'html'                 => $html
                ));
            }
        ));

        // tabla librería
        Route::get('lista-libreria', array(
            'as' => 'lista-libreria',
            function() {
                $cant = empty(Auth::user()->preferences()->cant_libreria) ? 8 : Auth::user()->preferences()->cant_libreria;

                $type = empty(Auth::user()->preferences()->libreria_view) ? 'list' : Auth::user()->preferences()->libreria_view;
                $view = "libreria-$type";

                $imagenes = Auth::user()->imagenes()->orderBy('imagenes.created_at', 'desc')->paginate($cant, array('*', 'imagenes.nombre'));
                $imagenes->setBaseUrl('lista-libreria');

                return Response::json(array(
                    'html' => View::make("trebolnews.listas.$view", array(
                        'imagenes' => $imagenes
                    ))->render(),
                    'paginador' => $imagenes->links('trebolnews.paginador-ajax')->render(),
                    'total'     => $imagenes->count()
                ));
            }
        ));

        // dry
        Route::get('carpeta/{id_carpeta}', array(
            'as' => 'carpeta',
            function($id_carpeta) {
                $cant = empty(Auth::user()->preferences()->cant_libreria) ? 8 : Auth::user()->preferences()->cant_libreria;

                $type = empty(Auth::user()->preferences()->libreria_view) ? 'grid' : Auth::user()->preferences()->libreria_view;
                $view = "libreria-$type";

                $carpeta_seleccionada = Carpeta::find($id_carpeta);
                $carpeta_basura       = Auth::user()->carpeta_basura();
                $carpeta_mis_imagenes = Auth::user()->carpeta_mis_imagenes();
                $carpetas             = Auth::user()->carpetas()->where('nombre', '!=', 'basura')->where('nombre', '!=', 'mis_imagenes')->get();
                $imagenes             = $carpeta_seleccionada->imagenes()->orderBy('created_at', 'desc')->paginate($cant);
                $total                = count(Auth::user()->imagenes()->where('id_carpeta', '!=', $carpeta_basura->id)->get());

                $imagenes->appends(array('carpeta' => $id_carpeta));
                $imagenes->setBaseUrl('../lista-carpeta');

                $html = View::make("trebolnews.listas.$view", array(
                    'imagenes' => $imagenes
                ));

                return View::make('trebolnews/libreria', array(
                    'carpeta_seleccionada' => $carpeta_seleccionada,
                    'carpeta_basura'       => $carpeta_basura,
                    'carpeta_mis_imagenes' => $carpeta_mis_imagenes,
                    'carpetas'             => $carpetas,
                    'imagenes'             => $imagenes,
                    'total'                => $total,
                    'type'                 => $type,
                    'html'                 => $html
                ));
            }
        ));

        Route::get('lista-carpeta', array(
            'as' => 'lista-carpeta',
            function() {
                $cant = empty(Auth::user()->preferences()->cant_libreria) ? 8 : Auth::user()->preferences()->cant_libreria;

                $type = empty(Auth::user()->preferences()->libreria_view) ? 'grid' : Auth::user()->preferences()->libreria_view;
                $view = "libreria-$type";

                $carpeta_seleccionada = Carpeta::find(Input::get('carpeta'));

                $imagenes = $carpeta_seleccionada->imagenes()->orderBy('created_at', 'desc')->paginate($cant);

                $imagenes->appends(array('carpeta' => $carpeta_seleccionada->id));
                $imagenes->setBaseUrl('../lista-carpeta');

                return Response::json(array(
                    'html' => View::make("trebolnews.listas.$view", array(
                        'imagenes' => $imagenes
                    ))->render(),
                    'paginador' => $imagenes->links('trebolnews.paginador-ajax')->render(),
                    'total'     => $imagenes->count()
                ));

            }
        ));

        // base banco de imágenes
        Route::get('banco', array(
            'as' => 'banco',
            function() {
                Session::forget('search-term');

                $cant = empty(Auth::user()->preferences()->cant_banco) ? 10 : Auth::user()->preferences()->cant_banco;

                $type = empty(Auth::user()->preferences()->banco_view) ? 'grid' : Auth::user()->preferences()->banco_view;
                $view = "banco-$type";

                $categorias = Categoria::all();

                $imagenes = Carpeta::find(1)->imagenes()->paginate($cant);
                $imagenes->setBaseUrl('lista-banco');

                $html = View::make("trebolnews.listas.$view", array(
                    'imagenes' => $imagenes
                ));

                return View::make('trebolnews.banco', array(
                    'categorias' => $categorias,
                    'type'       => $type,
                    'html'       => $html,
                    'imagenes'   => $imagenes,
                    'paginador'  => $imagenes->links('trebolnews.paginador-ajax')->render()
                ));
            }
        ));

        // lista banco de imágenes
        Route::get('lista-banco', array(
            'as' => 'lista-banco',
            function() {
                $cant = empty(Auth::user()->preferences()->cant_banco) ? 10 : Auth::user()->preferences()->cant_banco;

                $type = empty(Auth::user()->preferences()->banco_view) ? 'grid' : Auth::user()->preferences()->banco_view;
                $view = "banco-$type";

                if(Session::has('search-term')) {
                    $imagenes = Carpeta::find(1)->imagenes()->where('nombre', 'like', '%' . Input::get('search-term', Session::get('search-term')) . '%')->paginate($cant);
                } else {
                    $imagenes = Carpeta::find(1)->imagenes()->paginate($cant);
                }

                $html = View::make("trebolnews.listas.$view", array(
                    'imagenes' => $imagenes
                ))->render();

                return Response::json(array(
                    'html' => $html,
                    'paginador' => $imagenes->links('trebolnews.paginador-ajax')->render()
                ));
            }
        ));

        Route::post('subir-a-libreria', array(
            'as'   => 'subir-a-libreria',
            'uses' => 'ImagenController@subir_a_libreria'
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