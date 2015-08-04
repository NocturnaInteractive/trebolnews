<?php

class MailController extends \BaseController {

	/**
	 * Sends an email with given campaign.
	 *
	 * @return Response
	 */
	public function sendCampaign($campaign, $programmedDateTime = null, $forcedContacts = []){
		
		if(count($forcedContacts) > 0){
			$campaign->listas = [];
			array_push($campaign->listas, $forcedContacts);
		}

		$isProgrammed = $campaign->envio === 'programmed';

		try{

			$sent = 0;

			foreach($campaign->listas as $lista) {
				foreach($lista->contactos as $contacto) {

					if ($isProgrammed) {
						Log::info('Programmed Mail queued');
						Queue::later($programmedDateTime, 'SendEmailQueue', array(
							'campaign' => $campaign,
							'contact' => $contacto
						));
					} else {
						Log::info('Direct Mail queued');
						Queue::push('SendEmailQueue', array(
							'campaign' => $campaign,
							'contact' => $contacto
						));
					}


					$sent++;
				}
			}

			Report::create(array(
				'campaign_id' => $campaign->id,
				'sent' => $sent,
				'received' => ( $sent - count(Mail::failures()) ),
				'failiure' => count(Mail::failures())
			));

			$this->discountMails($sent);
		
			return true;
		}catch(Exception $e){
			return $e;
		}
		
	}

	public function sendSingleMail($data){
		try {
		    Log::info('Setting Campaign...');
	    	$campaign = (object) $data['campaign'];
			Log::info('Setting Contact...');
	    	$contacto = (object) $data['contact'];
			Log::info('Setting View...');
	    	$campaignView = $this->getCampaignView($campaign);
	    	$campaignView->suscriptor->name  = $contacto->nombre;
			$campaignView->suscriptor->last  = $contacto->apellido;
			$campaignView->suscriptor->email = $contacto->email;

			
			Log::info('Setting Data...');
			$data = array( 
				'email' => 'el.marto.mail@gmail.com', 
				'async' => true, 
				'campaign' => $campaignView
			);
			Log::info('Sending email...');

	    	Mail::send('emails/campaign', $data, function($mail) use($campaign, $contacto) {
				Log::info('Processing email...');
				$mail->to($contacto->email, "{$contacto->nombre} {$contacto->apellido}")
					 ->subject($campaign->asunto)
					 ->from($campaign->email, $campaign->remitente)
					 ->replyTo($campaign->respuesta);
			});
			Log::info('Email Sent to '.$campaignView->suscriptor->email);

		} catch (Exception $e) {
		    echo 'Exception Found!! ',  $e->getMessage(), "\n";
		}

		return false;

	}

	public function getCampaignView($campaign){
		$campaign = (object) $campaign;
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


	public function discountMails ($discountQuantity) {
		$user = (object) Usuario::find(Auth::user()->id);
        $user->availableMails = $user->availableMails - $discountQuantity;
        $user->save();
        return $user->availableMails;
	}


}
