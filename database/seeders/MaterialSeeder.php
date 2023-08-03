<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $palabraClave = 'Material ';
        $limite = 10;
        for ($i=0; $i < $limite; $i++) { 
            Material::create([
                'nombre' => $palabraClave.rand(10,10000),
                'codigo' => rand(10,10000)
             ]);
        }
        // Material::create([ 'nombre' => 'centro'.rand(10,10000), ]);
    }
}