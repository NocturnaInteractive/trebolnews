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
                    'id_usuario'  => Auth::user()->id,
                    'nombre'      => Input::get('nombre'),
                    'descripcion' => Input::get('nombre')
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

    public function folders() {
        $userId = Auth::user()->id;
        $folders = Carpeta::where('id_usuario', $userId)->get();
        return Response::json($folders);
    }

    public function allImages() {
        $userId = Auth::user()->id;
        $folders = Carpeta::where('id_usuario', $userId)->get(['id']);
        $foldersId = array();
        for($i = 0; $i<count($folders); $i++){
            array_push($foldersId, $folders[$i]->id);
        }
        $images = Imagen::whereIn('id_carpeta',$foldersId)->get();
        return Response::json($images);
    }

}