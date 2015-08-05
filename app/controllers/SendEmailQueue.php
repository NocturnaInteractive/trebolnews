<?php

class SendEmailQueue extends \BaseController {

    public function fire($job, $data) {
    	try {
		    Log::info('Making POST Request...');
	    	$response = Request::create('/mail/singlemail', 'POST', $data);
		    Log::info($response);
		} catch (Exception $e) {
			Log::info('Exception Found!! '. $e->getMessage());
			Log::info($_SERVER);
		    echo 'Exception Found!! ',  $e->getMessage(), "\n";
		}
    	
    	$job->delete();
	}

}