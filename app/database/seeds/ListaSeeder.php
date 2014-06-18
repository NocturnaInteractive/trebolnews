<?php

class ListaSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		Lista::create(array('id' => 1, 'id_usuario' => 2, 'nombre' => 'La primera lista'));
		Lista::create(array('id' => 2, 'id_usuario' => 2, 'nombre' => 'La segunda lista'));
	}

}