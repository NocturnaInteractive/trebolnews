<?php

class Pago extends Eloquent {

	protected $table = 'pagos';
	protected $softDelete = true;

	public function usuario() {
		return $this->belongsTo('Usuario', 'id_usuario', 'id');
	}

	public function orden() {
		return $this->belongsTo('Plan', 'id_orden', 'id');
	}

}