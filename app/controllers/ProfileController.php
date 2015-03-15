<?php

class ProfileController extends \BaseController {

	/**
	 * Sets the data for profile
	 */
	public function index()
	{
		$payments = $this->paymentHistory();
		$empresa  = json_decode(Auth::user()->empresa);

        return View::make('trebolnews/perfil', array(
            'empresa'  => $empresa,
            'payments' => $payments
        ));
	}

	/**
	 * Fetch all payments and returns chosen attributes 
	 *
	 * @return Response
	 */
	public function paymentHistory()
	{
		$user = Auth::user();
        $payments = Pago::where('id_usuario','=',$user['id'])->get();
		$paymentViews = array();



		foreach ($payments as $payment){
			$order = Orden::find($payment->id_orden);
			$plan =  Plan::find($order->id_plan);
			$payment_mails = $plan->envios;

			$payment_status = '';
			switch ($payment->status) {
	            case 'approved':
	                $payment_status = 'Aprobado';
	                break;
	            case 'pending':
	                $payment_status = 'Pendiente';
	                break;
	            case 'in_process':
	                $payment_status = 'En Proceso';
	                break;
	            case 'rejected':
	                $payment_status = 'Rechazado';
	                break;
	            case 'refunded':
	                $payment_status = 'Reintegrado';
	                break;
	            case 'cancelled':
	                $payment_status = 'Cancelado';
	                break;
	            case 'in_mediation':
	                $payment_status = 'En Mediación';
	                break;
	            case 'charged_back':
	                $payment_status = 'Re-Cargado';
	                break;
	            default:
	                $payment_status = 'Pendiente';
	                break;
	        }

			array_push($paymentViews, (object) array(
				'payment_id' => $payment->id,	
				'order_id' => $payment->id_orden,	
				'mount' => $payment->monto,	
				'quantity' => $payment_mails,	
				'status' => $payment_status,
				'isSuscription' => $order->isSuscription,
				'created_at' => $payment->created_at	
			));

		}

		return $paymentViews;
	}


	public function footerForm(){
		$path_to_file = 'public/uploads/custom-footer/';
		$path_to_call = 'uploads/custom-footer/';
		$user_id = Auth::user()->id;
		$filename = $user_id;
		$upload_success = Input::file('image')->move($path_to_file, $filename);

		if( $upload_success ) {

			Log::info('Footer Image Uploaded: '. gettype($upload_success));

			$footer = CampaignFooter::where('user_id',$user_id)->first();
			if(!$footer){
				$footer = new CampaignFooter;
				$footer->user_id 	= $user_id;
			}
			$footer->name 		= Input::get('name');
			$footer->imagePath  = $path_to_call.$filename;
			$footer->email 		= Input::get('email');
			$footer->address    = Input::get('address');
			$footer->save();

			return var_dump($upload_success);
			return Response::json(array('status' => 'ok'), 200);
		} else {
			return Response::json(array('status' => 'error'), 400);
		}
	}

}
