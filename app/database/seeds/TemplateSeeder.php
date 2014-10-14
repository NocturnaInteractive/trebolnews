<?php

class TemplateSeeder extends Seeder {

	public function run() {
		Eloquent::unguard();

		Template::create(array(
			'id' => 1,
			'category' => 'basicos',
			'name' => 'Classic',
			'thumbnail' => '../imagenes/templates/1/thumbnail.png',
			'content' => '
				<style>
					.wrapper{
						font-family: arial;
						background-color: #CECECE;
					}
				</style>

				<div class="wrapper">
					<h1>Classic Newsletter</h1>
					<p>Estimado <strong>%%suscriptor.name%%</strong>,</p>
					<p>Le deseamos felices fiestas</p>
				</div>'
		));

		Template::create(array(
			'id' => 2,
			'category' => 'basicos',
			'name' => 'Modern',
			'thumbnail' => '../imagenes/templates/2/thumbnail.png',
			'content' => '
				<style>
					.wrapper{
						font-family: arial;
						background-color: #CECECE;
					}
				</style>

				<div class="wrapper">
					<h1>Modern Newsletter</h1>
					<p>Hey, <strong>%%suscriptor.name%%</strong>,</p>
					<p>Felices fiestas</p>
				</div>'
		));

		
	}

}