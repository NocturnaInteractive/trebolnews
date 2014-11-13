<?php

class PlanSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		/******************
			INDIVIDUALES
		******************/
		Plan::create(array(
			'id' => 1,
			'nombre' => 'Plan de 1000 Envios',
			'precio' => 9.99,
			'envios' => 2500,
			'isSuscription' => false
		));

		Plan::create(array(
			'id' => 2,
			'nombre' => 'Plan de 1500 Envios',
			'precio' => 14.99,
			'envios' => 5000,
			'isSuscription' => false
		));

		Plan::create(array(
			'id' => 3,
			'nombre' => 'Plan de 2500 Envios',
			'precio' => 29.99,
			'envios' => 10000,
			'isSuscription' => false
		));

		Plan::create(array(
			'id' => 4,
			'nombre' => 'Plan de 5000 Envios',
			'precio' => 49.99,
			'envios' => 25000,
			'isSuscription' => false
		));

		Plan::create(array(
			'id' => 5,
			'nombre' => 'Plan de 10000 Envios',
			'precio' => 84.99,
			'envios' => 50000,
			'isSuscription' => false
		));

		Plan::create(array(
			'id' => 6,
			'nombre' => 'Plan de 20000 Envios',
			'precio' => 149.99,
			'envios' => 100000,
			'isSuscription' => false
		));

		Plan::create(array(
			'id' => 7,
			'nombre' => 'Plan de 50000 Envios',
			'precio' => 334.99,
			'envios' => 100000,
			'isSuscription' => false
		));

		Plan::create(array(
			'id' => 8,
			'nombre' => 'Plan de 100000 Envios',
			'precio' => 439.99,
			'envios' => 100000,
			'isSuscription' => false
		));

		/******************
			  MENSUALES
		******************/
		Plan::create(array(
			'id' => 9,
			'nombre' => 'Suscripcion de 1500 Envios',
			'precio' => 14.99,
			'envios' => 1500,
			'isSuscription' => true
		));

		Plan::create(array(
			'id' => 10,
			'nombre' => 'Suscripcion de 2500 Envios',
			'precio' => 29.99,
			'envios' => 2500,
			'isSuscription' => true
		));

		Plan::create(array(
			'id' => 11,
			'nombre' => 'Suscripcion de 5000 Envios',
			'precio' => 49.99,
			'envios' => 5000,
			'isSuscription' => true
		));

		Plan::create(array(
			'id' => 12,
			'nombre' => 'Suscripcion de 10000 Envios',
			'precio' => 84.99,
			'envios' => 10000,
			'isSuscription' => true
		));

		Plan::create(array(
			'id' => 13,
			'nombre' => 'Suscripcion de 20000 Envios',
			'precio' => 149.99,
			'envios' => 20000,
			'isSuscription' => true
		));

		Plan::create(array(
			'id' => 14,
			'nombre' => 'Suscripcion de 50000 Envios',
			'precio' => 334.99,
			'envios' => 50000,
			'isSuscription' => true
		));

		Plan::create(array(
			'id' => 15,
			'nombre' => 'Suscripcion de 100000 Envios',
			'precio' => 439.99,
			'envios' => 100000,
			'isSuscription' => true
		));

		Plan::create(array(
			'id' => 16,
			'nombre' => 'Suscripcion de 200000 Envios',
			'precio' => 599.99,
			'envios' => 200000,
			'isSuscription' => true
		));

		Plan::create(array(
			'id' => 17,
			'nombre' => 'Suscripcion de 300000 Envios',
			'precio' => 779.99,
			'envios' => 300000,
			'isSuscription' => true
		));

		Plan::create(array(
			'id' => 18,
			'nombre' => 'Suscripcion de 400000 Envios',
			'precio' => 879.99,
			'envios' => 400000,
			'isSuscription' => true
		));

		Plan::create(array(
			'id' => 19,
			'nombre' => 'Suscripcion de 500000 Envios',
			'precio' => 949.99,
			'envios' => 500000,
			'isSuscription' => true
		));


	}

}