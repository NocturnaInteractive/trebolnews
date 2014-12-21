<?php

class SuscripcionSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		Suscripcion::create(array(
			'id' => 1,
			'email' => 'el.marto.mail@gmail.com',
			'nombre' => 'Mi Lista'
		));
	}

}