<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearComentarios extends Migration {

    public function up() {
        Schema::create('comentarios', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono')->nullable();
            $table->string('empresa')->nullable();
            $table->string('email');
            $table->text('comentario');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('comentarios');
    }

}
