<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearUsuarios extends Migration {

	public function up() {
		Schema::create('usuarios', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email')->unique()->nullable();
			$table->string('password', 60);
			$table->string('remember_token', 100);
			$table->string('nombre');
			$table->string('apellido');
			$table->string('telefono');
			$table->string('empresa');
			$table->string('ciudad');
			$table->string('pais');
			$table->bigInteger('fb_id')->unsigned()->nullable();
			$table->string('confirmation')->nullable();
			$table->boolean('confirmed')->default(false);
			$table->boolean('newsletter');
			$table->timestamp('last_login');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down() {
		Schema::drop('usuarios');
	}

}