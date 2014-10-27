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

    public function guardar_interna() {
        $data = Input::all();

        $rules = array(
            'nombre'  => 'required',
            'archivo' => 'required_without:id'
        );

        $messages = array(
            'nombre.required'  => 'Falta ingresar el nombre',
            'archivo.required_without' => 'Faltar elegir un archivo'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            if(Input::has('id')) {
                $imagen = Imagen::find(Input::get('id'));
            } else {
                $imagen = Imagen::create(array(
                    'id_carpeta' => 1
                ));
            }

            $imagen->nombre = Input::get('nombre');

            if(Input::hasFile('archivo')) {
                $nombre = 'libreriaimg' . $imagen->id . '.' . Input::file('archivo')->getClientOriginalExtension();
                Input::file('archivo')->move(public_path() . '/img/libreria', $nombre);
                $imagen->archivo = $nombre;
            }

            $imagen->save();

            return Response::json(array(
                'status' => 'ok',
                'route'  => route('admin/libreria')
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function eliminar_interna($id) {
        Imagen::destroy($id);

        return Redirect::back();
    }
}
