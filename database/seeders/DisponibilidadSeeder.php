<?php

namespace Database\Seeders;

use App\Models\Disponibilidad;
use Illuminate\Database\Seeder;

class DisponibilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $palabraClave = 'Disponibilidad ';
        $limite = intval(env('seedersNumber'));
        for ($i = 0; $i < $limite; $i++) {
            Disponibilidad::create([
                'nombre' => $palabraClave . rand(10, 10000),
                'codigo' => rand(10, 10000)
            ]);
        }
        // Disponibilidad::create([ 'nombre' => 'centro'.rand(10,10000), ]);
    }
}
