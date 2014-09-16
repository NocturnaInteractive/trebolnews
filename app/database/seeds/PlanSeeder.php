<?php

class PlanSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		Plan::create(array(
			'id' => 1,
			'nombre' => 'Plan de 2500 Envios',
			'precio' => 29.95,
			'isConcurrent' => false
		));

		Plan::create(array(
			'id' => 2,
			'nombre' => 'Suscripcion de 2500 Envios Mensuales',
			'precio' => 19.95,
			'isConcurrent' => true
		));
	}

}