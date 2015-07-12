<?php

class SendEmailQueue extends \BaseController {

    public function fire($job, $data)
    {
    	$campaignView = $data['campaignView'];
    	$campaign = $data['campaign'];
    	$contacto = $data['contacto'];

    	Mail::send('emails/campaign', array(
			'campaign' => $campaignView
		), function($mail) use($campaign, $contacto) {
    		Log::info($contacto);
    		Log::info($campaign);
			$mail->to($contacto->email, "{$contacto->nombre} {$contacto->apellido}")
				 ->subject($campaign->asunto)
				 ->from($campaign->email, $campaign->remitente)
				 ->replyTo($campaign->respuesta);
    		Log::info('Sending an email');
    		Log::info($mail);
		});
	}

}