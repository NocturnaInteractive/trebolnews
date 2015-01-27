<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearCampanias extends Migration {

	public function up() {
		Schema::create('campanias', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_usuario')->unsigned();
			$table->integer('social_link_id')->unsigned();
			$table->string('tipo');
			$table->string('subtipo');
			$table->string('nombre');
			$table->string('asunto');
			$table->string('remitente');
			$table->string('email');
			$table->string('respuesta');
			$table->text('contenido')->nullable();
			$table->string('redes')->nullable();
			$table->string('status');
			$table->string('envio');
			$table->timestamp('programacion')->nullable();
			$table->boolean('notificacion');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down() {
		Schema::drop('campanias');
	}

}