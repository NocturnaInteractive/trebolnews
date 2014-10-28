<?php

class ListaController extends BaseController {

    public function guardar() {
        $data = Input::all();

        $rules = array(
            'nombre' => 'required',
        );

        $messages = array(
            'nombre.required' => 'La lista debe tener un nombre',
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            if(Input::has('id')) {
                $lista = Lista::find(Input::get('id'));
                $lista->nombre = Input::get('nombre');
                $lista->save();
            } else {
                $lista = Lista::create(array(
                    'id_usuario' => Auth::user()->id,
                    'nombre' => Input::get('nombre')
                ));
            }

            return Response::json(array(
                'status' => 'ok'
            ));
        } else {
            return Response::json(array(
                'status' => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function eliminar() {
        Lista::destroy(Input::get('id'));
    }

    public function search() {
        $data = Input::all();

        $rules = array(
            'search-term' => 'required'
        );

        $messages = array(
            'search-term.required' => 'Ingrese un término para la búsqueda'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes() || Session::has('search-term')) {
            if(Input::has('search-term')) {
                Session::put('search-term', Input::get('search-term'));
            }

            $listas = Auth::user()->listas()->where('nombre', 'like', '%' . Input::get('search-term', Session::get('search-term')) . '%')->paginate(5);

            return Response::json(array(
                'status' => 'ok',
                'html'   => View::make('trebolnews/listas/suscriptores', array(
                    'listas' => $listas
                ))->render(),
                'paginador' => $listas->links('trebolnews/paginador-ajax')->render(),
                'total' => $listas->count()
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

}
