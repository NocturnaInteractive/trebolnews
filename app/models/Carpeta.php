<?php

class Carpeta extends Eloquent {

	protected $table = 'carpetas';
	protected $softDelete = true;

	protected $fillable = array('id_usuario', 'nombre');

	public function usuario() {
		return $this->belongsTo('Usuario', 'id_usuario', 'id');
	}

	public function imagenes() {
		return $this->hasMany('Imagen', 'id_carpeta', 'id');
	}

}