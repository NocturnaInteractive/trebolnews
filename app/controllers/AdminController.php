<?php

class AdminController extends BaseController {

    public function login() {
        $data = Input::all();

        $rules = array(
            'usuario' => 'required',
            'password' => 'required'
        );

        $messages = array(
            'usuario.required' => 'No se ingresó usuario',
            'password.required' => 'No se ingresó contraseña'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            if(Input::get('usuario') == Config::get('trebolnews.usuario_admin') && Input::get('password') == Config::get('trebolnews.password_admin')) {
                Session::put('admin', 'yes');

                return Response::json(array(
                    'status' => 'ok',
                    'route' => route('admin/home')
                ));
            } else {
                return Response::json(array(
                    'status' => 'error',
                    'mensaje' => 'No existe usuario'
                ));
            }
        } else {
            return Response::json(array(
                'status' => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function planToUser() {
        $orderId = Request::input('orderId');
        $order = Orden::find($orderId);
        $checkout = new CheckoutController();
        $checkout->manualPayment($order);

        return Response::json(array('status' => 'ok'), 200);
    }

}
