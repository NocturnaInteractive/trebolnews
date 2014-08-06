<?php

class ImagenController extends BaseController {

    public function guardar() {
        $data = Input::all();

        $rules = array(
            'imagen' => 'required',
        );

        $messages = array(
            'imagen.required' => 'Es necesario seleccionar una imagen',
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            if(Input::has('id')) {
                $carpeta = Carpeta::find(Input::get('id'));
                $carpeta->nombre = Input::get('nombre');
                $carpeta->save();
            } else {
                $nombre = time() . '.' . Input::file('imagen')->getClientOriginalExtension();
                $imagen = Input::file('imagen')->move(public_path() . '/uploads/imagenes', $nombre);

                $imagen = Imagen::create(array(
                    'id_carpeta'    => Input::get('id_carpeta'),
                    'nombre'        => 'Nombre default',
                    'archivo'       => $nombre
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
        Imagen::destroy(Input::get('id'));
    }

}