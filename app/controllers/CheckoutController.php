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
        $order->save();

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
                "external_reference"    => (string) $external_reference,
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
        $topic  = (string) Input::get('topic','Forced Topic');
        $id     = (string) Input::get('id',1411068489);
        $mp     = $this->mlAuth();
        $access_token= (string) $mp->get_access_token();

        if(!$id){
            return 'no id';
        }else{
            Log::info('\nIPN was received! ID: '.$id.' because a '.$topic);
            try{
                //'https://api.mercadolibre.com/collections/notifications/identificador-de-la-operación?access_token=tu_access_token'
                $url    = 'https://api.mercadolibre.com/sandbox/collections/notifications/'.$id.'?access_token='.$access_token;
                Log::info($url);
            }catch(Exception $e){
                Log::info('A problem getting token...'.$e->getMessage());
                return 'problem getting token';
            }
            
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
                    Log::info('Notification Fetched! '.gettype($json));
                    
                    $payment_info = json_decode($json);
                    Log::info('JSON Decoded');

                    $message = 'nothing found';
                }else{

                    return curl_error($ch);
                }
                
                

                Log::info('Let´s check the payment status...');
            }catch(Exception $e){
                Log::info('error on curl...'.$e->getMessage());
                return 'problem on curl';
            }

            
            try{
                if ($payment_info->collection->status == "approved") {
                    Log::info('The payment was approved!');
                    $message = $this->confirmNotification($payment_info);
                }
            }catch(Exception $e){
                $message = 'error happened: '.$e->getMessage();
                Log::info($message);
            }
            

            return $message;

        }
    }

    private function confirmNotification($payment_info){
        Log::info('Let´s check the external reference...');
        if (isset($payment_info->collection->external_reference)) {
            $external_reference = $payment_info->collection->external_reference;
            Log::info('External reference found! - '.$external_reference);

            Log::info('Let´s check for an existing order...');
            $orden = Orden::find( (int) $external_reference );

            if($orden){
                Log::info('Order found! Generating Payment...');
                $this->generatePayment($orden);
                $orden->status = 'paid';
                $this->updatePurchase($orden);
                return 'everything ok!';
            }

            return 'non order found';
        }else{
            return 'non external reference received';
        }

    }

    private function generatePayment($orden){
        $pago = new Pago;
        $pago->id_orden      = $orden['id'];
        $pago->id_usuario    = $orden['id_usuario'];
        $pago->monto         = (float) $orden['monto'];
        $pago->save();
    }

    private function updatePurchase($orden){
        //incrementar la cantidad de envios del usuario por el numero que adquirio
    }
}