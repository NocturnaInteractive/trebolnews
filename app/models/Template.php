<?php

class Template extends Eloquent {

    protected $table = 'templates';
    protected $softDelete = true;

    protected $fillable = array(
        'categoria',
        'nombre',
        'archivo'
    );

}