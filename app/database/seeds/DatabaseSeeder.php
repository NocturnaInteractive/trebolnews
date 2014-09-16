<?php

class DatabaseSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		$this->call('UsuarioSeeder');
		$this->call('CarpetaSeeder');
		$this->call('ImagenSeeder');
		$this->call('ListaSeeder');
		$this->call('ContactoSeeder');
		$this->call('PlanSeeder');
	}

}