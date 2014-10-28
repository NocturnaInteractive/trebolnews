<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearConf extends Migration {

    public function up() {
        Schema::create('conf', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('clave');
            $table->string('valor');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('conf');
    }

}
