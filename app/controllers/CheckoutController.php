<?php

class CheckoutController extends BaseController {

    public function index() {

        /****************************
                MAIN CONFIGS
        ****************************/

        //reemplazar con el plan adquirido, almacenado en -posiblemente- sesion
        $plan  = array(
            'title'       => 'Plan Basico Mensual',
            'unit_price'  => 24.95,
            'quantity'    => 1,
            'currency_id' => 'ARS'
        );

        /* IDs MercadoPago */
        $mpClientId = "7444";
        $mpSecretId = "tRJ1ATI3zhw2FMTaH1ncPGtGG162Uwei";

        //reemplazar con datos del cliente
        $payer = array(
            "name"      => "Juan",
            "surname"   => "Prueba",
            "email"     => "cliente@cliente.com"
        );

        //URL de retorno
        $back_urls = array(
            "success"   => "http://localhost:8000/checkout/success",
            "failiure"  => "http://localhost:8000",
            "pending"   => "http://localhost:8000"
        );

        /****************************
               END MAIN CONFIGS
        ****************************/

        $items = [];
        array_push($items, $plan);

        

        $mp = new MP($mpClientId,$mpSecretId);

        $recurrent = false;
        if($recurrent === true){
            $preapproval_data = array(
                "payer_email"           => $payer['email'],
                "back_url"              => $back_urls['success'],
                "reason"                => $plan['title'],
                "external_reference"    => "OP-1234",
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
                "items"     => $items,
                "payer"     => $payer,
                "back_urls" => $back_urls
            );

            $preferenceResult = $mp->create_preference($preference);


            
            $result = array(
                'plan'     => $plan,
                'mplink'   => $preferenceResult['response']
            );
        }


        return View::make('checkout/checkout_review', $result );
    }


    public function success() {
        return View::make('checkout/checkout_success' );
    }

}