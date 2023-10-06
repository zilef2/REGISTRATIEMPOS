<?php

namespace App\Http\Controllers;

use App\helpers\Myhelp;
use App\Http\Controllers\Controller;

use App\helpers\HelpExcel;
use App\Http\Requests\ReporteRequest;
use App\Http\Requests\ReporteUpdateRequest;
use App\Imports\PersonalImport;
use App\Models\GuardarGoogleSheetsComercial;
use App\Models\Reporte;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ReportesController extends Controller
{

    // public $valuesGoogleCabeza, $valuesGoogleBody;


    public function MapearClasePP(&$reportes, $numberPermissions, $valuesGoogleBody) {
        $reportes = $reportes->get()->map(function ($reporte) use ($numberPermissions,$valuesGoogleBody) {

            // $reporte->ordentrabajo_s = $valuesGoogleBody->Where('Item_vue',$reporte->ordentrabajo_id)->first()->Item ?? '';

            $reporte->actividad_s = $reporte->actividad()->first() !== null ? $reporte->actividad()->first()->nombre : '';
            $reporte->centrotrabajo_s = $reporte->centrotrabajo()->first() !== null ? $reporte->centrotrabajo()->first()->nombre : '';
            $reporte->operario_s = $reporte->operario()->first() !== null ? $reporte->operario()->first()->name : '';

            $reporte->disponibilidad_s = $reporte->disponibilidad()->first() !== null ? $reporte->disponibilidad()->first()->nombre : '';
            $reporte->reproceso_s = $reporte->reproceso()->first() !== null ? $reporte->reproceso()->first()->nombre : '';

            // $reporte->calendario_s = $reporte->calendario()->first() !== null ? $reporte->calendario()->first()->nombre : '';
            return $reporte;
        })->filter();
    }

    public function SelectsMasivos($numberPermissions, $atributos_id) {
        // $usuario = Auth::User();
        // if($numberPermissions < 9){
        /* por ahora el trae todas 
                0 => "actividad"
                1 => "centrotrabajo"
                2 => "disponibilidad"
                3 => "material"
                5 => "ordentrabajo"
                7 => "pieza"
                8 => "reproceso"
                
                4 => "operario"
                6 => "calendario"
            */
        $atributos_solo_id = Myhelp::filtrar_solo_id($atributos_id);
        foreach ($atributos_solo_id as $key => $value) {

            if ($value == 'operario' || $value == 'calendario') continue;

            // $modelInstance = resolve('App\\Models\\' . ($value));
            $modelInstance = resolve('App\\Models\\' . ucfirst($value));
            $ultima = $modelInstance::All();
            $result[$value] = Myhelp::NEW_turnInSelectID($ultima, ' ');
        }
        return $result;
    }


    public function index(Request $request) {
        $permissions = Myhelp::EscribirEnLog($this, ' reportes');
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);
        $user = Auth::user();

        $readGoogle = new ReadGoogleSheets();
        [$valuesGoogleCabeza, $valuesGoogleBody] = $readGoogle->GetValuesFromSheets();

        if ($numberPermissions > 1) {
            $reportes = Reporte::query();
        } else {
            $reportes = Reporte::Where('operario_id', $user->id);
        }

        if ($request->has('search')) {
            $reportes->where(function ($query) use ($request) {
                // $query->where('codigo', 'LIKE', "%" . $request->search . "%")
                // ->orWhere('fecha', 'LIKE', "%" . $request->search . "%")
                // ;
                if (is_numeric($request->search)) {
                    if (is_numeric($request->search) > 1900) {
                        $query->orWhereYear('fecha', $request->search);
                    } else {
                        try {

                            $mes = Carbon::create(null, $request->search, $request->search);
                            $query->orWhereMonth('fecha', $mes->month())
                                ->orWhereDay('fecha', $mes->day())
                                // ->orWhere('fecha', '>', $request->search)
                            ;
                        } catch (\Throwable $th) {
                            $query->orWhereYear('fecha', $request->search);
                        }
                    }
                }
            });
            // $reportes->where('name', 'LIKE', "%" . $request->search . "%");
        }

        if ($request->has(['field', 'order'])) {
            $reportes = $reportes->orderBy($request->field, $request->order);
        }else{
            $reportes = $reportes->orderbyDesc('fecha')->orderby('hora_final')->orderByDesc('updated_at');

        }

        $this->MapearClasePP($reportes, $numberPermissions,$valuesGoogleBody);

        $Trabajadores = User::WhereHas('roles', function ($query) {
            return $query->whereIn('name', ['supervisor','trabajador']);
        })->get();
        $Trabajadores = Myhelp::NEW_turnInSelectID($Trabajadores, ' operario', 'name');

        $reporteTemp = new Reporte();
        $atributos_id = $reporteTemp->getFillable();
        $losSelect = $this->SelectsMasivos($numberPermissions, $atributos_id);

        $perPage = $request->has('perPage') ? $request->perPage : 10;
        $total = $reportes->count();
        $page = request('page', 1); // Current page number
        $fromController =  new LengthAwarePaginator(
            $reportes->forPage($page, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return Inertia::render('reporte/Index', [
            'breadcrumbs'           => [['label' => __('app.label.reporte'), 'href' => route('reporte.index')]],
            'title'                 => __('app.label.reporte'),
            'filters'               => $request->all(['search', 'field', 'order']),
            'perPage'               => (int) $perPage,
            'fromController'        => $fromController,
            'total'                 => $total,
            'numberPermissions'     => $numberPermissions,
            'Trabajadores'          => $Trabajadores,
            'losSelect'             => $losSelect ?? [],
            'valuesGoogleCabeza'    => $valuesGoogleCabeza ?? [],
            'valuesGoogleBody'      => $valuesGoogleBody ?? [],
        ]);
    }
    public function create() { }
    
    public function updatingDate($date) {
        if ($date === null || $date == '1969-12-31') {
            return null;
        }
        return date("Y-m-d", strtotime($date));
    }

    private function getLastReport($hoy, $user) {
        $hoyDate = date_create($hoy);
        date_sub($hoyDate, date_interval_create_from_date_string('1 days'));
        $ayer = date_format($hoyDate, 'Y-m-d');
        $MainQuery = Reporte::Where('operario_id', $user->id);

        $NoTieneReportes = $MainQuery->count() == 0;
        if ($NoTieneReportes) return 1; //primera vez de su vida 

        $ultimoReporte = $MainQuery->Where('fecha', $hoy)
            ->latest()->first();
        if ($ultimoReporte === null) { //hoy

            $ultimoReporte = $MainQuery->Where('fecha', $ayer)->latest()->first();
            $tipo = 1; //primera del dia 
            if ($ultimoReporte === null) { //ayer
                //leva dias sin reportar
                //todo: actualizar la ultima para que sea tipoFinalizacion = 3

            } else {
                // $ultimoReporte = $MainQuery->latest()->first();
                // $ultimoReporte->update([
                //     'hora_final' => Carbon::now()
                // ]);

            }
        } else {
            $ultimoReporte->update([
                'hora_final' => Carbon::now()
            ]);
            $tipo = 2;
        }
        return $tipo;
    }

    public function store(ReporteRequest $request) {

        if($request->ordentrabajo_id)
            $ordenID = GuardarGoogleSheetsComercial::Where('Item',$request->ordentrabajo_id['title'])->first()->id;
        else $ordenID = null;

        $user = Auth::User();
        $numberPermissions = Myhelp::getPermissionToNumber(Myhelp::EscribirEnLog($this, 'STORE:reportes'));
        if ($numberPermissions > 1) {
            $userID = $request->user_id ? $request->user_id['value'] : $user->id;
        } else {
            $userID = $user->id;
        }

        DB::beginTransaction();
        try {
            $hoy = date('Y-m-d');
            $tipoFin = $this->getLastReport($hoy, $user); //BOUNDED 1: primera del dia | 2:intermedia | 3:Ultima del dia
            $tipoReport = $request->tipoReporte['value'];
            $reporte = Reporte::create([
                // 'codigo' => $request->codigo,
                'fecha' => $request->fecha,
                'tipoReporte' => $tipoReport,
                'hora_inicial' => $request->hora_inicial,
                'hora_final' => null,
                // 'ordentrabajo_id' => $request->ordentrabajo_id['title'] ?? null,
                'ordentrabajo_id' => $ordenID,
                'centrotrabajo_id' => $request->centrotrabajo_id['value'] ?? null,

                'operario_id' => $userID,
                'actividad_id' => $request->actividad_id['value'] ?? null,
                'disponibilidad_id' => ($request->disponibilidad_id['value']) ?? null,
                'reproceso_id' => ($request->reproceso_id['value']) ?? null,
                'tipoFinalizacion' => $tipoFin,
                'nombreTablero' => $request->nombreTablero,
                'OTItem' => $request->OTItem,
                'TiempoEstimado' => $request->TiempoEstimado,
            ]);

            DB::commit();
            Myhelp::EscribirEnLog($this, 'STORE:reportes', 'usuario id:' . $user->id . ' | ' . $user->name . ' ha guardado el reporte '.$reporte->id, false);

            return back()->with('success', __('app.label.created_successfully', ['name' => 'Reporte ']));
        } catch (\Throwable $th) {
            DB::rollback();
            Myhelp::EscribirEnLog($this, 'STORE:reportes', false);
            return back()->with('error', __('app.label.created_error', ['name' => __('app.label.reporte')]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
    //fin store functions

    public function show($id) { } public function edit($id) { }

    public function update(ReporteUpdateRequest $request, $id) {
        $user = Auth::User();
        $permissions = Myhelp::EscribirEnLog($this, ' UPDATE:reportes');
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);
        DB::beginTransaction();
        try {
            $reporte = Reporte::findOrFail($id);
            
            if ($request->hora_final == null) {
                $orden = null;

                if(isset($request->tipoReporte['value']) && $request->tipoReporte['value'] != 2)
                    $orden = GuardarGoogleSheetsComercial::Where('Item',$request->ordentrabajo_id['title'])->first();

                if ($numberPermissions > 8) {
                    $actualizar_reporte['codigo'] = $request->codigo == '' ? null : $request->codigo;
                    $actualizar_reporte['fecha'] = $request->fecha == '' ? null : $request->fecha;
                    $actualizar_reporte['hora_inicial'] = $request->hora_inicial == '' ? null : $request->hora_inicial;
                }
                $request->ordentrabajo_id == null ? null : $actualizar_reporte['ordentrabajo_id'] = $orden->id;

                $request->centrotrabajo_id == null ? null : $actualizar_reporte['centrotrabajo_id'] = $request->centrotrabajo_id;
                $request->actividad_id == null ? null : $actualizar_reporte['actividad_id'] = $request->actividad_id;
                $request->disponibilidad_id == null ? null : $actualizar_reporte['disponibilidad_id'] = $request->disponibilidad_id;
                $request->reproceso_id == null ? null : $actualizar_reporte['reproceso_id'] = $request->reproceso_id;

                //tipoF no va 
                $actualizar_reporte['nombreTablero'] = $orden->Nombre_tablero ?? null;
                $actualizar_reporte['OTItem'] = $orden->Item ?? null;
                $request->TiempoEstimado == null ? null : $actualizar_reporte['TiempoEstimado'] = $request->TiempoEstimado;
                
            }else{ //se esta reportando solo la hora fin
                $DigitosHoraFinal = intval(substr($request->hora_final,0,2)); //deberia retornar 16
                // if($DigitosHoraFinal > 15){ //toask: deberia negar que se reporte antes de 4pm?
                $actualizar_reporte['hora_final'] = $request->hora_final;
                
                // $reporte->update($actualizar_reporte);
                    
                // }else{
                //     return back()->with('error', 'No son las 4pm');
                // }
            }
            $reporte->update($actualizar_reporte);

            DB::commit();
            Myhelp::EscribirEnLog($this, 'UPDATE:reportes', 'usuario id:' . $user->id . ' | reporteid: ' . $reporte->id . ' actualizado', false);
            return back()->with('success', __('app.label.updated_successfully', ['name' => 'Reporte']));
        } catch (\Throwable $th) {
            DB::rollback();
            Myhelp::EscribirEnLog($this, 'UPDATE:reportes', 'usuario id:' . $user->id ?? ' nottuser ' . ' |reporteid: ' . ($reporte->id ?? 'nottreporte') . '  fallo en el actualizado', false);
            return back()->with('error', __('app.label.updated_error', ['name' => ($reporte->id ?? 'no id')]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }

    public function destroy(reporte $reporte)
    {
        $permissions = Myhelp::EscribirEnLog($this, 'DELETE:reportes');

        try {
            $reporte->delete();
            Myhelp::EscribirEnLog($this, 'DELETE:reportes', 'usuario id:' . $reporte->id . ' | ' . $reporte->codigo . ' borrado', false);
            return back()->with('success', __('app.label.deleted_successfully', ['name' => 'Reporte']));
        } catch (\Throwable $th) {
            Myhelp::EscribirEnLog($this, 'DELETE:reportes', 'usuario id:' . $reporte->id . ' | ' . $reporte->codigo . ' fallo en el borrado:: ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile(), false);
            return back()->with('error', __('app.label.deleted_error', ['name' => $reporte->codigo]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }

    public function destroyBulk(Request $request) {
        try {
            $reporte = Reporte::whereIn('id', $request->id);
            $reporte->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . __('app.label.reporte')]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . __('app.label.reporte')]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
    //FIN : STORE - UPDATE - DELETE

    public function subirexceles() { //just  a view
        $permissions = Myhelp::EscribirEnLog($this, ' reporte');
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);

        return Inertia::render('reporte/subirExceles', [
            'breadcrumbs'   => [['label' => __('app.label.reporte'), 'href' => route('reporte.index')]],
            'title'         => __('app.label.reporte'),
            'numUsuarios'   => count(Reporte::all()) - 1,
            // 'UniversidadSelect'   => Universidad::all()
        ]);
    }

    private function MensajeWar() {
        $bandera = false;
        $contares = [
            'contar1',
            'contar2',
            'contar3',
            'contar4',
            'contar5',
            'contarVacios',
        ];
        $mensajesWarnings = [
            '#correos Existentes: ',
            'Novedad, error interno: ',
            '#cedulas no numericas: ',
            '#generos distintos(M,F,otro): ',
            '#identificaciones repetidas: ',
            '#filas con celdas vacias: ',
        ];

        foreach ($contares as $key => $value) {
            $$value = session($value, 0);
            session([$value => 0]);
            $bandera = $bandera || $$value > 0;
        }
        session(['contar2' => -1]);

        $mensaje = '';
        if ($bandera) {
            foreach ($mensajesWarnings as $key => $value) {
                if (${$contares[$key]} > 0) {
                    $mensaje .= $value . ${$contares[$key]} . '. ';
                }
            }
        }

        return $mensaje;
    }

    public function uploadtrabajadors(Request $request)
    {
        Myhelp::EscribirEnLog($this, get_called_class(), 'Empezo a importar', false);
        $countfilas = 0;
        try {
            if ($request->archivo1) {

                $helpExcel = new HelpExcel();
                $mensageWarning = $helpExcel->validarArchivoExcel($request);
                if ($mensageWarning != '') return back()->with('warning', $mensageWarning);

                Excel::import(new PersonalImport(), $request->archivo1);

                $countfilas = session('CountFilas', 0);
                session(['CountFilas' => 0]);

                $MensajeWarning = self::MensajeWar();
                if ($MensajeWarning !== '') {
                    return back()->with('success', 'Usuarios nuevos: ' . $countfilas)
                        ->with('warning', $MensajeWarning);
                }

                Myhelp::EscribirEnLog($this, 'IMPORT:reportes', ' finalizo con exito', false);
                if ($countfilas == 0)
                    return back()->with('success', __('app.label.op_successfully') . ' No hubo cambios');
                else
                    return back()->with('success', __('app.label.op_successfully') . ' Se leyeron ' . $countfilas . ' filas con exito');
            } else {
                return back()->with('error', __('app.label.op_not_successfully') . ' archivo no seleccionado');
            }
        } catch (\Throwable $th) {
            Myhelp::EscribirEnLog($this, 'IMPORT:reportes', ' Fallo importacion: ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile(), false);
            return back()->with('error', __('app.label.op_not_successfully') . ' Usuario del error: ' . session('larow')[0] . ' error en la iteracion ' . $countfilas . ' ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
}
