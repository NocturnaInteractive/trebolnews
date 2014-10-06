<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearUsuarios extends Migration {

    public function up() {
        Schema::create('usuarios', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique()->nullable();
            $table->string('password', 60);
            $table->string('remember_token', 100)->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono')->nullable();
            $table->text('empresa')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('pais')->nullable();
            $table->bigInteger('fb_id')->unsigned()->nullable();
            $table->string('confirmation')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->string('recuperar');
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('usuarios');
    }

}
