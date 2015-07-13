<?php

class SendEmailQueue extends \BaseController {

    public function fire($job, $data) {
    	$mailController = new MailController();
    	$mailController->sendSingleMail($data);
    	$job->delete();
	}

}