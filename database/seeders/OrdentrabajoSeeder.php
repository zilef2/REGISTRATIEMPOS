<?php

namespace Database\Seeders;

use App\Models\Ordentrabajo;
use Illuminate\Database\Seeder;

class OrdentrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $palabraClave = 'Orden de Trabajo';
        $limite = 10;
        for ($i=0; $i < $limite; $i++) { 
            Ordentrabajo::create([
                'nombre' => $palabraClave.rand(10,10000),
                'codigo' => rand(10,10000)
             ]);
        }
        // Ordentrabajo::create([ 'nombre' => $palabraClave.rand(10,10000) ]);
    }
}