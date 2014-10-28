<?php

class ExtraController extends Controller {

    public function guardar_comentario() {
        $data = Input::all();

        $rules = array(
            'nombre'     => 'required',
            'apellido'   => 'required',
            'email'      => 'required|email',
            'comentario' => 'required'
        );

        $messages = array(
            'nombre.required'     => 'Falta completar el nombre',
            'apellido.required'   => 'Falta completar el apellido',
            'email.required'      => 'Falta completar el e-mail',
            'email.email'         => 'El e-mail debe ser válido',
            'comentario.required' => 'Falta ingresar su comentario'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            $comentario = Comentario::create(array(
                'nombre'     => Input::get('nombre'),
                'apellido'   => Input::get('apellido'),
                'email'      => Input::get('email'),
                'comentario' => Input::get('comentario'),
                'telefono'   => Input::get('telefono'),
                'empresa'    => Input::get('empresa'),
            ));

            Mail::send('emails.comentario', array(
                'comentario' => $comentario
            ), function($mail) use($comentario){
                $mail->to(Conf::where('clave', 'email_comentarios')->first()->valor);
                $mail->from($comentario->email, "{$comentario->nombre} {$comentario->apellido}");
                $mail->subject('Nuevo comentario en TrebolNEWS');
            });

            return Response::json(array(
                'status'  => 'ok',
                'mensaje' => 'Gracias por su contacto'
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function guardar_suscripcion() {
        $data = Input::all();

        $rules = array(
            'email' => 'required|email'
        );

        $messages = array(
            'email.required' => 'Debe ingresar un e-mail',
            'email.email'    => 'El e-mail debe ser válido'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            $suscripcion = Suscripcion::where('email', Input::get('email'))->first();

            if(!$suscripcion) {
                Suscripcion::create(array(
                    'email' => Input::get('email')
                ));
            } else {
                $suscripcion->touch();
            }

            return Response::json(array(
                'status'  => 'ok',
                'mensaje' => 'Gracias por suscribirse'
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

}
