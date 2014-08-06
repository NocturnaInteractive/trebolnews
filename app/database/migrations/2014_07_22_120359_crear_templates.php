<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTemplates extends Migration {

	public function up() {
		Schema::create('templates', function(Blueprint $table) {
			$table->increments('id');
			$table->string('categoria');
			$table->string('nombre');
			$table->string('archivo')->unique();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down() {
		Schema::drop('templates');
	}

}