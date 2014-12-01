<?php

class CategoriaController extends BaseController {

    public function guardar() {
        $data = Input::all();

        $rules = array(
            'nombre'      => 'required',
            'descripcion' => 'required'
        );

        $messages = array(
            'nombre.required'      => 'Hace falta un nombre',
            'descripcion.required' => 'Hace falta una descripción'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            if(Input::has('id')) {
                $categoria = Categoria::find(Input::get('id'));
                $categoria->nombre = Input::get('nombre');
                $categoria->descripcion = Input::get('descripcion');
                $categoria->save();
            } else {
                Categoria::create(array(
                    'nombre' => Input::get('nombre'),
                    'descripcion' => Input::get('descripcion')
                ));
            }

            return Response::json(array(
                'status' => 'ok',
                'route'  => route('admin/categorias')
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }

    }

}
