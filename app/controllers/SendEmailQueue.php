<?php

class SendEmailQueue extends \BaseController {

    public function fire($job, $data) {
    	$mailController = new MailController();

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
			'email' => 'maxi@nocturnainteractive.com', 
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

    	$job->delete();
	}

}