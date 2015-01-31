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

			$sent = 0;

			foreach($campaign->listas as $lista) {
				foreach($lista->contactos as $contacto) {

					$campaignView->suscriptor->name  = $contacto->nombre;
					$campaignView->suscriptor->last  = $contacto->apellido;
					$campaignView->suscriptor->email = $contacto->email;


					Mail::send('emails/campaign', array(
						'campaign' => $campaignView
					), function($mail) use($campaign, $contacto) {

						$mail->to($contacto->email, "{$contacto->nombre} {$contacto->apellido}")
							 ->subject($campaign->asunto)
							 ->from($campaign->email, $campaign->remitente)
							 ->replyTo($campaign->respuesta);
					});

					$sent++;
				}
			}

			Report::create(array(
				'campaign_id' => $campaign->id,
				'sent' => $sent,
				'received' => ( $sent - count(Mail::failures()) ),
				'failiure' => count(Mail::failures())
			));
		
			return true;
		}catch(Exception $e){
			return $e;
		}
		
	}

	public function getCampaignView($campaign){
		
		$owner = Usuario::find($campaign->id_usuario);

		$campaignView = new stdClass();
		$campaignView->id = $campaign->id;
		$campaignView->template = $campaign->contenido;
		$campaignView->suscriptor = new stdClass();

		$campaignView->owner = new stdClass();
		$campaignView->owner->suscriptionType = $owner->suscriptionType;

		$socialLinks = SocialLink::find($campaign->social_link_id);
		$campaignView->socialLinks = $socialLinks;

		return $campaignView;
	}


	public function emailTest($campaign, $email){
		//$campaign = Campania::find(3);
		$campaignView = $this->getCampaignView($campaign);
		$campaignView->suscriptor = new stdClass();
		$campaignView->suscriptor->email = $email;
		$campaignView->suscriptor->name =  'John';
		$campaignView->suscriptor->last =  'Doe';
		$campaignView->subject =  $campaign->asunto;
		$campaignView->reply =  $campaign->respuesta;
		$campaignView->remitent =  $campaign->remitente;
		$campaignView->from =  $campaign->email;

		Mail::send('emails/campaign', array(
			'campaign' => $campaignView
		), function($mail) use($campaignView) {
			$mail->to($campaignView->suscriptor->email, "{$campaignView->suscriptor->name} {$campaignView->suscriptor->last}")
				 ->subject($campaignView->subject)
				 ->from($campaignView->from, $campaignView->remitent)
				 ->replyTo($campaignView->reply);

			Log::info('Test Mail Sent');
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
