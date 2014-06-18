<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearImagenes extends Migration {

	public function up() {
		Schema::create('imagenes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_carpeta')->unsigned();
			$table->string('nombre');
			$table->string('archivo');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down() {
		Schema::drop('imagenes');
	}

}