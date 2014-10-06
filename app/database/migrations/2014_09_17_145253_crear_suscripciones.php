<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearSuscripciones extends Migration {

    public function up() {
        Schema::create('suscripciones', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('email');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('suscripciones');
    }

}
