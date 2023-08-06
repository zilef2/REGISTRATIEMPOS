<?php

namespace Database\Seeders;

use App\Models\Centrotrabajo;
use Illuminate\Database\Seeder;

class CentroTrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $palabraClave = 'Centro de Trabajo';
        $limite = intval(env('seedersNumber'));
        for ($i = 0; $i < $limite; $i++) {
            Centrotrabajo::create([
                'nombre' => $palabraClave . rand(10, 10000),
                'codigo' => rand(10, 10000)
            ]);
        }
        // Centrotrabajo::create([ 'nombre' => 'centro'.rand(10,10000), ]);
    }
}
