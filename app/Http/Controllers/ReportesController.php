<?php

namespace App\Http\Controllers;

use App\helpers\Myhelp;
use App\Http\Controllers\Controller;

use App\helpers\HelpExcel;
use App\Http\Requests\ReporteRequest;
use App\Imports\PersonalImport;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ReportesController extends Controller
{
    public function MapearClasePP(&$reportes, $numberPermissions) {
        $reportes = $reportes->get()->map(function ($reporte) use ($numberPermissions) {
            $reporte->actividad_s = $reporte->actividad()->first() !== null ? $reporte->actividad()->first()->nombre : '';
            $reporte->centrotrabajo_s = $reporte->centrotrabajo()->first() !== null ? $reporte->centrotrabajo()->first()->codigo : '';
            $reporte->material_s = $reporte->material()->first() !== null ? $reporte->material()->first()->codigo : '';
            $reporte->ordentrabajo_s = $reporte->ordentrabajo()->first() !== null ? $reporte->ordentrabajo()->first()->codigo : '';
            $reporte->operario_s = $reporte->operario()->first() !== null ? $reporte->operario()->first()->name : '';

            $reporte->pieza_s = $reporte->pieza()->first() !== null ? $reporte->pieza()->first()->codigo : '';
            
            $reporte->disponibilidad_s = $reporte->disponibilidad()->first() !== null ? $reporte->disponibilidad()->first()->codigo : '';
            $reporte->reproceso_s = $reporte->reproceso()->first() !== null ? $reporte->reproceso()->first()->codigo : '';
            
            // $reporte->calendario_s = $reporte->calendario()->first() !== null ? $reporte->calendario()->first()->codigo : '';
            return $reporte;
        })->filter();
        // dd($materias);
    }

    public function SelectsMasivos($numberPermissions,$atributos_id){
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

            if($value == 'operario' || $value == 'calendario') continue;

            $modelInstance = resolve('App\\Models\\' . ($value));
            // $modelInstance = resolve('App\\Models\\' . ucfirst($value));
            $ultima = $modelInstance::All();
            $result[$value] = Myhelp::NEW_turnInSelectID($ultima,' ');

        }
        return $result;
    }



    public function index(Request $request) {
        $permissions = Myhelp::EscribirEnLog($this, ' reportes');
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);
        $user = Auth::user();
        if($numberPermissions > 1){
            $reportes = Reporte::query();
        }else{
            $reportes = Reporte::Where('operario_id',$user->id);
        }


        if ($request->has('search')) {
            $reportes->where(function ($query) use ($request) {
                $query->where('codigo', 'LIKE', "%" . $request->search . "%")
                    // ->orWhere('email', 'LIKE', "%" . $request->search . "%")
                    ;
            });

            // $reportes->where('name', 'LIKE', "%" . $request->search . "%");
        }

        if ($request->has(['field', 'order'])) {
            $reportes = $reportes->orderBy($request->field, $request->order);
        }

        $this->MapearClasePP($reportes, $numberPermissions);

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
            'losSelect'             => $losSelect ?? [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() { }


    //! STORE - UPDATE - DELETE
    //! STORE functions
    public function updatingDate($date) {
        if ($date === null || $date == '1969-12-31') {
            return null;
        }
        return date("Y-m-d", strtotime($date));
    }

    public function store(ReporteRequest $request)
    {
        $user = Auth::User();
        $permissions = Myhelp::EscribirEnLog($this, 'STORE:reportes');
        
        // dd(
        //         $request->pieza_id,
        //         $request->piezaID,
        //         $request->actividad_id,
        //     );
            
        if($request->pieza_id)
            // $request->piezaID = $request->pieza_id['value'];
            $request->validate([
                'pieza_id.value' => 'nullable|integer',
                'cantidad' => Rule::requiredIf(function () use ($request) {
                    $temp = $request->pieza_id['value'] ?? null;
                    return !is_null($temp);
                }),
            ]);
        DB::beginTransaction();
        try {

            $reporte = Reporte::create([
                'codigo' => $request->codigo,
                'fecha' => $request->fecha,
                'hora_inicial' => $request->hora_inicial,
                'hora_final' => null,
                'actividad_id' => $request->actividad_id['value'],
                'centrotrabajo_id' => $request->centrotrabajo_id['value'],
                'material_id' => $request->material_id['value'],
                'ordentrabajo_id' => $request->ordentrabajo_id['value'],

                'pieza_id' => $request->pieza_id ? $request->pieza_id['value'] : null,
                'cantidad' => $request->cantidad,

                'operario_id' => $user->id,

                'disponibilidad_id' => ($request->disponibilidad_id['value']) ?? null ,
                'reproceso_id' => ($request->reproceso_id['value']) ?? null ,
            ]);
            DB::commit();
            Myhelp::EscribirEnLog($this, 'STORE:reportes', 'usuario id:' . $user->id . ' | ' . $user->name . ' guardado', false);

            return back()->with('success', __('app.label.created_successfully', ['name' => $reporte->name]));
        } catch (\Throwable $th) {
            DB::rollback();
            Myhelp::EscribirEnLog($this, 'STORE:reportes', false);
            return back()->with('error', __('app.label.created_error', ['name' => __('app.label.reporte')]) . $th->getMessage());
        }
    }
    //fin store functions

    public function show($id) { } public function edit($id) { }


    public function update(ReporteRequest $request, $id)
    {
        $user = Auth::User();

        Myhelp::EscribirEnLog($this, 'UPGRADE:reportes', '', false);
        DB::beginTransaction();
        try {
            $reporte = Reporte::findOrFail($id);
            $reporte->update([
                'codigo' => $request->codigo,
                'fecha' => $request->fecha,
                'hora_inicial' => $request->hora_inicial,
                'hora_final' => null,
                'actividad_id' => $request->actividad_id['value'],
                'centrotrabajo_id' => $request->centrotrabajo_id['value'],
                'material_id' => $request->material_id['value'],
                'ordentrabajo_id' => $request->ordentrabajo_id['value'],

                'pieza_id' => $request->pieza_id ? $request->pieza_id['value'] : null,
                'cantidad' => $request->cantidad,

                'operario_id' => $user->id,

                'disponibilidad_id' => ($request->disponibilidad_id['value']) ?? null ,
                'reproceso_id' => ($request->reproceso_id['value']) ?? null ,
            ]);
            DB::commit();
            Myhelp::EscribirEnLog($this, 'UPDATE:reportes', 'usuario id:' . $reporte->id . ' | ' . $reporte->name . ' actualizado', false);

            return back()->with('success', __('app.label.updated_successfully', ['name' => $reporte->name]));
        } catch (\Throwable $th) {
            DB::rollback();
            Myhelp::EscribirEnLog($this, 'UPDATE:reportes', 'usuario id:' . $reporte->id . ' | ' . $reporte->name . '  fallo en el actualizado', false);
            return back()->with('error', __('app.label.updated_error', ['name' => $reporte->name]) . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(reporte $reporte)
    {
        $permissions = Myhelp::EscribirEnLog($this, 'DELETE:reportes');

        try {
            $reporte->delete();
            Myhelp::EscribirEnLog($this, 'DELETE:reportes', 'usuario id:' . $reporte->id . ' | ' . $reporte->name . ' borrado', false);
            return back()->with('success', __('app.label.deleted_successfully', ['name' => $reporte->name]));
        } catch (\Throwable $th) {
            Myhelp::EscribirEnLog($this, 'DELETE:reportes', 'usuario id:' . $reporte->id . ' | ' . $reporte->name . ' fallo en el borrado:: ' . $th->getMessage(), false);
            return back()->with('error', __('app.label.deleted_error', ['name' => $reporte->name]) . $th->getMessage());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $reporte = Reporte::whereIn('id', $request->id);
            $reporte->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . __('app.label.reporte')]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . __('app.label.reporte')]) . $th->getMessage());
        }
    }
    //FIN : STORE - UPDATE - DELETE

    public function subirexceles()
    { //just  a view
        $permissions = Myhelp::EscribirEnLog($this, ' reporte');
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);

        return Inertia::render('reporte/subirExceles', [
            'breadcrumbs'   => [['label' => __('app.label.reporte'), 'href' => route('reporte.index')]],
            'title'         => __('app.label.reporte'),
            'numUsuarios'   => count(Reporte::all()) - 1,
            // 'UniversidadSelect'   => Universidad::all()
        ]);
    }


    // Duplicate entry '1152194566' for key 'reportes_identificacion_unique'
    private function MensajeWar()
    {
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
            Myhelp::EscribirEnLog($this, 'IMPORT:reportes', ' Fallo importacion: ' . $th->getMessage(), false);
            return back()->with('error', __('app.label.op_not_successfully') . ' Usuario del error: ' . session('larow')[0] . ' error en la iteracion ' . $countfilas . ' ' . $th->getMessage());
        }
    }
}
