<?php

class Campania extends Eloquent {

    protected $table = 'campanias';
    protected $softDelete = true;

    protected $fillable = array(
        'id_usuario',
        'tipo',
        'subtipo',
        'nombre',
        'asunto',
        'remitente',
        'email',
        'respuesta',
        'contenido',
        'redes',
        'status',
        'envio',
        'programacion',
        'notificacion'
    );

    protected $dates = array('programacion');

    public function usuario() {
        return $this->belongsTo('Usuario', 'id_usuario', 'id');
    }

    public function listas() {
     return $this->belongsToMany('Lista', 'campanias_listas', 'id_campania', 'id_lista');
    }

}
