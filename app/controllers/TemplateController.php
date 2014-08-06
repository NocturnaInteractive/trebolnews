<?php

class TemplateController extends BaseController {

	public function guardar() {
		$data = Input::all();

		$rules = array(
			'nombre' 	=> 'required',
			'categoria' => 'required',
			'archivo' 	=> 'required|mimes:html'
		);

		$messages = array(
			'nombre.required' 		=> 'El template debe tener un nombre',
			'categoria.required' 	=> 'El template debe tener una categoria',
			'archivo.required' 		=> 'No se seleccionó un archivo',
			'archivo.mimes' 		=> 'El archivo debe ser .html'
		);

		$validator = Validator::make($data, $rules, $messages);

		if($validator->passes()) {
			if(Input::has('id')) {
				$template = Template::find(Input::get('id'));
				$template->nombre 		= Input::get('nombre');
				$template->categoria 	= Input::get('categoria');
				$template->nombre 		= Input::get('nombre');
				$template->save();
			} else {
				$template = Template::create(array(
					'id_usuario' 	=> Auth::user()->id,
					'nombre' 		=> Input::get('nombre')
				));
			}

			return Response::json(array(
				'status' => 'ok'
			));
		} else {
			return Response::json(array(
				'status' 	=> 'error',
				'validator' => $validator->messages()->toArray()
			));
		}
	}

	public function eliminar() {
		// Template::destroy(Input::get('id'));
	}

}