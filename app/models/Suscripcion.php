<?php

class Suscripcion extends Eloquent {

    protected $table = 'suscripciones';
    protected $softDelete = true;

    protected $fillable = array('nombre', 'email');

}
