<?php

class UsuarioSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		Usuario::create(array(
			'id' => 1,
			'email' => 'maimar@gmail.com',
			'password' => Hash::make('maimar'),
			'confirmed' => 1,
			'availableMails' => 5000,
			'suscriptionType' => 'member',
			'nombre' => 'Martín',
			'apellido' => 'Aimar'
		));

		Usuario::create(array(
			'id' => 2,
			'email' => 'usuario@gmail.com',
			'password' => Hash::make('usuario'),
			'confirmed' => 1,
			'availableMails' => 500,
			'suscriptionType' => 'free',
			'nombre' => 'Usuario',
			'apellido' => 'Test'
		));
	}

}