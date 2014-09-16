<?php

class CheckoutController extends BaseController {

    public function index($id) {

        $user=Auth::user();

        $foundPlan = Plan::find($id);
        $plan  = array(
            'title'       => $foundPlan['nombre'],
            'unit_price'  => (float) $foundPlan['precio'],
            'quantity'    => 1,
            'currency_id' => 'ARS'
        );

        $order = new Orden;
        $order->id_usuario    = $user->id;
        $order->id_plan       = $foundPlan['id'];
        $order->monto         = $foundPlan['precio'];
        $order->isSuscription = true;

        $external_reference = $order->id;

        /****************************
                MAIN CONFIGS
        ****************************/


        //reemplazar con datos del cliente
        $payer = array(
            "name"      => $user->nombre,
            "surname"   => $user->apellido,
            "email"     => $user->email
        );

        //URL de retorno
        $back_urls = array(
            "success"   => "http://localhost:8000/checkout-success",
            "failiure"  => "http://localhost:8000",
            "pending"   => "http://localhost:8000"
        );

        

        /****************************
               END MAIN CONFIGS
        ****************************/

        $items = [];
        array_push($items, $plan);

        $mp = $this->mlAuth();

        //return $mp;

        $recurrent = false;
        if($recurrent === true){
            $preapproval_data = array(
                "payer_email"           => $payer['email'],
                "back_url"              => $back_urls['success'],
                "reason"                => $plan['title'],
                "external_reference"    => $external_reference,
                "auto_recurring"        => array(
                    "frequency"             => 1,
                    "frequency_type"        => "months",
                    "transaction_amount"    => $plan['unit_price'],
                    "currency_id"           => "ARS",
                    "start_date"            => "2014-12-10T14:58:11.778-03:00",
                    "end_date"              => "2015-06-10T14:58:11.778-03:00"
                )
            );

            $preapproval = $mp->create_preapproval_payment ($preapproval_data);

            $result = array(
                'plan'     => $plan,
                'mplink'   => $preapproval['response']
            );
        }else{
            

            $preference = array (
                "items"              => $items,
                "payer"              => $payer,
                "back_urls"          => $back_urls,
                "external_reference" => (string) $external_reference
            );

            $preferenceResult = $mp->create_preference($preference);


            
            $result = array(
                'plan'     => $plan,
                'mplink'   => $preferenceResult['response'],
                'test'     => $mp
            );
        }

        $order->save();
        return View::make('checkout/checkout_review', $result );
    }

    private function mlAuth(){
        /* IDs MercadoPago */
        $mpClientId = "7444";
        $mpSecretId = "tRJ1ATI3zhw2FMTaH1ncPGtGG162Uwei";

        return new MP($mpClientId,$mpSecretId);
    }


    public function success() {
        return View::make('checkout/checkout_success' );
    }

    public function notifications() {

        $topic  = Input::get('topic');
        $id     = Input::get('id',1234);
        $mp     = $this->mlAuth();
        
        $url    = 'https://api.mercadolibre.com/sandbox/collections/notifications/'.$id.'?access_token='.$mp->get_access_token();
        //'https://api.mercadolibre.com/collections/notifications/identificador-de-la-operación?access_token=tu_access_token'

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            )
        );
         
        $result = json_decode(curl_exec($ch));
        $message = 'Yay!';

        if(isset($result->collection->external_reference)){
            $this->confirmPayment($result);
        }else{
            $message = 'ID Not Found!';
        }
        return $message;
    }

    private function confirmPayment($result){

        $external_reference = $result->collection->external_reference;
        $orden = Orden::find( (int) $external_reference );

        $pago = new Pago;
        $pago->id_orden      = $orden->id;
        $pago->id_usuario    = $orden->id_usuario;
        $pago->monto         = (float) $orden->$foundPlan['precio'];
        $pago->isSuscription = true;
        $pago->save();

    }
}