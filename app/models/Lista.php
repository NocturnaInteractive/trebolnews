<?php

class Lista extends Eloquent {

    protected $table = 'listas';
    protected $softDelete = true;

    protected $fillable = array('id_usuario', 'nombre');

    public function contactos() {
        return $this->hasMany('Contacto', 'id_lista', 'id');
    }

    public function usuario() {
        return $this->belongsTo('Usuario', 'id_usuario', 'id');
    }

    public function campanias() {
        return $this->belongsToMany('Campania', 'campanias_listas', 'id_lista', 'id_campania');
    }

}
