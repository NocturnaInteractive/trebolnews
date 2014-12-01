<?php

class ImagenSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();

        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Telefonista',     'archivo' => 'img/libreria/libreriaimg1.jpg',  'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Conferencia',     'archivo' => 'img/libreria/libreriaimg2.jpg',  'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Saludo amistoso', 'archivo' => 'img/libreria/libreriaimg3.jpg',  'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Email',           'archivo' => 'img/libreria/libreriaimg4.jpg',  'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Reunión',         'archivo' => 'img/libreria/libreriaimg5.jpg',  'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción',     'archivo' => 'img/libreria/libreriaimg6.jpg',  'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción',     'archivo' => 'img/libreria/libreriaimg7.jpg',  'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción',     'archivo' => 'img/libreria/libreriaimg8.jpg',  'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción',     'archivo' => 'img/libreria/libreriaimg9.jpg',  'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción',     'archivo' => 'img/libreria/libreriaimg10.jpg', 'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción',     'archivo' => 'img/libreria/libreriaimg11.jpg', 'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción',     'archivo' => 'img/libreria/libreriaimg12.jpg', 'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción',     'archivo' => 'img/libreria/libreriaimg13.jpg', 'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción',     'archivo' => 'img/libreria/libreriaimg14.jpg', 'id_categoria' => 1));
        Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción',     'archivo' => 'img/libreria/libreriaimg15.jpg', 'id_categoria' => 1));
    }

}
