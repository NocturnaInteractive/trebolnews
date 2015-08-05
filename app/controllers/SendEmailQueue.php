<?php

class SendEmailQueue extends \BaseController {

    public function fire($job, $data) {
    	Request::create('/mail/singlemail', 'POST', $data);
    	$job->delete();
	}

}