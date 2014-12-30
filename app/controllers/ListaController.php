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
            $data = Excel::load($path . '/' . $filename);
            $lista = Lista::find(Input::get('id_lista'));

            $columnas = array_keys($data->all()[0]->toArray());

            if($columnas) {
                return Response::json(array(
                    'status' => 'ok',
                    'popup'  => View::make('trebolnews/popups/elegir_columnas', array(
                        'lista'    => $lista->id,
                        'columnas' => $columnas,
                        'archivo'  => $path . '/' . $filename
                    ))->render()
                ));
            } else {
                return Response::json(array(
                    'status' => 'error',
                    'message' => 'No se pudieron detectar las columnas'
                ));
            }

        } else {
            return Response::json(array(
                'status' => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function do_import() {
        $data = Input::all();

        $rules = array(
            'nombre'   => 'required',
            'apellido' => 'required',
            'email'    => 'required'
            // 'puesto'   => 'required',
            // 'empresa'  => 'required',
            // 'pais'     => 'required'
        );

        $messages = array(
            'nombre.required'   => 'Elija una columna para el nombre',
            'apellido.required' => 'Elija una columna para el apellido',
            'email.required'    => 'Elija una columna para el email'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            $id_lista = Input::get('id_lista');

            $columna = array();
            $columna['nombre'] = Input::get('nombre');
            $columna['apellido'] = Input::get('apellido');
            $columna['email'] = Input::get('email');
            $columna['puesto'] = Input::get('puesto');
            $columna['empresa'] = Input::get('empresa');
            $columna['pais'] = Input::get('pais');

            $data = Excel::load(Input::get('archivo'));

            $agregar = array();
            $evitar = array();
            foreach($data->all() as $contacto) {
                if(!empty($contacto[$columna['nombre']]) && !empty($contacto[$columna['apellido']]) && !empty($contacto[$columna['email']])) {
                    array_push($agregar, $contacto);
                } else {
                    array_push($evitar, $contacto);
                }
            }

            foreach($agregar as $contacto) {
                Contacto::create(array(
                    'id_lista' => $id_lista,
                    'nombre'   => $contacto[$columna['nombre']],
                    'apellido' => $contacto[$columna['apellido']],
                    'email'    => $contacto[$columna['email']],
                    'puesto'   => !empty($columna['puesto']) ? $contacto[$columna['puesto']] : '',
                    'empresa'  => !empty($columna['empresa']) ? $contacto[$columna['empresa']] : '',
                    'pais'     => !empty($columna['pais']) ? $contacto[$columna['pais']] : ''
                ));
            }

            return Response::json(array(
                'status' => 'ok',
                'mensaje' => 'Se importaron ' . count($agregar) . ' de ' . (count($agregar) + count($evitar)) . ' contactos'
            ));
        } else {
            return Response::json(array(
                'status' => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }

    }

}
