<?php

class CampaniaController extends BaseController {

    public function guardar_campania() {
        $data = Input::all();

        $rules = array();
        $messages = array();

        switch(Input::get('paso')) {
            case '3':
                $rules = array_merge($rules, $rules = array(
                    'campania:nombre'       => 'required',
                    'campania:asunto'       => 'required',
                    'campania:remitente'    => 'required',
                    'campania:email'        => 'required|email',
                    'campania:respuesta'    => 'required|email',
                    'campania:listas'       => 'required_if:con_listas,on',
                    'campania:redes'        => 'required_if:compartir,on',
                    'fecha'                 => 'required_if:campania:envio,programado',
                    'hora'                  => 'required_if:campania:envio,programado'
                ));

                $messages = array_merge($messages, $messages = array(
                    'campania:nombre.required'      => 'Falta completar el nombre',
                    'campania:asunto.required'      => 'Falta completar el asunto',
                    'campania:remitente.required'   => 'Falta completar el remitente',
                    'campania:email.required'       => 'Falta completar el email',
                    'campania:email.email'          => 'El email debe ser válido',
                    'campania:respuesta.required'   => 'Falta completar la dirección de respuesta',
                    'campania:respuesta.email'      => 'La dirección de respuesta debe ser un email válido',
                    'campania:listas.required_if'   => 'Es necesario elegir al menos una lista de contactos',
                    'campania:redes.required_if'    => 'Ha elegido compartir en redes sociales pero ninguna red',
                    'fecha.required_if'             => 'Es obligatorio ingresar la fecha para la programación del envío',
                    'hora.required_if'              => 'Es obligatorio ingresar la hora para la programación del envío'
                ));

                switch(Session::get('campania.tipo')) {
                    case 'clasica':
                        $rules = array_merge($rules, array(

                        ));

                        $messages = array_merge($messages, array(

                        ));

                        break;

                    case 'social':
                        $rules = array_merge($rules, array(

                        ));

                        $messages = array_merge($messages, array(

                        ));

                        break;
                }

                break;

            case '4':
                /*
                $rules = array_merge($rules, array(

                ));

                $messages = array_merge($messages, array(

                ));
                */
                
                switch(Session::get('campania.subtipo')) {
                    case 'blanco':
                        $rules = array_merge($rules, array(
                            'campania:contenido' => 'required'
                        ));

                        $messages = array_merge($messages, array(
                            'campania:contenido.required' => 'Es necesario cargar un contenido'
                        ));

                        break;

                    case 'template':
                        $rules = array_merge($rules, array(

                        ));

                        $messages = array_merge($messages, array(

                        ));

                        break;

                    case 'html':
                        $rules = array_merge($rules, array(
                            'campania:contenido' => 'required'
                        ));

                        $messages = array_merge($messages, array(
                            'campania:contenido.required' => 'Es necesario cargar un contenido'
                        ));

                        break;
                }

                break;
        }

        $validator = Validator::make($data, $rules, $messages);


        /******************
            IF VALID OK
        *******************/
        if($validator->passes()) {
            foreach(Input::all() as $key => $value) {
                Session::put(str_replace(':', '.', $key), $value);
            }

            switch(Input::get('y')) {
                case 'salir':
                    // se guarda como borrador
                    $campania = $this->getCampaignCreated();

                    $listas = Auth::user()->listas()->has('contactos', '>', '0')->get();
                    if(count($listas) > 0) {
                        foreach(Session::get('campania.listas') as $id_lista) {
                            $campania->listas()->attach($id_lista);
                        }
                    }

                    Session::forget('campania');

                    return Response::json(array(
                        'status' => 'ok'
                    ));

                    break;

                case 'seguir':
                    // sólo guarda en la sesión

                    return Response::json(array(
                        'status' => 'ok'
                    ));

                    break;

                case 'confirmar':
                    // envía los mails o asigna status 'programada'

                    $campania = $this->getCampaignCreated();

                    switch($campania->envio) {
                        case 'inmediato':
                            // enviar los mails

                            foreach($campania->listas as $lista) {
                                foreach($lista->contactos as $contacto) {
                                    Mail::send('emails/prueba', array(
                                        'contenido' => $campania->contenido
                                    ), function($mail) use($campania, $contacto) {
                                        $mail->to($contacto->email, "{$contacto->nombre} {$contacto->apellido}")
                                            ->subject($campania->asunto)
                                            ->from($campania->email, $campania->remitente)
                                            ->replyTo($campania->respuesta);
                                    });
                                }
                            }

                            $campania->status = 'enviada';
                            $campania->save();

                            break;

                        case 'programado':
                            $campania->status = 'programada';
                            $campania->save();

                            break;
                    }

                    Session::forget('campania');

                    return Response::json(array(
                        'status' => 'ok'
                    ));

                    break;

            }
        } else {
            return Response::json(array(
                'status' => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    private function getCampaignCreated() {
        if(Input::has('id_campania')) {
            $campania = Campania::find(Input::get('id_campania'));
        } else {
            $campania = Campania::create(array(
                'id_usuario'    => Auth::user()->id,
                'tipo'          => Session::get('campania.tipo'),
                'subtipo'       => Session::get('campania.subtipo'),
                'nombre'        => Session::get('campania.nombre'),
                'asunto'        => Session::get('campania.asunto'),
                'remitente'     => Session::get('campania.remitente'),
                'email'         => Session::get('campania.email'),
                'respuesta'     => Session::get('campania.respuesta'),
                'contenido'     => Session::get('campania.contenido'),
                'redes'         => Session::get('campania.redes') ? json_encode(Session::get('campania.redes')) : null,
                'status'        => 'borrador',
                'envio'         => Session::get('campania.envio'),
                'programacion'  => Session::get('campania.envio') == 'programado' ? Carbon::createFromFormat('d/m/Y H:i', Session::get('fecha') . ' ' . Session::get('hora')) : null,
                'notificacion'  => Session::get('campania.notificacion') == 'on' ? true : false
            ));
            
            $listas = Session::get('campania.listas');
            if(isset($listas)){
                foreach($listas as $id_lista) {
                    $campania->listas()->attach($id_lista);
                }    
            }
            
        }
        return $campania;
    }

    public function campania($id) {
        $campania = Campania::find($id);

        if(isset($campania)){
            Session::put('campania.id', $campania->id );
            Session::put('campania.tipo', $campania->tipo );
            Session::put('campania.subtipo', $campania->subtipo);
            Session::put('campania.nombre', $campania->nombre);
            Session::put('campania.asunto', $campania->asunto);
            Session::put('campania.remitente', $campania->remitente);
            Session::put('campania.email', $campania->email);
            Session::put('campania.respuesta', $campania->respuesta);
            Session::put('campania.contenido', $campania->contenido);
            Session::put('campania.redes', $campania->redes);
            Session::put('campania.envio', $campania->envio);
            Session::put('campania.notificacion', $campania->notificacion);
        }

        if(Auth::user()->id == $campania->id_usuario) {
            switch($campania->tipo) {
                case 'clasica':
                    return View::make('campaigns/new_campaign_step5', array(
                        'campania' => $campania
                    ));
                    break;

                case 'social':
                    return View::make('internas/ver_campaniasocial_paso5', array(
                        'campania' => $campania
                    ));
                    break;
            }
        } else {
            return Redirect::to('/');
        }
    }

    public function eliminar_campania($id) {
        $campania = Campania::find($id);

        if(Auth::user()->id == $campania->id_usuario) {
            Campania::destroy($id);

            return Response::json(array(
                'status' => 'ok'
            ));
        } else {
            return Response::json(array(
                'status' => 'error'
            ));
        }
    }

    public function reestablecer($id) {
        $campania = Campania::withTrashed()->find($id);

        if($campania->trashed()) {
            $campania->restore();
        }

        return Redirect::to(URL::previous());
    }

}