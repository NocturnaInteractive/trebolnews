<?php

class UsuarioController extends BaseController {

    public function registrar() {
        $data = Input::all();

        $rules = array(
            'email'     => 'required|unique:usuarios',
            'password'  => 'required|confirmed',
            'tyc'       => 'accepted'
        );

        $messages = array(
            'email.required'     => 'Falta completar el e-mail',
            'email.unique'       => 'Ya hay un usuario registrado con esa dirección de e-mail',
            'password.required'  => 'Falta completar la contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'tyc.accepted'       => 'Es necesario aceptar los términos y condiciones'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            $usuario = Usuario::create(array(
                'email'        => Input::get('email'),
                'password'     => Hash::make(Input::get('password')),
                'newsletter'   => Input::get('newsletter') ? true : false,
                'confirmation' => sha1(Input::get('email')),
                // 'confirmed'    => true
            ));

            Event::fire('nuevo_registro', array($usuario));

            return Response::json(array(
                'status' => 'ok',
                'url'    => route('post_registro')
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function login() {
        $data = Input::all();

        $rules = array(
            'email'    => 'required|email',
            'password' => 'required'
        );

        $messages = array(
            'email.required'    => 'Ingrese un e-mail',
            'email.email'       => 'El e-mail no es válido',
            'password.required' => 'Ingrese la contraseña'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            $usuario = Usuario::where('email', '=', Input::get('email'))->first();

            if($usuario) {
                if(Auth::attempt(array(
                    'email'     => $usuario->email,
                    'password'  => Input::get('password'),
                    'confirmed' => true
                ), Input::get('recordar', 'no') == 'on' ? true : false)) {
                    Session::put('id_logueado', $usuario->id);

                    return Response::json(array(
                        'status' => 'ok'
                    ));
                } else {
                    if(Auth::validate(array(
                        'email'     => $usuario->email,
                        'password'  => Input::get('password')
                    ))) {
                        return Response::json(array(
                            'status'    => 'error',
                            'mensaje'   => 'La cuenta no está activada'
                        ));
                    } else {
                        return Response::json(array(
                            'status'    => 'error',
                            'mensaje'   => 'La contraseña es incorrecta'
                        ));
                    }
                }
            } else {
                return Response::json(array(
                    'status'    => 'error',
                    'mensaje'   => 'No hay un usuario con esa dirección'
                ));
            }
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    // public function login_con_fb() {
    //     $fb_id = Input::get('id');
    //     $usuario = Usuario::where('fb_id', '=', $fb_id)->first();

    //     if(!$usuario) {
    //         $usuario = Usuario::create(array(
    //             'nombre'    => Input::get('first_name'),
    //             'apellido'  => Input::get('last_name'),
    //             'fb_id'     => $fb_id
    //         ));
    //     }

    //     Session::put('id_logueado', $usuario->id);

    //     Auth::login($usuario);

    //     return Response::json(array(
    //         'status' => 'ok'
    //     ));
    // }

    public function editar_perfil() {
        $data = Input::all();

        $rules = array(
            'nombre'    => 'required',
            'apellido'  => 'required'
        );

        $messages = array(
            'nombre.required'   => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            $usuario = Auth::user();
            $usuario->nombre    = Input::get('nombre');
            $usuario->apellido  = Input::get('apellido');
            $usuario->telefono  = Input::get('telefono');
            $usuario->empresa   = Input::get('empresa');
            $usuario->ciudad    = Input::get('ciudad');
            $usuario->pais      = Input::get('pais');

            $usuario->save();

            return Response::json(array(
                'status'    => 'ok',
                'mensaje'   => 'Perfil guardado'
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function facebook_login() {
        $code = Input::get('code');

        $fb = OAuth::consumer('Facebook');

        if(!empty($code)) {
            $token = $fb->requestAccessToken($code);

            $result = json_decode($fb->request('/me'), true);

            $usuario = Usuario::where(array(
                'fb_id' => $result['id']
            ))->first();

            if(!$usuario) {
                $usuario = Usuario::create(array(
                    'email'     => $result['email'],
                    'fb_id'     => $result['id'],
                    'nombre'    => $result['first_name'],
                    'apellido'  => $result['last_name'],
                    'confirmed' => true
                ));

                Event::fire('nuevo_registro', array($usuario));
            }

            Auth::login($usuario);
            Session::put('fb_user', $usuario->id);

            $view = View::make('tfios/closer');

            return Response::make($view);
        } else {
            $url = $fb->getAuthorizationUri();

            return Redirect::to((string) $url . '&display=popup');
        }
    }

}
