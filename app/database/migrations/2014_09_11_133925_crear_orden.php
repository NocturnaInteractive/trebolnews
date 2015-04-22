<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearOrden extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordenes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('id_usuario')->unsigned();
			$table->integer('id_plan')->unsigned();
			$table->boolean('isSuscription');
			$table->decimal('monto',7,2);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ordenes');
	}

}
