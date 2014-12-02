<?php

class UsuarioController extends BaseController {

    public function registrar() {
        $data = Input::all();

        $rules = array(
            'email'    => 'required|unique:usuarios',
            'password' => 'required|confirmed',
            'tyc'      => 'accepted'
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
                // 'newsletter'   => Input::get('newsletter') ? true : false,
                'confirmation' => sha1(Input::get('email')),
                // 'confirmed'    => true
            ));

            if(Input::get('newsletter')) {
                Suscripcion::create(array(
                    'email' => $usuario->email
                ));
            }

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

    public function facebook_login() {
        $code = Input::get('code');

        $fb = OAuth::consumer('Facebook');

        if(!empty($code)) {
            try {
                $token = $fb->requestAccessToken($code);
            } catch (TokenResponseException $e) {
                dd($e);
            }

            $result = json_decode($fb->request('/me'), true);

            $existe_fb    = Usuario::where('fb_id', '=', $result['id'])->first();
            $existe_email = Usuario::where('email', '=', $result['email'])->first();

            if(!$existe_fb && !$existe_email) { // no existe ninguno
                $usuario = Usuario::create(array(
                    'email'     => $result['email'],
                    'fb_id'     => $result['id'],
                    'nombre'    => $result['first_name'],
                    'apellido'  => $result['last_name'],
                    'confirmed' => true
                ));

                Event::fire('nuevo_registro', array($usuario));
            } else {
                if($existe_fb && !$existe_email) { // existe el de facebook
                    $usuario = $existe_fb;
                    $usuario->email = $result['email'];
                    $usuario->confirmed = true;
                    $usuario->save();
                } else if(!$existe_fb && $existe_email) { // existe el email
                    $usuario = $existe_email;
                    $usuario->fb_id = $result['id'];
                    $usuario->confirmed = true;
                    $usuario->save();
                } else { // existen los dos
                    $usuario = $existe_fb;
                }
            }

            Auth::login($usuario, true);

            $view = View::make('trebolnews/closer');

            return Response::make($view);
        } else {
            $url = $fb->getAuthorizationUri();

            return Redirect::to((string) $url . '&display=popup');
        }
    }

    public function pre_recuperar_password() {
        $email = Input::get('email');

        $usuario = Usuario::where('email', $email)->first();

        if($usuario) {
            $usuario->recuperar = Str::random();
            $usuario->save();

            Mail::send('emails.pre_recuperar_password', array(
                'usuario' => $usuario
            ), function($mail) use($email) {
                $mail->to($email);
                $mail->subject('Información para recuperar la contraseña de TrebolNEWS');
                $mail->from('no-responder@trebolnews.com', 'TrebolNEWS');
            });

            return Response::json(array(
                'status' => 'ok',
                'url' => route('recuperar_password_mail_enviado')
            ));
        } else {
            return Response::json(array(
                'status' => 'error',
                'mensaje' => 'No existe un usuario registrado con esa dirección'
            ));
        }
    }

    public function mostrar_form_recuperar_password($hash) {
        $usuario = Usuario::where('recuperar', $hash)->first();

        if($usuario) {
            return View::make('trebolnews.form_recuperar_password', array(
                'usuario' => $usuario
            ));
        } else {
            return Redirect::route('home');
        }
    }

    public function cambiar_password() {
        $data = Input::all();

        $rules = array(
            'password' => 'required|confirmed'
        );

        $messages = array(
            'password.required' => 'Escriba una contraseña',
            'password.confirmed' => 'Las contraseñas deben coincidir'
        );

        $validator = Validator::make($data, $rules, $messages);

        if($validator->passes()) {
            $usuario = Usuario::find(Input::get('usuario_id'));

            $usuario->password = Hash::make(Input::get('password'));
            $usuario->recuperar = null;
            $usuario->save();

            return Response::json(array(
                'status' => 'ok',
                'url' => route('password_cambiado')
            ));
        } else {
            return Response::json(array(
                'status' => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

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
            $usuario->ciudad    = Input::get('ciudad');
            $usuario->pais      = Input::get('pais');

            $empresa = array();

            $empresa['nombre']      = Input::get('empresa_nombre');
            $empresa['cuit']        = Input::get('empresa_cuit');
            $empresa['factura']     = Input::get('empresa_factura');
            $empresa['telefono']    = Input::get('empresa_telefono');
            $empresa['direccion']   = Input::get('empresa_direccion');
            $empresa['cp']          = Input::get('empresa_cp');
            $empresa['ciudad']      = Input::get('empresa_ciudad');
            $empresa['responsable'] = Input::get('empresa_responsable');
            $empresa['email']       = Input::get('empresa_email');

            $usuario->empresa = json_encode($empresa);

            $usuario->save();

            return Response::json(array(
                'status'  => 'ok',
                'mensaje' => 'Perfil guardado'
            ));
        } else {
            return Response::json(array(
                'status'    => 'error',
                'validator' => $validator->messages()->toArray()
            ));
        }
    }

    public function set_preference() {
        $preference = explode('.', Input::get('preference'));
        $key = $preference[0];
        $val = $preference[1];

        $preferences = Auth::user()->preferences();
        $preferences->$key = $val;

        Auth::user()->preferences = json_encode($preferences);
        Auth::user()->save();

        return Response::json(array(
            'status' => 'ok'
        ));
    }

}
