<?php

class ReportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $campaign_id
	 * @return Response
	 */
	public function show($campaign_id)
	{
		return View::make('campaigns/report', array(
				'campaign' => Campania::find($campaign_id),
				'report'   => Report::where('campaign_id', $campaign_id)->first()
			));
	}


	public function pixel($campaign_id)
	{
		$report = Report::where('campaign_id', $campaign_id)->first();
		$report->opened++;
		$report->save();
		$response = Response::make(File::get(public_path().'/imagenes/pixel.gif'));
		$response->header('Content-Type', 'image/gif');
		return $response;
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
