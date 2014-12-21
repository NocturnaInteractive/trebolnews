<?php

class ContactoSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		Contacto::create(array(
			'id' => 1,
			'id_lista' => 1,
			'nombre' => 'Aníbal',
			'apellido' => 'Moriconi',
			'email' => 'el.marto.mail@gmail.com',
			'puesto' => 'Dueño',
			'empresa' => 'Moriconi S.A.',
			'pais' => 'Argentina'
		));

		Contacto::create(array(
			'id' => 2,
			'id_lista' => 1,
			'nombre' => 'Mario',
			'apellido' => 'Salesi',
			'email' => 'msalesi@gmail.com',
			'puesto' => 'Cadete',
			'empresa' => 'Salesi S.R.L.',
			'pais' => 'Argentina'
		));
	}

}