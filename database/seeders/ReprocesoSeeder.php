<?php

namespace Database\Seeders;

use App\Models\Centrotrabajo;
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
        $actividades_reproceso = [
            [
                // # actividades en reprocesos
                'REPROCESO POR INGENERIA MECANICA',
                'REPROCESO POR INGENERIA ELECTRICA',
                'REPROCESO CHAPISTERIA',
                'REPROCESO ENSAMBLE',
                'REPROCESO COBRE',
                'REPROCESO CABLEADO',
                'REPROCESO COMERCIAL',
                'REPROCESO ALMACEN',
            ],[
                'PLANOS MECANICOS',
                'PLANOS ELECTRICOS',
                'CAMBIOS DEL CLIENTE',
                'CAMBIOS DEL COMERCIAL',
                'CAMBIOS DE PRODUCCION',
            ]
        ];
        $IngMeca = Centrotrabajo::Where('nombre','INGENIERIA MECANICA')->first()->id;
        $IngElectrica = Centrotrabajo::Where('nombre','INGENIERIA ELECTRICA')->first()->id;
        $centrosNoIng = Centrotrabajo::WhereNotIn('id',[$IngMeca, $IngElectrica])->pluck('id');

        foreach ($actividades_reproceso as $key => $value) {
            foreach ($value as $key2 => $val) {
                $acti = Reproceso::create([
                    'codigo' => $key.' '.$key2,
                    'nombre' => $val
                ]);
                if($key == 0 || $key == 2){
                    foreach ($centrosNoIng as $IDnoIng) {
                        $acti->centroTrabajos()->attach($IDnoIng);
                        // $acti->ActividadTipo($IDnoIng,2);
                    }
                } 
                if($key == 1 || $key == 2){
                    // $acti->ActividadTipo($IngMeca,2);
                    // $acti->ActividadTipo($IngElectrica,2);
                    $acti->centroTrabajos()->attach($IngMeca);
                    $acti->centroTrabajos()->attach($IngElectrica);
                }
            }
        }
    }
}
