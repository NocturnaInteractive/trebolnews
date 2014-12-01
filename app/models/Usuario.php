<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

    protected $table = 'usuarios';

    protected $hidden = array('password');

    protected $fillable = array(
        'email',
        'password',
        'nombre',
        'apellido',
        'telefono',
        'empresa',
        'ciudad',
        'pais',
        'fb_id',
        'confirmation',
        'confirmed',
        'newsletter'
    );

    protected $dates = array('last_login');

    public function listas() {
        return $this->hasMany('Lista', 'id_usuario', 'id');
    }

    public function carpetas() {
        return $this->hasMany('Carpeta', 'id_usuario', 'id');
    }

    public function carpeta_basura() {
        return $this->carpetas()->where('nombre', '=', 'basura')->first();
    }

    public function carpeta_mis_imagenes() {
        return $this->carpetas()->where('nombre', '=', 'mis_imagenes')->first();
    }

    public function imagenes() {
        return $this->hasManyThrough('Imagen', 'Carpeta', 'id_usuario', 'id_carpeta');
    }

    public function campanias() {
        return $this->hasMany('Campania', 'id_usuario', 'id');
    }

    public function preferences() {
        if(!empty($this->preferences)) {
            return json_decode($this->preferences);
        } else {
            return (object) array();
        }
    }

    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthPassword() {
        return $this->password;
    }

    public function getRememberToken() {
        return $this->remember_token;
    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }

    public function getReminderEmail() {
        return $this->email;
    }

}
