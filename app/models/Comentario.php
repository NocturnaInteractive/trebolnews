<?php

class Comentario extends Eloquent {

    protected $table = 'comentarios';

    protected $fillable = array('nombre', 'apellido', 'telefono', 'empresa', 'email', 'comentario');

}
