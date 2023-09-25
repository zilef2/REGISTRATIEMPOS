<?php

namespace App\Http\Controllers;

use App\helpers\Myhelp;
use App\Models\GuardarGoogleSheetsComercial;
use App\Models\Role;
use Carbon\Carbon;
use Google\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Revolution\Google\Sheets\Sheets;

class ReadGoogleSheets extends Controller
{


    public function NecesitaActualizaF() {
        if(GuardarGoogleSheetsComercial::exists()){
            $ultimaGuardada = Carbon::parse(GuardarGoogleSheetsComercial::OrderByDesc('created_at')->first()->created_at);
            $NecesitaActualizar = false;

            if($ultimaGuardada === null){
                return true;
            }else{
                $difHoras = Carbon::now()->diffInHours($ultimaGuardada);
                $NecesitaActualizar = $difHoras > 4; //todo: hacer ese 4 un parametro
                return $NecesitaActualizar;
            }
        }else{
            return true;
        }

    }

    public function vamoABusca() {
        $spreadsheetId = '1j_eDVGjHHVjPlnsQxQBGdyQUH0CXj9HMnSNqp0tZRYU'; $sheetName = 'Comercial';
        $service = new Sheets(new Client());
        $range = 'AI1:AT10';
        $range = 'AI1:AT50000';
        $spreadsheet = $service->spreadsheets->get($spreadsheetId);
        $sheet = $spreadsheet->getSheets()[0];
        $range = 'AI1:AT' . $sheet->getProperties()->getGridProperties()->rowCount;//150...
        $values = $service->spreadsheet($spreadsheetId)->sheet($sheetName)->range($range)->all();

        $cabeza =  $values[0];
        unset($values[0]);
        return [$cabeza,$values];
    }

    public function vamoAlUltimo($Grupo) {
        if(GuardarGoogleSheetsComercial::exists()) {

            $values = GuardarGoogleSheetsComercial::Where('Grupo', $Grupo)->get();
            if(!isset($values[0])){
                $Grupo = date('Y-m-d',strtotime("-1 days"));
                $values = GuardarGoogleSheetsComercial::Where('Grupo', $Grupo)->get();
            }
            
            $cabeza =  $values[0];
            unset($values[0]);
            return [$cabeza,$values];
        }
        return null;

    }
    public function vamoAGuardaComercial($valuesGoogle,$Grupo) {
        // $numberPermissions = Myhelp::getPermissionToNumber(auth()->user()->roles->pluck('name')[0]);

        $HayTiemposEstimados = 0;
        
        foreach ($valuesGoogle as $key => $value) {
            if(
                (isset($value[3])  && strcasecmp($value[3], '') !== 0) ||
                (isset($value[4])  && strcasecmp($value[4], '') !== 0) ||
                (isset($value[5])  && strcasecmp($value[5], '') !== 0) ||
                (isset($value[6])  && strcasecmp($value[6], '') !== 0) ||
                (isset($value[7])  && strcasecmp($value[7], '') !== 0) ||
                (isset($value[8])  && strcasecmp($value[8], '') !== 0) ||
                (isset($value[9])  && strcasecmp($value[9], '') !== 0) ||
                (isset($value[10]) && strcasecmp($value[10], '') !== 0) ||
                (isset($value[11]) && strcasecmp($value[11], '') !== 0)
            ){
                $HayTiemposEstimados = 1;
            }

            //todo: solo cambiar los valores diff
            GuardarGoogleSheetsComercial::create([
                'HayTiemposEstimados' => $HayTiemposEstimados,
                'Grupo' => $Grupo,
                'user_id' => auth()->user()->id,
                'Nombre_tablero' => $value[0] ?? '',
                'Item' => $value[1] ?? '',
                'avance' => $value[2] ?? '',
                'Tiempo_estimado_Ing_mec' => $value[3] ?? '',
                'Tiempo_estimado_Ing_elec' => $value[4] ?? '',
                'Tiempo_estimado_corte' => $value[5] ?? '',
                'Tiempo_estimado_doblez' => $value[6] ?? '',
                'Tiempo_estimado_soldadura' => $value[7] ?? '',
                'Tiempo_estimado_pulida' => $value[8] ?? '',
                'Tiempo_estimado_ensamble' => $value[9] ?? '',
                'Tiempo_estimado_cableado' => $value[10] ?? '',
                'Tiempo_estimado_cobre' => $value[11] ?? '',
            ]);
        }

        return 
        GuardarGoogleSheetsComercial::Where('Grupo',$Grupo)->get();
    }


    public function GetValuesFromSheets() {
        $Grupo = date('Y-m-d');
        $NecesitaActualizar = $this->NecesitaActualizaF();
        if($NecesitaActualizar){
            $cabezaYvalues = $this->vamoABusca();

            $valueCabeza = $cabezaYvalues[0];
            $cabezaYvalues[0] = GuardarGoogleSheetsComercial::create([
                'HayTiemposEstimados' => 2, //0 no hay tiempos | 1 hay almenos 0,0 | 2 es la cabeza
                'Grupo' => $Grupo,
                'user_id' => auth()->user()->id,
                'Nombre_tablero' => $valueCabeza[0] ?? '',
                'Item' => $valueCabeza[1] ?? '',
                'avance' => $valueCabeza[2] ?? '',
                'Tiempo_estimado_Ing_mec' => $valueCabeza[3] ?? '',
                'Tiempo_estimado_Ing_elec' => $valueCabeza[4] ?? '',
                'Tiempo_estimado_corte' => $valueCabeza[5] ?? '',
                'Tiempo_estimado_doblez' => $valueCabeza[6] ?? '',
                'Tiempo_estimado_soldadura' => $valueCabeza[7] ?? '',
                'Tiempo_estimado_pulida' => $valueCabeza[8] ?? '',
                'Tiempo_estimado_ensamble' => $valueCabeza[9] ?? '',
                'Tiempo_estimado_cableado' => $valueCabeza[10] ?? '',
                'Tiempo_estimado_cobre' => $valueCabeza[11] ?? '',
            ]);

            $cabezaYvalues[1] = $this->vamoAGuardaComercial($cabezaYvalues[1],$Grupo);
        }else{
            $cabezaYvalues = $this->vamoAlUltimo($Grupo);

        }
        // dd(
        //     $cabezaYvalues[0],
        //     $cabezaYvalues[1],
        // );
        return $cabezaYvalues;
    }
    
    public function __invoke(Request $request) {
        // public function notinvoke(Request $request) {
        // $permissions = Myhelp::EscribirEnLog($this, ' users');
        // $numberPermissions = Myhelp::getPermissionToNumber($permissions);
        // $spreadsheetId = '1EZkfkdQIMoiLewYhG8Qaw2JCc_jqnb_4_pOB75jJAT4'; $sheetName = 'Hoja 1'; //zilef
        [$cabeza,$values] = $this->GetValuesFromSheets();
      
        $total_cantidad = 0;
        foreach ($values as $key => $value) {
            $total_cantidad += intval($value[2]); //%avance
        }

        $total_cantidad = ''.$total_cantidad.' / '.$total_cantidad/count($values);

        return Inertia::render('sheet1/Index', [
            'breadcrumbs'             => [['label' => __('app.label.sheet'), 'href' => '/gsheet']],
            'title'                   => __('app.label.user'),
            'cabeza'                  => $cabeza,
            'valores'                  => $values,
            'total_cantidad'                  => $total_cantidad,
            // 'numberPermissions'       => $numberPermissions,
        ]);
    }
}
