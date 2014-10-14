<?php

class MailController extends \BaseController {

	/**
	 * Sends an email with given campaign.
	 *
	 * @return Response
	 */
	public function sendCampaign($campaign, $forcedContacts = []){
		
		$campaignView = $this->getCampaignView($campaign);
		
		if(count($forcedContacts) > 0){
			$campaign->listas = [];
			array_push($campaign->listas, $forcedContacts);
		}

		try{

			foreach($campaign->listas as $lista) {
				foreach($lista->contactos as $contacto) {

					$campaignView->suscriptor->name  = $contacto->nombre;
					$campaignView->suscriptor->last  = $contacto->apellido;
					$campaignView->suscriptor->email = $contacto->email;

					Mail::send('emails/prueba', array(
							'campaign' => $campaignView
						), function($mail) use($campaign, $contacto) {

							$mail->to($contacto->email, "{$contacto->nombre} {$contacto->apellido}")
								 ->subject($campaign->asunto)
								 ->from($campaign->email, $campaign->remitente)
								 ->replyTo($campaign->respuesta);
						});
				}
			}
		

			return true;
		}catch(Exception $e){
			return $e;
		}
		
	}

	public function getCampaignView($campaign){
		
		$owner = Usuario::find($campaign->id_usuario);

		$campaignView = new stdClass();
		$campaignView->template = $campaign->contenido;
		$campaignView->suscriptor = new stdClass();

		$campaignView->owner = new stdClass();
		$campaignView->owner->suscriptionType = $owner->suscriptionType;

		return $campaignView;
	}


	public function test(){
		$campaign = Campania::find(1);
		$campaignView = $this->getCampaignView($campaign);
		$campaignView->suscriptor->name  = 'Martin';
		$campaignView->suscriptor->last  = 'Sacco';
		$campaignView->suscriptor->email = 'el.marto.mail@gmail.com';

		Mail::send('emails/prueba', array(
			'campaign' => $campaignView
		), function($mail){

			$mail->to('el.marto.mail@gmail.com', "Martin Sacco")
				 ->subject('Asunto')
				 ->from('martin.sacco@glob.com', 'martin.sacco@glob.com')
				 ->replyTo('no-response@gol.com');
		});
	}

	public function renderMail($campaignId,$contactId,$verification){
		$campaign = Campania::find($campaignId);
		$contact = Contacto::find($contactId);
		$isVerified = substr(md5($campaignId .''. $contactId), 0,7) == $verification; 



		//return substr(md5($campaignId .''. $contactId), 0,7);
		if(!$campaign){
			return 'Campaign not found';
		}
		if(!$isVerified){
			App::abort(403, 'Unauthorized action.');
		}

		//return substr(Hash::make($campaignId .''. $contactId), 0,8);


		$campaignView = $this->getCampaignView($campaign);

		if($contact){
			$campaignView->suscriptor->name  = $contact->nombre;
			$campaignView->suscriptor->last  = $contact->apellido;
			$campaignView->suscriptor->email = $contact->email;	
		}else{
			$campaignView->suscriptor->name  = 'ContactName';
			$campaignView->suscriptor->last  = 'ContactLastName';
			$campaignView->suscriptor->email = 'contact@email.com';
		}
		

        $items = array('campaign' => $campaignView );
        return View::make('emails/prueba', $items);
	}

}
