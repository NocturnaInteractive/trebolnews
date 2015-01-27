<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLinks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('social_links', function(Blueprint $table) {
			$table->increments('id');
			$table->string('facebook')->default('');
			$table->string('twitter')->default('');
			$table->string('linkedin')->default('');
			$table->string('googleplus')->default('');
			$table->string('pinterest')->default('');
			$table->string('blogger')->default('');
			$table->string('meneame')->default('');
			$table->string('tumblr')->default('');
			$table->string('reddit')->default('');
			$table->string('digg')->default('');
			$table->string('delicious')->default('');
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
		Schema::drop('social_links');
	}

}