<?php

class Contacto extends Eloquent {

	protected $table = 'contactos';
	protected $softDelete = true;

	protected $fillable = array('id_lista', 'nombre', 'apellido', 'email', 'puesto', 'empresa', 'pais');

	public function lista() {
		return $this->belongsTo('Lista', 'id_lista', 'id');
	}

}