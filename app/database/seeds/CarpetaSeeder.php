<?php

class CarpetaSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();

        Carpeta::create(array(
            'id'          => 1,
            'nombre'      => 'banco',
            'descripcion' => 'banco de imágenes'
        ));

        Carpeta::create(array(
            'id_usuario'  => 1,
            'nombre'      => 'basura',
            'descripcion' => 'basura'
        ));

        Carpeta::create(array(
            'id_usuario'  => 1,
            'nombre'      => 'mis_imagenes',
            'descripcion' => 'mis imágenes'
        ));

        Carpeta::create(array(
            'id_usuario'  => 2,
            'nombre'      => 'basura',
            'descripcion' => 'basura'
        ));

        Carpeta::create(array(
            'id_usuario'  => 2,
            'nombre'      => 'mis_imagenes',
            'descripcion' => 'mis imágenes'
        ));
    }

}
