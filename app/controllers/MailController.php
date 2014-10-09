<?php

class MailController extends \BaseController {

	/**
	 * Sends an email with given campaign.
	 *
	 * @return Response
	 */
	public static function sendCampaign($campaign, $forcedContacts = [])
	{
		$campaignView = getCampaignView($campaign);
		
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
							'campaign' => $campaignView->template
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
			return false;
		}
		
	}

	public static function getCampaignView($campaign){
		$campaignView = new stdClass();
		$campaignView->template = $campaign->contenido;
		$campaignView->suscriptor = new stdClass();

		return $campaignView;
	}


	public static function test(){
		return true;
	}

	public function renderMail($campaignId,$contactId=null){
		$campaign = Campania::find($campaignId);
		$contact = Contacto::find($contactId);

		$campaignView = $this->getCampaignView($campaign);

		if($contact){
			$campaignView->suscriptor->name  = $contact->nombre;
			$campaignView->suscriptor->last  = $contact->apellido;
			$campaignView->suscriptor->email = $contact->email;	
		}else{
			$campaignView->suscriptor->name  = 'ContactName';
			$campaignView->suscriptor->name  = 'ContactLastName';
			$campaignView->suscriptor->email = 'contact@email.com';
		}
		

        $items = array('campaign' => $campaignView );
        return View::make('emails/prueba', $items);
	}

}
