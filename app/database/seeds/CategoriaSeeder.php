<?php

class CategoriaSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();

        Categoria::create(array(
            'nombre'      => 'artes',
            'descripcion' => 'artes'
        ));

        Categoria::create(array(
            'nombre'      => 'gastronomia',
            'descripcion' => 'gastronomía'
        ));

        Categoria::create(array(
            'nombre'      => 'hotel',
            'descripcion' => 'hotel'
        ));

        Categoria::create(array(
            'nombre'      => 'personas',
            'descripcion' => 'personas'
        ));

        Categoria::create(array(
            'nombre'      => 'tecnologia',
            'descripcion' => 'tecnología'
        ));

        Categoria::create(array(
            'nombre'      => 'turismo',
            'descripcion' => 'turismo'
        ));
    }

}
