<?php

class Categoria extends Eloquent {

    protected $table = 'categorias';
    protected $softDelete = true;

    protected $fillable = array('nombre', 'descripcion');

    public function imagenes() {
        return $this->hasMany('Imagen', 'id_categoria', 'id');
    }

}
