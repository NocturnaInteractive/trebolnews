<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTemplates extends Migration {

	public function up() {
		Schema::create('templates', function(Blueprint $table) {
			$table->increments('id');
			$table->string('category');
			$table->string('name');
			$table->text('content');
			$table->text('thumbnail');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down() {
		Schema::drop('templates');
	}

}