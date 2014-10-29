<?php

class CarpetaSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		Carpeta::create(array(
			'id' => 1,
			'nombre' => 'imágenes'
		));

		Carpeta::create(array(
			'id_usuario' => 1,
			'nombre' => 'basura'
		));

		Carpeta::create(array(
			'id_usuario' => 2,
			'nombre' => 'basura'
		));
	}

}