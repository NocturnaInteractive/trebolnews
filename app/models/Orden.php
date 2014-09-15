<?php

class Orden extends Eloquent {

	protected $table = 'ordenes';
	protected $softDelete = true;

	protected $fillable = array('id_usuario', 'nombre');

	public function usuario() {
		return $this->belongsTo('Usuario', 'id_usuario', 'id');
	}

	public function plan() {
		return $this->belongsTo('Plan', 'id_plan', 'id');
	}

}