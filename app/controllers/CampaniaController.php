<?php

class CampaniaController extends BaseController {

	// public function guardar_borrador() {
	// 	$data = Input::all();

	// 	$rules = array(

	// 	);

	// 	$messages = array(

	// 	);

	// 	$validator = Validator::make($data, $rules, $messages);

	// 	if($validator->passes()) {
	// 		if(Input::has('id_campania')) {
	// 			echo('llegó la hora de hacer la edición');
	// 			// $campania = Campania::find(Input::get('id_campania'));
	// 		} else {
	// 			$listas = Session::pull('campania.listas');
	// 			$campania = Campania::create(Session::get('campania'));
	// 			foreach($listas as $lista) {
	// 				$campania->listas()->attach($lista);
	// 			}

	// 			return Response::json(array(
	// 				'status' => 'ok'
	// 			));
	// 		}
	// 	} else {
	// 		return Response::json(array(
	// 			'status' => 'error',
	// 			'validator' => $validator->messages()->toArray()
	// 		));
	// 	}
	// }

	// public function guardar_info_basica() {
	// 	$data = Input::all();

	// 	$rules = array(
	// 		'nombre' => 'required',
	// 		'asunto' => 'required',
	// 		'remitente' => 'required',
	// 		'email' => 'required|email',
	// 		'respuesta' => 'required|email',
	// 		'listas' => 'required',
	// 		'redes' => 'required_if:compartir,on',
	// 		'fecha' => 'required_if:envio,programado',
	// 		'hora' => 'required_if:envio,programado',
	// 		'minutos' => 'required_if:envio,programado',
	// 		'meridiano' => 'required_if:envio,programado'
	// 	);

	// 	$messages = array(
	// 		'nombre.required' => 'Falta completar el nombre',
	// 		'asunto.required' => 'Falta completar el asunto',
	// 		'remitente.required' => 'Falta completar el remitente',
	// 		'email.required' => 'Falta completar el email',
	// 		'email.email' => 'El email debe ser válido',
	// 		'respuesta.required' => 'Falta completar la dirección de respuesta',
	// 		'respuesta.email' => 'La dirección de respuesta debe ser un email válido',
	// 		'listas.required' => 'Es necesario elegir al menos una lista de contactos',
	// 		'redes.required_if' => 'Ha elegido compartir en redes sociales pero ninguna red',
	// 		'fecha.required_if' => 'Es obligatorio ingresar la fecha para la programación de envío',
	// 		'hora.required_if' => 'Es obligatorio ingresar la hora para la programación de envío',
	// 		'minutos.required_if' => 'Es obligatorio los minutos para la programación de envío',
	// 		'meridiano.required_if' => 'Es obligatorio ingresar el período horario para la programación de envío'
	// 	);

	// 	$validator = Validator::make($data, $rules, $messages);

	// 	if($validator->passes()) {
	// 		if(Input::has('id')) {
	// 			// $lista = Lista::find(Input::get('id'));
	// 			// $lista->nombre = Input::get('nombre');
	// 			// $lista->save();
	// 		} else {
	// 			// $campania = Campania::create(array(
	// 			// 	'id_usuario' => Auth::user()->id,
	// 			// 	'nombre' => Input::get('nombre'),
	// 			// 	'asunto' => Input::get('asunto'),
	// 			// 	'remitente' => Input::get('remitente'),
	// 			// 	'email' => Input::get('email'),
	// 			// 	'respuesta' => Input::get('respuesta'),
	// 			// ));
	// 			if(Input::has('guardar')) {
	// 				$campania = Campania::create(array(
	// 					'id_usuario' => Auth::user()->id,
	// 					'tipo' => Session::get('campania.tipo'),
	// 					'subtipo' => Session::get('campania.subtipo'),
	// 					'nombre' => Input::get('nombre'),
	// 					'asunto' => Input::get('asunto'),
	// 					'remitente' => Input::get('remitente'),
	// 					'email' => Input::get('email'),
	// 					'respuesta' => Input::get('respuesta'),
	// 					'status' => Session::get('campania.status'),
	// 					'envio' => Input::get('envio'),
	// 					'notificacion' => Input::get('notificacion') ? true : false
	// 				));

