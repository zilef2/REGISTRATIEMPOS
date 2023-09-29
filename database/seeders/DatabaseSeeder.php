<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            ParametroSeeder::class,

            PermissionSeeder::class,
            RoleSeeder::class,
            CentroTrabajoSeeder::class,

            UserSeeder::class,
            ActividadSeeder::class,
            // MaterialSeeder::class,
            OrdentrabajoSeeder::class,
            // PiezaSeeder::class,
            DisponibilidadSeeder::class,
            ReprocesoSeeder::class,

        ]);
        // Ejercicio::create(['nombre' => 'la funcion x^2 es continua? en que region?', 'descripcion' => 'descripcion generica', 'subtopico_id' => 2]);
    }
}
