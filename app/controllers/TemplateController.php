<?php

class TemplateController extends BaseController {

    public function guardar() {
        $data = Input::all();

        $rules = array(
            // 'nombre'    => 'required',
            // 'categoria' => 'required',
            //'archivo'   => 'required'
        );

        $messages = array(
            'nombre.required'    => 'El template debe tener un nombre',
            'categoria.required' => 'El template debe tener una categoria',
            'archivo.required'   => 'No se seleccionó un archivo',
            'archivo.mimes'      => 'El archivo debe ser HTML'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {

            //UPDATE TEMPLATE
            if(Input::has('id')) {
                // $template = Template::find(Input::get('id'));
                // $template->nombre    = Input::get('nombre');
                // $template->categoria = Input::get('categoria');
                // $template->archivo   = Input::get('archivo');
                // $template->save();

            //NEW TEMPLATE
            } else {
                $templateExits = Template::where('name', Input::get('name'))->first();

                if($templateExits) {
                    return Response::json(array(
                        'status'  => 'error',
                        'mensaje' => 'Existe un template con ese nombre'
                    ));
                }else{

                    $template = new Template;

                    $templateName = Input::get('category').'_'.Input::get('name');
                    $path_to_file = 'public/imagenes/templates/'.$templateName.'/';
                    $path_to_call = '../imagenes/templates/'.$templateName.'/';
                    $filename = 'thumbnail.jpg';
                    $upload_success = Input::file('thumbnail')->move($path_to_file, $filename);

                    if( $upload_success ) {

                        $template->name = Input::get('name');
                        $template->category = Input::get('category');
                        $template->content = Input::get('content');
                        $template->thumbnail = $path_to_call.$filename;
                        $template->save();

                        
                    }else{
                        return Response::json(array(
                            'status'    => 'error'
                        ));
                    }

 
                }


                
            }

            return Response::json(array(
                'status' => 'ok',
                'route'  => route('admin/subir_imagenes', $template->id)
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function form_subir_imagenes($id) {
        $template = Template::find($id);
        $imagenes = Helpers::extraer_imagenes($template);

        return View::make('admin/subir_imagenes', array(
            'template' => $template,
            'imagenes' => $imagenes
        ));
    }

    public function subir_imagenes() {
        $template = Template::find(Input::get('id'));
        $templateName = $template->category.'_'.$template->name;
        $imagenes = Helpers::extraer_imagenes($template);

        $data = Input::all();
        $rules = array();
        $messages = array();
        foreach($imagenes as $imagen) {
            $aux = str_replace('.', '_', $imagen);
            $rules[$aux] = 'required';
            $messages["$aux.required"] = "Falta elegir el archivo de $imagen";
        }

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            foreach($imagenes as $imagen) {
                $aux = str_replace('.', '_', $imagen);
                $archivo = Input::file($aux)->getClientOriginalName();
                Input::file($aux)->move(storage_path("templates/".$templateName."/img"), $archivo);
            }

            return Response::json(array(
                'status' => 'ok',
                'route'  => route('admin/templates')
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function eliminar() {
        // Template::destroy(Input::get('id'));
    }

}