	// 				foreach(Input::get('listas') as $id_lista) {
	// 					$campania->listas()->attach($id_lista);
	// 				}
	// 			} else {
	// 				Session::put('campania.id_usuario', Auth::user()->id);
	// 				Session::put('campania.nombre', Input::get('nombre'));
	// 				Session::put('campania.asunto', Input::get('asunto'));
	// 				Session::put('campania.remitente', Input::get('remitente'));
	// 				Session::put('campania.email', Input::get('email'));
	// 				Session::put('campania.respuesta', Input::get('respuesta'));
	// 				Session::put('campania.listas', Input::get('listas'));
	// 				Session::put('campania.notificacion', Input::get('notificacion') ? true : false);
	// 				Session::put('campania.redes', Input::get('redes'));
	// 				Session::put('campania.envio', Input::get('envio'));
	// 				if(Input::get('envio') == 'programado') {
	// 					$programacion = Input::get('fecha') . ' ' . Input::get('hora') . ':' . Input::get('minutos') . ' ' . Input::get('meridiano');
	// 					Session::put('campania.programacion', Carbon::createFromFormat('d/m/Y h:i a', $programacion));
	// 				}
	// 			}
	// 		}

	// 		return Response::json(array(
	// 			'status' => 'ok'
	// 		));
	// 	} else {
	// 		return Response::json(array(
	// 			'status' => 'error',
	// 			'validator' => $validator->messages()->toArray()
	// 		));
	// 	}
	// }

	// public function guardar_contenido() {
	// 	$data = Input::all();

	// 	$rules = array(
	// 		'contenido' => 'required',
	// 	);

	// 	$messages = array(
	// 		'contenido.required' => 'Debe ingresar el contenido de la campaña',
	// 	);

	// 	$validator = Validator::make($data, $rules, $messages);

	// 	if($validator->passes()) {
	// 		if(Input::has('id')) {
	// 			// $lista = Lista::find(Input::get('id'));
	// 			// $lista->nombre = Input::get('nombre');
	// 			// $lista->save();
	// 		} else {
	// 			// $campania = Campania::create(array(
	// 			// 	'id_usuario' => Auth::user()->id,
	// 			// 	'nombre' => Input::get('nombre'),
	// 			// 	'asunto' => Input::get('asunto'),
	// 			// 	'remitente' => Input::get('remitente'),
	// 			// 	'email' => Input::get('email'),
	// 			// 	'respuesta' => Input::get('respuesta'),
	// 			// ));
	// 			Session::put('campania.contenido', Input::get('contenido'));
	// 		}

	// 		return Response::json(array(
	// 			'status' => 'ok',
	// 			'route' => route('paso_5')
	// 		));
	// 	} else {
	// 		return Response::json(array(
	// 			'status' => 'error',
	// 			'validator' => $validator->messages()->toArray()
	// 		));
	// 	}
	// }

