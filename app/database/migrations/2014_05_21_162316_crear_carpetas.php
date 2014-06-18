<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearCarpetas extends Migration {

	public function up() {
		Schema::create('carpetas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_usuario')->unsigned();
			$table->string('nombre');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down() {
		Schema::drop('carpetas');
	}

}