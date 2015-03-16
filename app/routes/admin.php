<?php

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

        Route::get('librería', array(
            'as' => 'admin/libreria',
            function() {
                $carpeta_imagenes = Carpeta::find(1);

                return View::make('admin/libreria', array(
                    'carpeta_imagenes' => $carpeta_imagenes
                ));
            }
        ));

        Route::get('categorias', array(
            'as' => 'admin/categorias',
            function() {
                $categorias = Categoria::all();

                return View::make('admin/categorias', array(
                    'categorias' => $categorias
                ));
            }
        ));

        Route::get('categoria/{id?}', array(
            'as' => 'admin/categoria',
            function($id = null) {
                if($id) {
                    $categoria = Categoria::find($id);
                }

                return View::make('admin/categoria', array(
                    'categoria' => isset($categoria) ? $categoria : null
                ));
            }
        ));

        Route::post('categoria', array(
            'uses' => 'CategoriaController@guardar'
        ));

        Route::get('imagen/{id?}', array(
            'as' => 'admin/imagen',
            function($id = null) {
                if($id) {
                    $imagen = Imagen::find($id);
                }

                $categorias = Categoria::all();

                return View::make('admin/imagen', array(
                    'imagen'     => isset($imagen) ? $imagen : null,
                    'categorias' => $categorias
                ));
            }
        ));

        Route::post('imagen', array(
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


        Route::get('usuarios/{user_id}/orders', array(
            function($user_id) {
                $user = Usuario::find($user_id);
                $orders = Orden::where('id_usuario',$user_id)
                                ->select(array(
                                        'ordenes.id as orderId',
                                        'planes.nombre',
                                        'ordenes.monto',
                                        'ordenes.id_plan',
                                        'ordenes.id_usuario',
                                        'ordenes.created_at'
                                    ))
                                ->join('planes', 'planes.id', '=', 'ordenes.id_plan')
                                ->get();
                $plans = Plan::all();

                $ordersUnpayed = DB::table('ordenes')
                    ->select(array(
                                'ordenes.id as orderId',
                                'planes.nombre',
                                'ordenes.monto',
                                'ordenes.id_plan',
                                'ordenes.id_usuario',
                                'ordenes.created_at'
                        ))
                    ->leftJoin('planes', 'planes.id', '=', 'ordenes.id_plan')
                    ->leftJoin('pagos', 'ordenes.id', '=', 'pagos.id_orden')
                    ->where('ordenes.id_usuario',$user_id)
                    ->whereRaw('pagos.id_orden is NULL')
                    ->get();

                return View::make('admin/user_orders', array( 'orders' => $orders, 'ordersUnpayed' => $ordersUnpayed, 'plans' => $plans, 'user' => $user));
            }
        ));

        Route::post('plan-to-user', 'AdminController@planToUser');

    });

});
