<?php

class ConfSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();

        Conf::create(array(
            'nombre' => 'E-mail a donde llegan los comentarios',
            'clave'  => 'email_comentarios',
            'valor'  => 'maimar@gmail.com'
        ));
    }

}
