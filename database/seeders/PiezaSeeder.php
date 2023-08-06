<?php

namespace Database\Seeders;

use App\Models\Pieza;
use Illuminate\Database\Seeder;

class PiezaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $palabraClave = 'Pieza ';
        $limite = intval(env('seedersNumber'));
        for ($i = 0; $i < $limite; $i++) {
            Pieza::create([
                'nombre' => $palabraClave . rand(10, 10000),
                'codigo' => rand(10, 10000)
            ]);
        }
        // Pieza::create([ 'nombre' => 'centro'.rand(10,10000), ]);
    }
}
