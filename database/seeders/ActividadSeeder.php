<?php

namespace Database\Seeders;

use App\Models\Actividad;
use App\Models\Centrotrabajo;
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
        // $randNumber = rand(1,1000);
        $actividades_reproceso = [
            [
                // # actividades en reprocesos
                'REPROCESO DE INGENERIA MECANICA',
                'REPROCESO DE INGENERIA ELECTRICA',
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
        $actividades_actividad = [
            [
                // # actividades en actividad
                'CORTE',
                'DOBLEZ',
                'SOLDADURA',
                'PULIDA',
                'ENSAMBLE',
                'COBRE',
                'CABLEADO',
                'PROTOCOLO',
                'EMPAQUE Y EMBALAJE',
                'PLANEACION',
                'DESPACHO',
                'DEVOLUCION',
                'RECEPCION DE MATERIAL',
                'REMISION PINTURA',
                'KAMBA',
            ],[
                // # ingenierias
                'PREDISEÑO ',
                'PLANOS PARA FABRICACION (Pedido de equipos, consumibles, Chapisteria, despiece, impresión)',
                'ACOMPAÑAMIENTO PROYECTOS EN PLANTA',
                'ACOMPAÑAMIENTO PROYECTOS COMERCIAL',
                'ACOMPAÑAMIENTO PROYECTOS COMPRAS',
                'TIPICOS',
            ],[
                // #ambos (actividad)
                'TRABAJO EXTERNO GARANTIAS',
                'TRABAJO EXTERNO SERVICIOS',
                'MARCACION Y PLACAS',
                'PRUEBAS',
            ]
        ];

        $IngMeca = Centrotrabajo::Where('nombre','INGENIERIA MECANICA')->first()->id;
        $IngElectrica = Centrotrabajo::Where('nombre','INGENIERIA ELECTRICA')->first()->id;
        $centrosNoIng = Centrotrabajo::WhereNotIn('id',[$IngMeca, $IngElectrica])->pluck('id');

        // $TiposActividades =[
        //     $actividades_disponibilidad,
        //     $actividades_reproceso,
        //     $actividades_actividad
        // ];

        // foreach ($TiposActividades as $valueArray) {
            foreach ($actividades_actividad as $key => $value) {
                foreach ($value as $key2 => $val) {
                    $acti = Actividad::create([
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
        // }

    }
}
