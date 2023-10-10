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
            ], [
                'PLANOS MECANICOS',
                'PLANOS ELECTRICOS',
                'CAMBIOS DEL CLIENTE',
                'CAMBIOS DEL COMERCIAL',
                'CAMBIOS DE PRODUCCION',
            ]
        ];
        $actividades_actividad = [
            'CORTE' => [
                'CORTE',
                'PLANEACION',
                'RECEPCION DE MATERIAL',
            ],
            'DOBLEZ' => [
                'DOBLEZ',
                'PLANEACION',
            ],
            'SOLDADURA' => [
                'SOLDADURA',
                'PLANEACION',
            ],
            'PULIDA' => [

                'PULIDA',
                'REMISION PINTURA',
            ],
            'ENSAMBLE' => [
                'ENSAMBLE',
                'PLANEACION',
                'DESPACHO',
                'DEVOLUCION',
                'KAMBA',
                'TRABAJO EXTERNO GARANTIAS',
                'TRABAJO EXTERNO SERVICIOS',
                'EMPAQUE Y EMBALAJE',
            ],
            'COBRE' => [
                'COBRE',
                'PLANEACION',
                'KAMBA',
            ],
            'CABLEADO' => [
                'CABLEADO',
                'PLANEACION',
                'PROTOCOLO',
                'PRUEBAS',
                'TRABAJO EXTERNO GARANTIAS',
                'TRABAJO EXTERNO SERVICIOS',
                'EMPAQUE Y EMBALAJE',
                'MARCACION Y PLACAS',

            ],
                // # ingenierias
            'INGENIERIA MECANICA' => [
                'PREDISEÑO ',
                'PLANOS PARA FABRICACION (Pedido de equipos, consumibles, Chapisteria, despiece, impresión)',
                'TIPICOS',
                'ACOMPAÑAMIENTO PROYECTOS EN PLANTA',
                'ACOMPAÑAMIENTO PROYECTOS COMERCIAL',
                'ACOMPAÑAMIENTO PROYECTOS COMPRAS',
                'TRABAJO EXTERNO GARANTIAS',
                'TRABAJO EXTERNO SERVICIOS',
            ],
            'INGENIERIA ELECTRICA' => [
                'PREDISEÑO ',
                'PLANOS PARA FABRICACION (Pedido de equipos, consumibles, Chapisteria, despiece, impresión)',
                'TIPICOS',
                'ACOMPAÑAMIENTO PROYECTOS EN PLANTA',
                'ACOMPAÑAMIENTO PROYECTOS COMERCIAL',
                'ACOMPAÑAMIENTO PROYECTOS COMPRAS',
                'TRABAJO EXTERNO GARANTIAS',
                'TRABAJO EXTERNO SERVICIOS',
                'MARCACION Y PLACAS',
                'PRUEBAS',
            ]
        ];

        // $IngMeca = Centrotrabajo::Where('nombre', 'INGENIERIA MECANICA')->first()->id;
        // $IngElectrica = Centrotrabajo::Where('nombre', 'INGENIERIA ELECTRICA')->first()->id;
        // $centrosNoIng = Centrotrabajo::WhereNotIn('id', [$IngMeca, $IngElectrica])->pluck('id');

        foreach ($actividades_actividad as $key => $value) {
            $centro = Centrotrabajo::Where('nombre', $key)->first()->id;

            foreach ($value as $key2 => $val) {
                $acti = Actividad::firstOrCreate([
                    // 'codigo' => $key.' '.$key2,
                    'nombre' => $val
                ]);
                $acti->centroTrabajos()->attach($centro);
            }
        }
    }
}
