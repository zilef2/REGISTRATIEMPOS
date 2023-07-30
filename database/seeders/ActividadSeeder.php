<?php

namespace Database\Seeders;

use App\Models\Actividad;
use Illuminate\Database\Seeder;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randNumber = rand(1,1000);
        Actividad::create([ 'codigo' => $randNumber, 'nombre' => "actividad $randNumber", ]);
        $randNumber = rand(1,1000);
        Actividad::create([ 'codigo' => $randNumber, 'nombre' => "actividad $randNumber", ]);
    }
}
