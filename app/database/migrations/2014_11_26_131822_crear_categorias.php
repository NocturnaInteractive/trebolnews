<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearCategorias extends Migration {

    public function up() {
        Schema::create('categorias', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('categorias');
    }

}
