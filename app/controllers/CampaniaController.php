<?php

class CampaniaController extends BaseController {

	public function guardar_campania() {
		$data = Input::all();

		$rules = array();
		$messages = array();

		//Gets step validation
		switch(Input::get('paso')) {
			case '3':
				$rules = array_merge($rules, $rules = array(
					'campania:nombre'       => 'required',
					'campania:asunto'       => 'required',
					'campania:remitente'    => 'required',
					'campania:email'        => 'required|email',
					'campania:respuesta'    => 'required|email',
					'campania:listas'       => 'required_if:con_listas,on',
					'campania:redes'        => 'required_if:compartir,on',
					'fecha'                 => 'required_if:campania:envio,programado',
					'hora'                  => 'required_if:campania:envio,programado'
				));

				$messages = array_merge($messages, $messages = array(
					'campania:nombre.required'      => 'Falta completar el nombre',
					'campania:asunto.required'      => 'Falta completar el asunto',
					'campania:remitente.required'   => 'Falta completar el remitente',
					'campania:email.required'       => 'Falta completar el email',
					'campania:email.email'          => 'El email debe ser válido',
					'campania:respuesta.required'   => 'Falta completar la dirección de respuesta',
					'campania:respuesta.email'      => 'La dirección de respuesta debe ser un email válido',
					'campania:listas.required_if'   => 'Es necesario elegir al menos una lista de contactos',
					'campania:redes.required_if'    => 'Ha elegido compartir en redes sociales pero ninguna red',
					'fecha.required_if'             => 'Es obligatorio ingresar la fecha para la programación del envío',
					'hora.required_if'              => 'Es obligatorio ingresar la hora para la programación del envío'
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
				/*
				$rules = array_merge($rules, array(

				));

				$messages = array_merge($messages, array(

				));
				*/
								
				switch(Session::get('campania.subtipo')) {
					case 'editor':
						$rules = array_merge($rules, array(
							'campania:contenido' => 'required'
						));

						$messages = array_merge($messages, array(
							'campania:contenido.required' => 'Es necesario cargar un contenido'
						));

						break;

					case 'gallery':
						$rules = array_merge($rules, array(

						));

						$messages = array_merge($messages, array(

						));

						break;

					case 'url':
						$rules = array_merge($rules, array(
							'campania:contenido' => 'required'
						));

						$messages = array_merge($messages, array(
							'campania:contenido.required' => 'Es necesario cargar un contenido'
						));

						break;
					default:
						return 'Error de subtipo';
				}

				break;
		}

		$validator = Validator::make($data, $rules, $messages);


		/******************
			IF VALID OK
		*******************/
		if($validator->passes()) {

			//Save all inputs in session
			foreach(Input::all() as $key => $value) {
				Session::put(str_replace(':', '.', $key), $value);
			}

			//Determine an action
			switch(Input::get('y')) {

				case 'salir':
					// se guarda como borrador
					$campania = $this->getCampaignCreated();
					Session::forget('campania');
					$response = Response::json(array('status' => 'ok' ));
					break;

				case 'seguir':
					// sólo guarda en la sesión
					$response =  Response::json(array('status' => 'ok' ));
					break;

				

				case 'confirmar':
					$campania = $this->getCampaignCreated();
					$success = false;
					$programmedTime = null;
					if ($campania->envio === 'programmed') {
						// $year = 2015;
						// $month = 07;
						// $day = 13;
						// $hour = 00;
						// $minute = 30;
						// $second = 00;
						// $programmedTime = Carbon::create($year, $month, $day, $hour, $minute, $second, $tz);
						$programmedTime = Carbon::now()->addMinutes(2);
					}
					$mail = new MailController();

					if($mail->sendCampaign($campania, $programmedTime)){
						$campania->status = 'sent';
						$campania->save();
						$success = true;
						Session::forget('campania');
					}
					
					if($success)
						$response = Response::json(array('status' => 'ok' ));
					else
						$response = Response::json(array('status' => 'error' ));
					break;


				case 'test':
					$campania = $this->getCampaignCreated();

					$success = false;
					$mail = new MailController();
					if($mail->emailTest($campania, Input::get('emailtest') )){
						$success = true;
					}
					$response = Response::json(array('status' => 'ok' ));

			}
		} else {
			$response =  Response::json(array(
				'status' => 'error',
				'validator' => $validator->messages()->toArray()
			));
		}

		return $response;
	}

	//Gets and returns a campaign from db or session
	private function getCampaignCreated() {
		$id = Session::get('campania.id');

		//edit mode
		if($id) {
			$campania = Campania::find($id);
			$campania->id  			= Session::get('campania.id');
			$campania->tipo  		= Session::get('campania.tipo');
			$campania->subtipo 		= Session::get('campania.subtipo');
			$campania->nombre 		= Session::get('campania.nombre');
			$campania->asunto 		= Session::get('campania.asunto');
			$campania->remitente	= Session::get('campania.remitente');
			$campania->email 		= Session::get('campania.email');
			$campania->respuesta 	= Session::get('campania.respuesta');
			$campania->contenido 	= Session::get('campania.contenido');
			$campania->redes 		= Session::get('campania.redes');
			$campania->status 		= Session::get('campania.status');
			$campania->envio 		= Session::get('campania.envio');
			$campania->notificacion = Session::get('campania.notificacion');
			if($campania->notificacion == 'on'){
				$campania->notificacion = true;
			}else if($campania->notificacion == 'off'){
				$campania->notificacion = false;
			}
			$campania->save();

			$socialLink = SocialLink::find($campania->social_link_id);
			$socialLink = $this->getSocialLinksFromSession($socialLink);
			$socialLink->save();

		//new mode
		} else {

			$socialLink = new SocialLink;
			$socialLink = $this->getSocialLinksFromSession($socialLink);
			$socialLink->save();

			$campania = Campania::create(array(
				'id_usuario'    => Auth::user()->id,
				'social_link_id'=> $socialLink->id,
				'tipo'          => Session::get('campania.tipo'),
				'subtipo'       => Session::get('campania.subtipo'),
				'nombre'        => Session::get('campania.nombre'),
				'asunto'        => Session::get('campania.asunto'),
				'remitente'     => Session::get('campania.remitente'),
				'email'         => Session::get('campania.email'),
				'respuesta'     => Session::get('campania.respuesta'),
				'contenido'     => Session::get('campania.contenido'),
				'redes'         => Session::get('campania.redes') ? json_encode(Session::get('campania.redes')) : null,
				'status'        => 'draft',
				'envio'         => Session::get('campania.envio'),
				'programacion'  => Session::get('campania.envio') == 'programmed' ? Carbon::createFromFormat('d/m/Y H:i', Session::get('fecha') . ' ' . Session::get('hora')) : null,
				'notificacion'  => Session::get('campania.notificacion') == 'on' ? true : false
			));
			$campania->listas()->attach(Session::get('campania.listas'));

		}
		return $campania;
	}

	public function getSocialLinksFromSession($socialLink) {
		$socialLink->facebook	= Session::get('campania.socialLinks_facebook');
		$socialLink->twitter	= Session::get('campania.socialLinks_twitter');
		$socialLink->linkedin	= Session::get('campania.socialLinks_linkedin');
		$socialLink->googleplus	= Session::get('campania.socialLinks_googleplus');
		$socialLink->pinterest	= Session::get('campania.socialLinks_pinterest');
		$socialLink->blogger	= Session::get('campania.socialLinks_blogger');
		$socialLink->meneame	= Session::get('campania.socialLinks_meneame');
		$socialLink->tumblr		= Session::get('campania.socialLinks_tumblr');
		$socialLink->reddit		= Session::get('campania.socialLinks_reddit');
		$socialLink->digg		= Session::get('campania.socialLinks_digg');
		$socialLink->delicious	= Session::get('campania.socialLinks_delicious');
		return $socialLink;
	}

	//Gets a campaign and return its view
	public function campania($id) {
		$campania = Campania::find($id);

		if(isset($campania)){
			Session::put('campania.id', 			$campania->id );
			Session::put('campania.social_link_id', $campania->social_link_id );
			Session::put('campania.tipo', 			$campania->tipo );
			Session::put('campania.subtipo', 		$campania->subtipo);
			Session::put('campania.nombre', 		$campania->nombre);
			Session::put('campania.asunto', 		$campania->asunto);
			Session::put('campania.remitente', 		$campania->remitente);
			Session::put('campania.email', 			$campania->email);
			Session::put('campania.respuesta', 		$campania->respuesta);
			Session::put('campania.contenido', 		$campania->contenido);
			Session::put('campania.redes', 			$campania->redes);
			Session::put('campania.status', 		$campania->status);
			Session::put('campania.envio', 			$campania->envio);
			Session::put('campania.notificacion', 	$campania->notificacion);

			foreach ($campania->listas as $lista) {
				Session::push('campania.listas', $lista->id);
			}

			$socialLink = SocialLink::find($campania->social_link_id);
			Session::put('campania.socialLinks_facebook', 	$socialLink->facebook);
			Session::put('campania.socialLinks_twitter', 	$socialLink->twitter);
			Session::put('campania.socialLinks_linkedin', 	$socialLink->linkedin);
			Session::put('campania.socialLinks_googleplus', $socialLink->googleplus);
			Session::put('campania.socialLinks_pinterest', 	$socialLink->pinterest);
			Session::put('campania.socialLinks_blogger', 	$socialLink->blogger);
			Session::put('campania.socialLinks_meneame', 	$socialLink->meneame);
			Session::put('campania.socialLinks_tumblr', 	$socialLink->tumblr);
			Session::put('campania.socialLinks_reddit', 	$socialLink->reddit);
			Session::put('campania.socialLinks_digg', 		$socialLink->digg);
			Session::put('campania.socialLinks_delicious', 	$socialLink->delicious);
		}else{
			return 'No se ha encontrado la campaña';
		}

		if(Auth::user()->id == $campania->id_usuario) {
			switch($campania->tipo) {
				case 'clasica':
					return View::make('campaigns/new_campaign_step5', array(
						'campania' => $campania
					));
					break;

				case 'social':
					return View::make('internas/ver_campaniasocial_paso5', array(
						'campania' => $campania
					));
					break;
			}
		} else {
			return Redirect::to('/');
		}


	}

	public function duplicateCampaign($id) {
		Session::put('campania.tipo','clasica');
		Session::put('campania.subtipo','editor');

		$campania = Campania::find($id);

		Session::put('campania.social_link_id', $campania->social_link_id );
		Session::put('campania.tipo', 			$campania->tipo );
		Session::put('campania.subtipo', 		$campania->subtipo);
		Session::put('campania.nombre', 		$campania->nombre);
		Session::put('campania.asunto', 		$campania->asunto);
		Session::put('campania.remitente', 		$campania->remitente);
		Session::put('campania.email', 			$campania->email);
		Session::put('campania.respuesta', 		$campania->respuesta);
		Session::put('campania.contenido', 		$campania->contenido);
		Session::put('campania.redes', 			$campania->redes);
		Session::put('campania.status', 		$campania->status);
		Session::put('campania.envio', 			$campania->envio);
		Session::put('campania.notificacion', 	$campania->notificacion);

		foreach ($campania->listas as $lista) {
			Session::push('campania.listas', $lista->id);
		}

		$socialLink = SocialLink::find($campania->social_link_id);
		Session::put('campania.socialLinks_facebook', 	$socialLink->facebook);
		Session::put('campania.socialLinks_twitter', 	$socialLink->twitter);
		Session::put('campania.socialLinks_linkedin', 	$socialLink->linkedin);
		Session::put('campania.socialLinks_googleplus', $socialLink->googleplus);
		Session::put('campania.socialLinks_pinterest', 	$socialLink->pinterest);
		Session::put('campania.socialLinks_blogger', 	$socialLink->blogger);
		Session::put('campania.socialLinks_meneame', 	$socialLink->meneame);
		Session::put('campania.socialLinks_tumblr', 	$socialLink->tumblr);
		Session::put('campania.socialLinks_reddit', 	$socialLink->reddit);
		Session::put('campania.socialLinks_digg', 		$socialLink->digg);
		Session::put('campania.socialLinks_delicious', 	$socialLink->delicious);

		$socialLink = new SocialLink;
		$socialLink = $this->getSocialLinksFromSession($socialLink);
		$socialLink->save();

		if(Auth::user()->id == $campania->id_usuario) {
			switch($campania->tipo) {
				case 'clasica':
					return Redirect::route('step3');
					break;
			}
		} else {
			return Redirect::to('/');
		}

	}

	public function eliminar_campania($id) {
		$campania = Campania::find($id);

		if(Auth::user()->id == $campania->id_usuario) {
			Campania::destroy($id);

			return Response::json(array(
				'status' => 'ok'
			));
		} else {
			return Response::json(array(
				'status' => 'error'
			));
		}
	}

	public function reestablecer($id) {
		$campania = Campania::withTrashed()->find($id);

		if($campania->trashed()) {
			$campania->restore();
		}

		return Redirect::to(URL::previous());
	}

	public function getTemplate($id) {
		$template = Template::find($id);
		$templateName = strtolower($template->category.'_'.$template->name);
		$html = Helpers::fixImagePaths($template->content, $templateName);
		$template->content = $html.'';
		return $template;
	}

	public function fetchUrl() {
		$url = Input::get('url');

		$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);     
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);

        $html = curl_exec($ch);
        curl_close($ch);

        if($html){
            $res = $html;
        }else{
            $res = curl_error($ch);
        }

        return utf8_encode($res);
	}

}