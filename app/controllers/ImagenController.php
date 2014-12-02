<?php

class ImagenController extends BaseController {

    public function guardar() {
        $data = Input::all();

        $rules = array(
            'imagen' => 'required_without:id',
        );

        $messages = array(
            'imagen.required_without' => 'Es necesario seleccionar una imagen',
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            if(Input::has('id')) {
                $imagen = Imagen::find(Input::get('id'));
                $imagen->nombre = Input::get('nombre');
                $imagen->save();
            } else {
                $nombre = time() . '.' . Input::file('imagen')->getClientOriginalExtension();
                $imagen = Input::file('imagen')->move(public_path() . '/uploads/imagenes', $nombre);

                $imagen = Imagen::create(array(
                    'id_carpeta' => Input::get('id_carpeta') ?: Auth::user()->carpeta_mis_imagenes()->id,
                    'nombre'     => 'Nombre default',
                    'archivo'    => 'uploads/imagenes/' . $nombre
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
            'nombre'    => 'required',
            'archivo'   => 'required_without:id',
            'id_categoria' => 'required'
        );

        $messages = array(
            'nombre.required'          => 'Falta ingresar el nombre',
            'archivo.required_without' => 'Falta elegir un archivo',
            'id_categoria.required'       => 'Hay que elegir una categoría'
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

            $imagen->nombre       = Input::get('nombre');
            $imagen->id_categoria = Input::get('id_categoria');

            if(Input::hasFile('archivo')) {
                $ruta = public_path() . '/img/libreria';
                $nombre = 'libreriaimg' . $imagen->id . '.' . Input::file('archivo')->getClientOriginalExtension();
                Input::file('archivo')->move($ruta, $nombre);
                $imagen->archivo = 'img/libreria/' . $nombre;
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

    public function subir_a_libreria() {
        foreach(Input::get('chk_imagen') as $id_imagen) {
            $imagen = Imagen::find($id_imagen);

            Imagen::create(array(
                'id_carpeta' => Auth::user()->carpeta_mis_imagenes()->id,
                'nombre'     => $imagen->nombre,
                'archivo'    => $imagen->archivo
            ));
        }

        return Response::json(array(
            'route' => route('librerias')
        ));
    }

}
