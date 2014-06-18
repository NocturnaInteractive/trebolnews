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

}