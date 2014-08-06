<?php

class ContactoController extends BaseController {

    public function guardar() {
        $data = Input::all();

        $rules = array(
            'nombre'    => 'required',
            'apellido'  => 'required',
            'email'     => 'required|email',
            'puesto'    => 'required',
            'empresa'   => 'required',
            'pais'      => 'required'
        );

        $messages = array(
            'nombre.required'   => 'Falta completar el nombre',
            'apellido.required' => 'Falta completar el apellido',
            'email.required'    => 'Falta completar el e-mail',
            'email.email'       => 'El e-mail debe ser válido',
            'puesto'            => 'Falta completar el puesto / cargo',
            'empresa'           => 'Falta completar la empresa',
            'pais'              => 'Falta completar el país'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            if(Input::has('id')) {
                $contacto = Contacto::find(Input::get('id'));
                $contacto->nombre   = Input::get('nombre');
                $contacto->apellido = Input::get('apellido');
                $contacto->email    = Input::get('email');
                $contacto->puesto   = Input::get('puesto');
                $contacto->empresa  = Input::get('empresa');
                $contacto->pais     = Input::get('pais');

                $contacto->save();
            } else {
                Contacto::create(array(
                    'id_lista'  => Input::get('id_lista'),
                    'nombre'    => Input::get('nombre'),
                    'apellido'  => Input::get('apellido'),
                    'email'     => Input::get('email'),
                    'puesto'    => Input::get('puesto'),
                    'empresa'   => Input::get('empresa'),
                    'pais'      => Input::get('pais')
                ));
            }

            return Response::json(array(
                'status' => 'ok'
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function eliminar() {
        Contacto::destroy(Input::get('id'));
    }

}