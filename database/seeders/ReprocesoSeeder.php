<?php

namespace Database\Seeders;

use App\Models\Reproceso;
use Illuminate\Database\Seeder;

class ReprocesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $palabraClave = 'Reproceso ';
        $limite = intval(env('seedersNumber'));
        for ($i = 0; $i < $limite; $i++) {
            Reproceso::create([
                'nombre' => $palabraClave . rand(10, 10000),
                'codigo' => rand(10, 10000)
            ]);
        }
        // Reproceso::create([ 'nombre' => 'centro'.rand(10,10000), ]);
    }
}
