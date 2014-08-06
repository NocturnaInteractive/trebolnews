<?php

class CarpetaController extends BaseController {

    public function guardar() {
        $data = Input::all();

        $rules = array(
            'nombre' => 'required',
        );

        $messages = array(
            'nombre.required' => 'La carpeta debe tener un nombre',
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            if(Input::has('id')) {
                $carpeta = Carpeta::find(Input::get('id'));
                $carpeta->nombre = Input::get('nombre');
                $carpeta->save();
            } else {
                $carpeta = Carpeta::create(array(
                    'id_usuario'    => Auth::user()->id,
                    'nombre'        => Input::get('nombre')
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
        Carpeta::destroy(Input::get('id'));
    }

}