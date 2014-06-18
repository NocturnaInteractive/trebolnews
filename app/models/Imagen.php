<?php

class Imagen extends Eloquent {

	protected $table = 'imagenes';
	protected $softDelete = true;

	protected $fillable = array('id_carpeta', 'nombre');

	public function carpeta() {
		return $this->belongsTo('Carpeta', 'id_carpeta', 'id');
	}

}