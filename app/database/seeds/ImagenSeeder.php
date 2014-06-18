<?php

class ImagenSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Telefonista', 		'archivo' => 'libreriaimg1.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Conferencia', 		'archivo' => 'libreriaimg2.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Saludo amistoso', 	'archivo' => 'libreriaimg3.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Email', 			'archivo' => 'libreriaimg4.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Reunión', 			'archivo' => 'libreriaimg5.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'libreriaimg6.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'libreriaimg7.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'libreriaimg8.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'libreriaimg9.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'libreriaimg10.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'libreriaimg11.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'libreriaimg12.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'libreriaimg13.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'libreriaimg14.jpg'));
		Imagen::create(array('id_carpeta' => 1, 'nombre' => 'Descripción', 		'archivo' => 'libreriaimg15.jpg'));
	}

}