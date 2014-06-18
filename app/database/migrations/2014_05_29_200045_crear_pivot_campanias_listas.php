<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearPivotCampaniasListas extends Migration {

	public function up() {
		Schema::create('campanias_listas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_campania')->unsigned();
			$table->integer('id_lista')->unsigned();
		});
	}

	public function down() {
		Schema::drop('campanias_listas');
	}

}