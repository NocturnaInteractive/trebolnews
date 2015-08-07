<?php

class SendEmailQueue extends \BaseController {

    public function fire($job, $data) {
    	try {
		    Log::info('Making POST Request...');
		    $client = new GuzzleHttp\Client();
			$response = $client->post('http://45.55.64.73/mail/singlemail', ['auth' =>  ['user', 'pass']]);
	    	//$response = Request::create('/mail/singlemail', 'POST', $data);
		    Log::info($response);
		} catch (Exception $e) {
			Log::info('Exception Found!! '. $e->getMessage());
			Log::info($_SERVER);
		    echo 'Exception Found!! ',  $e->getMessage(), "\n";
		}
    	
    	$job->delete();
	}

}