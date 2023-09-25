<?php

namespace Database\Seeders;

use App\Models\Centrotrabajo;
use App\Models\Disponibilidad;
use Illuminate\Database\Seeder;

class DisponibilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $actividades_disponibilidad = [
            [
                'ALMACEN',
                'MANTENIMIENTO',
                'INVENTARIO',
                'INGENIERIA',
                'HERRAMIENTA',
                'MAQUINA',
            ],
            [
                'CAPACITACION',
                'FALTA DE APROBACION PLANOS',
                'SERVIDOR Y/O ENERGIA',
            ],
            [
                'REUNION',
                'PAUSAS ACTIVAS',
                'ORDEN Y ASEO',
                'PROGRAMACION',
                'AUSENCIA',
                'ALIMENTACION',
            ]
        ];
        $IngMeca = Centrotrabajo::Where('nombre','INGENIERIA MECANICA')->first()->id;
        $IngElectrica = Centrotrabajo::Where('nombre','INGENIERIA ELECTRICA')->first()->id;
        $centrosNoIng = Centrotrabajo::WhereNotIn('id',[$IngMeca, $IngElectrica])->pluck('id');

        foreach ($actividades_disponibilidad as $key => $value) {
            foreach ($value as $key2 => $val) {
                $acti = Disponibilidad::create([
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
