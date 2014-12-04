<?php

use SoapBox\Formatter\Formatter;

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

    public function eliminar_multi() {
        $ids = Input::get('ids');
        foreach($ids as $id) {
            Lista::destroy($id);
        }
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

        if($validator->passes()) {
            Session::put('search-term', Input::get('search-term'));

            $cant = empty(Auth::user()->preferences()->cant_listas) ? 10 : Auth::user()->preferences()->cant_listas;

            $listas = Auth::user()->listas()->where('nombre', 'like', '%' . Input::get('search-term', Session::get('search-term')) . '%')->paginate($cant);

            $listas->setBaseUrl('lista-suscriptores');

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

    public function export($id) {
        $lista = Lista::find($id);
        $formatter = Formatter::make($lista->contactos->toArray(), Formatter::ARR);
        File::put(storage_path() . '/tmp/' . $lista->nombre . '.csv', $formatter->toCsv());
        return Response::download(storage_path() . '/tmp/' . $lista->nombre . '.csv');
    }

    public function import() {
        $data = Input::all();

        $rules = array(
            'archivo' => 'required'
        );

        $messages = array(
            'archivo.required' => 'Debe elegir un archivo',
            'archivo.mimes' => 'El archivo debe ser .csv'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            $filename = Input::file('archivo')->getClientOriginalName();
            $extlen = strlen(Input::file('archivo')->getClientOriginalExtension());
            $name = substr($filename, 0, strlen($filename) - $extlen - 1);
            $path = storage_path() . '/tmp/';
            Input::file('archivo')->move($path, $filename);
            $data = File::get($path . '/' . $filename);
            $formatter = Formatter::make($data, Formatter::CSV);

            $lista = Lista::where('id_usuario', '=', Auth::user()->id)
                ->where('nombre', '=', $name)
                ->first();

            if(!$lista) {
                $lista = Lista::create(array(
                    'id_usuario' => Auth::user()->id,
                    'nombre'     => $name
                ));
            }

            foreach($formatter->toArray() as $contacto) {
                Contacto::create(array(
                    'id_lista' => $lista->id,
                    'nombre'   => $contacto['nombre'],
                    'apellido' => $contacto['apellido'],
                    'email'    => $contacto['email'],
                    'puesto'   => $contacto['puesto'],
                    'empresa'  => $contacto['empresa'],
                    'pais'     => $contacto['pais']
                ));
            }

            return Response::json(array(
                'status' => 'ok',
                'route'  => route('lista', $lista->id)
            ));
        } else {
            return Response::json(array(
                'status' => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

}
