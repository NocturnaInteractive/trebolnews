<?php

class Imagen extends Eloquent {

    protected $table = 'imagenes';
    protected $softDelete = true;

    protected $fillable = array('id_carpeta', 'nombre', 'archivo');

    public function carpeta() {
        return $this->belongsTo('Carpeta', 'id_carpeta', 'id');
    }

    public function categoria() {
        return $this->belongsTo('Categoria', 'id_categoria', 'id');
    }

}
