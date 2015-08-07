<?php

class HomeController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function index() {
        $res = array(
            'plans' => Plan::all()
        );


            $client = new GuzzleHttp\Client();
            $response = $client->get('http://api.geonames.org/citiesJSON?north=44.1&south=-9.9&east=-22.4&west=55.2&lang=de&username=demo');
            $response = $client->post('http://45.55.64.73/mail/singlemail');

        return View::make('trebolnews.home.index', $res);
    }

}
