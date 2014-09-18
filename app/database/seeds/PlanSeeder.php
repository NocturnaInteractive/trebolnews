<?php

class PlanSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		/******************
			INDIVIDUALES
		******************/
		Plan::create(array(
			'id' => 1,
			'nombre' => 'Plan de 2500 Envios',
			'precio' => 29.95,
			'envios' => 2500,
			'isConcurrent' => false
		));

		Plan::create(array(
			'id' => 2,
			'nombre' => 'Plan de 5000 Envios',
			'precio' => 49.95,
			'envios' => 5000,
			'isConcurrent' => false
		));

		Plan::create(array(
			'id' => 3,
			'nombre' => 'Plan de 10000 Envios',
			'precio' => 69.95,
			'envios' => 10000,
			'isConcurrent' => false
		));

		Plan::create(array(
			'id' => 4,
			'nombre' => 'Plan de 25000 Envios',
			'precio' => 79.95,
			'envios' => 25000,
			'isConcurrent' => false
		));

		Plan::create(array(
			'id' => 5,
			'nombre' => 'Plan de 50000 Envios',
			'precio' => 99.95,
			'envios' => 50000,
			'isConcurrent' => false
		));

		Plan::create(array(
			'id' => 6,
			'nombre' => 'Plan de 100000 Envios',
			'precio' => 129.95,
			'envios' => 100000,
			'isConcurrent' => false
		));

		/******************
			  MENSUALES
		******************/
		Plan::create(array(
			'id' => 7,
			'nombre' => 'Suscripcion de 2500 Envios',
			'precio' => 29.95,
			'envios' => 2500,
			'isConcurrent' => true
		));

		Plan::create(array(
			'id' => 8,
			'nombre' => 'Suscripcion de 5000 Envios',
			'precio' => 49.95,
			'envios' => 5000,
			'isConcurrent' => true
		));

		Plan::create(array(
			'id' => 9,
			'nombre' => 'Suscripcion de 10000 Envios',
			'precio' => 69.95,
			'envios' => 10000,
			'isConcurrent' => true
		));

		Plan::create(array(
			'id' => 10,
			'nombre' => 'Suscripcion de 25000 Envios',
			'precio' => 79.95,
			'envios' => 25000,
			'isConcurrent' => true
		));

		Plan::create(array(
			'id' => 11,
			'nombre' => 'Suscripcion de 50000 Envios',
			'precio' => 99.95,
			'envios' => 50000,
			'isConcurrent' => true
		));

		Plan::create(array(
			'id' => 12,
			'nombre' => 'Suscripcion de 100000 Envios',
			'precio' => 129.95,
			'envios' => 100000,
			'isConcurrent' => true
		));


	}

}