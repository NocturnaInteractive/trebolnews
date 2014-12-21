<?php

class DatabaseSeeder extends Seeder {

    public function run() {
        Eloquent::unguard();

        $this->call('UsuarioSeeder');
        $this->call('CarpetaSeeder');
        $this->call('CategoriaSeeder');
        $this->call('ImagenSeeder');
        $this->call('ListaSeeder');
        $this->call('SuscripcionSeeder');
        $this->call('ContactoSeeder');
        $this->call('PlanSeeder');
        $this->call('TemplateSeeder');
        $this->call('ConfSeeder');
    }

}
