<?php

Route::get('resetdb', function() {
	Artisan::call('dump-autoload');
	Artisan::call('migrate:refresh');
	Artisan::call('db:seed');
});

Route::get('ver/{primero}/{segundo?}', function($primero, $segundo = null) {
	if($segundo) {
		return View::make("$primero/$segundo");
	} else {
		return View::make($primero);
	}
});

Route::get('aux', function() {
	// Session::flush();
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

Route::get('campaña/{id}', array(
	'as' => 'campania',
	function($id) {
		$campania = Campania::find($id);

		switch($campania->tipo) {
			case 'clasica':
				return View::make('internas/ver_campaniaclasica_paso5', array(
					'campania' => $campania
				));
				break;

			case 'social':
				return View::make('internas/ver_campaniasocial_paso5', array(
					'campania' => $campania
				));
				break;
		}
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

	Route::get('campaña-nueva', array(
		'as' => 'nueva_campania',
		function() {
			Session::forget('campania');
			return View::make('internas/campaniasnueva');
		}
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
				case 'enviadas':
					return View::make('internas/campaniaenviadas_paso4');
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
			return View::make('internas/listascontactos');
		}
	));

	Route::get('suscriptores/{id_lista}', function($id_lista) {
		$contactos = Contacto::where('id_lista', '=', $id_lista)->paginate(10);
		$lista = Lista::where('id', '=', $id_lista)->first();

		return View::make('internas/listascontactos2', array(
			'lista' => $lista,
			'contactos' => $contactos
		));
	});

	Route::get('librerías', array(
		'as' => 'librerias',
		function() {
			return View::make('internas/libreria');
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

	Route::post('guardar_info_basica', 'CampaniaController@guardar_info_basica');
	Route::post('guardar_contenido', 'CampaniaController@guardar_contenido');
	Route::post('guardar_campania', 'CampaniaController@guardar_campania');

	Route::any('confirmar_campania', 'CampaniaController@confirmar_campania');
	Route::any('guardar_borrador', 'CampaniaController@guardar_borrador');

	Route::post('editar_perfil', 'UsuarioController@editar_perfil');

	Route::get('popup/{popup}', function($popup) {
		return Response::json(array(
			'popup' => View::make("internas/popup_$popup")->render()
		));
	});

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

	Route::get('popup_editar_lista/{id_lista}', function($id_lista) {
		$lista = Lista::where('id', '=', $id_lista)->first();

		return Response::json(array(
			'popup' => View::make('internas/popup_editarlista', array(
				'lista' => $lista
			))->render()
		));
	});

	Route::get('popup_eliminar_lista/{id_lista}', function($id_lista) {
		$lista = Lista::where('id', '=', $id_lista)->first();

		return Response::json(array(
			'popup' => View::make('internas/popup_eliminar_listasuscriptor', array(
				'lista' => $lista
			))->render()
		));
	});

	Route::get('popup_crear_contacto/{id_lista}', function($id_lista) {
		$lista = Lista::where('id', '=', $id_lista)->first();

		return Response::json(array(
			'popup' => View::make('internas/popup_crearsuscriptor', array(
				'lista' => $lista
			))->render()
		));
	});

	Route::get('popup_editar_contacto/{id_contacto}', function($id_contacto) {
		$contacto = Contacto::where('id', '=', $id_contacto)->first();

		return Response::json(array(
			'popup' => View::make('internas/popup_editarsuscriptor', array(
				'contacto' => $contacto
			))->render()
		));
	});

	Route::get('popup_eliminar_contacto/{id_contacto}', function($id_contacto) {
		$contacto = Contacto::where('id', '=', $id_contacto)->first();

		return Response::json(array(
			'popup' => View::make('internas/popup_eliminarsuscriptor_individual', array(
				'contacto' => $contacto
			))->render()
		));
	});

	Route::get('popup_libreria_mipc', function() {
		return Response::json(array(
			'popup' => View::make('internas/popup_libreria_mipc')->render()
		));
	});

	Route::get('popup_libreria_redes', function() {
		return Response::json(array(
			'popup' => View::make('internas/popup_libreria_redes')->render()
		));
	});

});

Route::group(array(
	'prefix' => 'admin'
), function() {

	// Route::get('/', function() {

	// });

	Route::get('campañas', array(
		'as' => 'admin/campanias',
		function() {
			return View::make('admin/campanias');
		}
	));

});