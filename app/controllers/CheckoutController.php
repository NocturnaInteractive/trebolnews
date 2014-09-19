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
        $order->isSuscription = $foundPlan['isSuscription'];
        $order->save();

        $external_reference = $order->id;

        /****************************
                MAIN CONFIGS
        ****************************/

        $payer = array(
            "name"      => $user->nombre,
            "surname"   => $user->apellido,
            "email"     => $user->email
        );

        //URL de retorno
        $back_urls = array(
            "success"   => "http://http://104.131.143.16/checkout-success",
            "failiure"  => "http://http://104.131.143.16/",
            "pending"   => "http://http://104.131.143.16/"
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
                "external_reference"    => (string) $external_reference,
                "auto_recurring"        => array(
                    "frequency"             => 1,
                    "frequency_type"        => "months",
                    "transaction_amount"    => $plan['unit_price'],
                    "currency_id"           => "ARS",
                    "start_date"            => date('c'),
                    "end_date"              => date('c',mktime(0, 0, 0, date("m")  , date("d"), date("Y")+10))
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
        $topic          = (string) Input::get('topic','Forced Topic');
        $id             = (string) Input::get('id',null);
        $mp             = $this->mlAuth();
        $access_token   = (string) $mp->get_access_token();

        if(!$id){
            $message = 'No ID found';
        }else{
            
            //'https://api.mercadolibre.com/collections/notifications/identificador-de-la-operación?access_token=tu_access_token'
            $url    = 'https://api.mercadolibre.com/sandbox/collections/notifications/'.$id.'?access_token='.$access_token;        
            
            try{
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);     
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_SSLVERSION, 3);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json'
                    )
                );

                $json = curl_exec($ch);
                curl_close($ch);

                if($json){                    
                    $payment_info = json_decode($json);
                    $message = 'nothing found';
                }else{
                    return curl_error($ch);
                }
            
            }catch(Exception $e){
                Log::info('error on curl...'.$e->getMessage());
                return 'problem on curl';
            }

            
            try{
                $payment_status = $payment_info->collection->status;

                switch ($payment_status) {
                    case 'approved':
                        $message = $this->approvePayment($payment_info);
                        break;
                    case 'pending':
                        break;
                    case 'in_process':
                        break;
                    case 'rejected':
                        break;
                    case 'refunded':
                        break;
                    case 'cancelled':
                        break;
                    case 'in_mediation':
                        break;
                    case 'charged_back':
                        break;
                }
                
            }catch(Exception $e){
                $message = 'error happened: '.$e->getMessage();
                Log::info($message);
            }
        }

        return $message;
    }

    private function approvePayment ($payment_info){
        $message = '';

        //checks for external reference / order id
        if (isset($payment_info->collection->external_reference)) {
            $external_reference = $payment_info->collection->external_reference;
            $orden = Orden::find( (int) $external_reference );

            if($orden){
                //creates payment
                $this->createPayment($orden,'approved');

                //gives to the user the purchased product
                $this->updatePurchase($orden);

                $message = 'OK!';
            }else{
                $message = 'non order found';
            }
        }else{
            $message = 'non external reference received';
        }
        return $message;
    }

    private function createPayment($orden,$status){
        //$pago = Pago::where('id_orden', $orden['id']);

        //if(!$pago){
            $pago = new Pago;
            $pago->id_orden      = $orden['id'];
            $pago->id_usuario    = $orden['id_usuario'];
            $pago->monto         = (float) $orden['monto'];
        //}
        $pago->status = $status;
        $pago->save();
    }

    private function updatePurchase($orden){
        //incrementar la cantidad de envios del usuario por el numero que adquirio
    }
}