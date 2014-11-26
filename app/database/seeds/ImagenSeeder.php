<?php

class ImagenSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Telefonista', 		'archivo' => 'img/libreria/libreriaimg1.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Conferencia', 		'archivo' => 'img/libreria/libreriaimg2.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Saludo amistoso', 	'archivo' => 'img/libreria/libreriaimg3.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Email', 			'archivo' => 'img/libreria/libreriaimg4.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Reunión', 			'archivo' => 'img/libreria/libreriaimg5.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'img/libreria/libreriaimg6.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'img/libreria/libreriaimg7.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'img/libreria/libreriaimg8.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'img/libreria/libreriaimg9.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'img/libreria/libreriaimg10.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'img/libreria/libreriaimg11.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'img/libreria/libreriaimg12.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'img/libreria/libreriaimg13.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'img/libreria/libreriaimg14.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'img/libreria/libreriaimg15.jpg'));
	}

}