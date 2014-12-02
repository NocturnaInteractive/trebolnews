<?php

class Imagen extends Eloquent {

    use Illuminate\Database\Eloquent\SoftDeletingTrait;

    protected $table = 'imagenes';

    protected $dates = ['deleted_at'];

    protected $fillable = array('id_carpeta', 'nombre', 'archivo');

    public function carpeta() {
        return $this->belongsTo('Carpeta', 'id_carpeta', 'id');
    }

    public function categoria() {
        return $this->belongsTo('Categoria', 'id_categoria', 'id');
    }

}