	public function guardar_campania() {
		$data = Input::all();

		$rules = array();
		$messages = array();

		switch(Input::get('paso')) {
			case '3':
				$rules = array_merge($rules, $rules = array(
					'campania:nombre' 		=> 'required',
					'campania:asunto' 		=> 'required',
					'campania:remitente' 	=> 'required',
					'campania:email' 		=> 'required|email',
					'campania:respuesta' 	=> 'required|email',
					'campania:listas' 		=> 'required',
					'campania:redes' 		=> 'required_if:compartir,on',
					'campania:fecha' 		=> 'required_if:envio,programado'
				));

				$messages = array_merge($messages, $messages = array(
					'campania:nombre.required' 		=> 'Falta completar el nombre',
					'campania:asunto.required' 		=> 'Falta completar el asunto',
					'campania:remitente.required' 	=> 'Falta completar el remitente',
					'campania:email.required' 		=> 'Falta completar el email',
					'campania:email.email' 			=> 'El email debe ser válido',
					'campania:respuesta.required' 	=> 'Falta completar la dirección de respuesta',
					'campania:respuesta.email' 		=> 'La dirección de respuesta debe ser un email válido',
					'campania:listas.required' 		=> 'Es necesario elegir al menos una lista de contactos',
					'campania:redes.required_if' 	=> 'Ha elegido compartir en redes sociales pero ninguna red',
					'campania:fecha.required_if' 	=> 'Es obligatorio ingresar la fecha para la programación de envío'
				));

				switch(Session::get('campania.tipo')) {
					case 'clasica':
						$rules = array_merge($rules, array(

						));

						$messages = array_merge($messages, array(

						));

						break;

					case 'social':
						$rules = array_merge($rules, array(

						));

						$messages = array_merge($messages, array(

						));

						break;
				}

				break;

			case '4':
				$rules = array_merge($rules, array(

				));

				$messages = array_merge($messages, array(

				));

				switch(Session::get('campania.subtipo')) {
					case 'blanco':
						$rules = array_merge($rules, array(
							'campania:contenido' => 'required'
						));

						$messages = array_merge($messages, array(
							'campania:contenido.required' => 'Es necesario cargar un contenido'
						));

						break;

					case 'template':
						$rules = array_merge($rules, array(

						));

						$messages = array_merge($messages, array(

						));

						break;
				}

				break;
		}

		$validator = Validator::make($data, $rules, $messages);

		if($validator->passes()) {
			foreach(Input::all() as $key => $value) {
				Session::put(str_replace(':', '.', $key), $value);
			}

			switch(Input::get('y')) {
				case 'salir':
					// se guarda como borrador
					$campania = Campania::create(array(
						'id_usuario' => Auth::user()->id,
						'tipo' => Session::get('campania.tipo'),
						'subtipo' => Session::get('campania.subtipo'),
						'nombre' => Session::get('campania.nombre'),
						'asunto' => Session::get('campania.asunto'),
						'remitente' => Session::get('campania.remitente'),
						'email' => Session::get('campania.email'),
						'respuesta' => Session::get('campania.respuesta'),
						'redes' => Session::get('campania.redes') ? json_encode(Session::get('campania.redes')) : null,
						'status' => 'borrador',
						'envio' => Session::get('campania.envio'),
						'programacion' => Session::get('campania.envio') == 'programado' ? Session::get('campania.programacion') : null,
						'notificacion' => Session::get('campania.notificacion')
					));

					foreach(Session::get('campania.listas') as $id_lista) {
						$campania->listas()->attach($id_lista);
					}

					Session::forget('campania');

					return Response::json(array(
						'status' => 'ok'
					));

					break;

				case 'seguir':
					// sólo guarda en la sesión

					return Response::json(array(
						'status' => 'ok'
					));

					break;

				case 'confirmar':
					// envía los mails o asigna status 'programada'

					if(Input::has('id_campania')) {
						$campania = Campania::find(Input::get('id_campania'));
					} else {
						$campania = Campania::create(array(
							'id_usuario' => Auth::user()->id,
							'tipo' => Session::get('campania.tipo'),
							'subtipo' => Session::get('campania.subtipo'),
							'nombre' => Session::get('campania.nombre'),
							'asunto' => Session::get('campania.asunto'),
							'remitente' => Session::get('campania.remitente'),
							'email' => Session::get('campania.email'),
							'respuesta' => Session::get('campania.respuesta'),
							'redes' => Session::get('campania.redes') ? json_encode(Session::get('campania.redes')) : null,
							'envio' => Session::get('campania.envio'),
							'programacion' => Session::get('campania.envio') == 'programado' ? Session::get('campania.programacion') : null,
							'notificacion' => Session::get('campania.notificacion')
						));

						foreach(Session::get('campania.listas') as $id_lista) {
							$campania->listas()->attach($id_lista);
						}
					}

					switch($campania->envio) {
						case 'inmediato':
							// enviar los mails

							foreach($campania->listas as $lista) {
								foreach($lista->contactos as $contacto) {
									Mail::send('emails/prueba', array(), function($mail) {
										$mail->to($contacto->email, "{$contacto->nombre} {$contacto->apellido}")
											->subject($campania->asunto)
											->from($campania->email, $campania->remitente)
											->replyTo($campania->respuesta);
									});
								}
							}

							$campania->status = 'enviada';
							$campania->save();

							break;

						case 'programado':
							$campania->status = 'programada';
							$campania->save();

							break;
					}

					Session::forget('campania');

					break;

			}
		} else {
			return Response::json(array(
				'status' => 'error',
				'validator' => $validator->messages()->toArray()
			));
		}

		//desde aca
		// $campania = Campania::create(array(
		// 	'id_usuario' => Auth::user()->id,
		// 	'tipo' => Session::get('campania.tipo'),
		// 	'nombre' => Session::get('campania.nombre'),
		// 	'asunto' => Session::get('campania.asunto'),
		// 	'remitente' => Session::get('campania.remitente'),
		// 	'email' => Session::get('campania.email'),
		// 	'respuesta' => Session::get('campania.respuesta'),
		// 	'contenido' => Session::get('campania.contenido'),
		// 	'programacion' => Session::get('campania.programacion'),
		// 	'redes' => json_encode(Session::get('campania.redes')),
		// 	'status' => Session::has('campania.programacion') ? 'programada' : 'enviada'
		// ));

		// foreach(Session::get('campania.listas') as $id_lista) {
		// 	$campania->listas()->attach($id_lista);
		// }

		// return Response::json(array(
		// 	'status' => 'ok',
		// 	'route' => route('campanias')
		// ));
		//hasta aca
	}

}