<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Centrotrabajo;
use App\helpers\Myhelp;

use App\helpers\HelpExcel;
use App\Http\Requests\CentrotrabajoRequest;
use App\Imports\PersonalImport;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class CentrotrabajosController extends Controller
{
    public $nombreClase = 'Centrotrabajo';
    public $MayusnombreClase = 'Centrotrabajo';
    public $thisAtributos;

    public function __construct()
    {
        $this->thisAtributos = (new Centrotrabajo())->getFillable();
    }

    public function MapearClasePP(&$Centrotrabajos, $numberPermissions)
    {
        $Centrotrabajos = $Centrotrabajos->get()->map(function ($Centrotrabajo) use ($numberPermissions) {
            // $Centrotrabajo->Centrotrabajo_s = $Centrotrabajo->Centrotrabajo()->first() !== null ? $Centrotrabajo->Centrotrabajo()->first()->nombre : '';

            return $Centrotrabajo;
        })->filter();
    }

    public function index(Request $request){
        $permissions = Myhelp::EscribirEnLog($this, $this->nombreClase);
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);
        $user = Auth::user();

        // if($numberPermissions > 1){
        $Centrotrabajos = Centrotrabajo::query();
        // }else{
        //     $Centrotrabajos = Centrotrabajo::Where('operario_id',$user->id);
        // }

        if ($request->has('search')) {
            $Centrotrabajos->where(function ($query) use ($request) {
                $query->where('codigo', 'LIKE', "%" . $request->search . "%")
                    ->orWhere('nombre', 'LIKE', "%" . $request->search . "%");
            });
        }
        if ($request->has(['field', 'order'])) {
            $Centrotrabajos = $Centrotrabajos->orderBy($request->field, $request->order);
        }
        $this->MapearClasePP($Centrotrabajos, $numberPermissions);

        // $losSelect = $this->SelectsMasivos($numberPermissions, $atributos_id);

        $perPage = $request->has('perPage') ? $request->perPage : 10;
        $total = $Centrotrabajos->count();
        $page = request('page', 1); // Current page number
        $fromController =  new LengthAwarePaginator(
            $Centrotrabajos->forPage($page, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return Inertia::render('centrotrabajo/Index', [
            'breadcrumbs'           => [['label' => __('app.label.centrotrabajo'), 'href' => route('centrotrabajo.index')]],
            'title'                 => __('app.label.centrotrabajo'),
            'filters'               => $request->all(['search', 'field', 'order']),
            'perPage'               => (int) $perPage,
            'fromController'        => $fromController,
            'total'                 => $total,
            'numberPermissions'     => $numberPermissions,

            // 'losSelect'             => $losSelect ?? [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }


    //! STORE - UPDATE - DELETE
    public function store(CentrotrabajoRequest $request) {
        $user = Auth::User();
        Myhelp::EscribirEnLog($this, 'STORE:Centrotrabajos', '', false);

        DB::beginTransaction();
        try {
            $guardar = [];
            foreach ($this->thisAtributos as $value) {
                $guardar[$value] = $request->$value;
            }
            $guardar['codigo'] = 10;
            $Centrotrabajo = Centrotrabajo::create($guardar);

            DB::commit();
            Myhelp::EscribirEnLog($this, 'STORE:Centrotrabajos', 'usuario id:' . $user->id . ' | ' . $user->name . ' guardado', false);
            return back()->with('success', __('app.label.created_successfully', ['name' => $Centrotrabajo->name]));
        } catch (\Throwable $th) {
            DB::rollback();
            Myhelp::EscribirEnLog($this, 'STORE:Centrotrabajos', false);
            return back()->with('error', __('app.label.created_error', ['name' => __('app.label.Centrotrabajo')]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
    //fin store functions

    public function show($id)
    {
    }
    public function edit($id)
    {
    }


    public function update(CentrotrabajoRequest $request, $id)
    {
        $user = Auth::User();

        Myhelp::EscribirEnLog($this, 'UPGRADE:Centrotrabajos', '', false);
        DB::beginTransaction();
        try {
            $Centrotrabajo = Centrotrabajo::findOrFail($id);
            foreach ($this->thisAtributos as $value) {
                $guardar[$value] = $request->$value;
            }
            $Centrotrabajo->update($guardar);
            DB::commit();
            Myhelp::EscribirEnLog($this, 'UPDATE:Centrotrabajos', 'usuario id:' . $Centrotrabajo->id . ' | ' . $Centrotrabajo->name . ' actualizado', false);

            return back()->with('success', __('app.label.updated_successfully', ['name' => $Centrotrabajo->name]));
        } catch (\Throwable $th) {
            DB::rollback();
            Myhelp::EscribirEnLog($this, 'UPDATE:Centrotrabajos', 'usuario id:' . $Centrotrabajo->id . ' | ' . $Centrotrabajo->name . '  fallo en el actualizado', false);
            return back()->with('error', __('app.label.updated_error', ['name' => $Centrotrabajo->name]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }


    public function destroy(Centrotrabajo $Centrotrabajo){
        Myhelp::EscribirEnLog($this, 'DELETE:Centrotrabajos');
        try {
            if($Centrotrabajo->id > 9) {

                $Centrotrabajo->delete();
                Myhelp::EscribirEnLog($this, 'DELETE:Centrotrabajos', 'usuario id:' . $Centrotrabajo->id . ' | ' . $Centrotrabajo->nombre . ' borrado', false);
                return back()->with('success', __('app.label.deleted_successfully', ['name' => $Centrotrabajo->nombre]));
            }else{
                return back()->with('error', __('app.label.deleted_error', ['name' => $Centrotrabajo->nombre] ). '. Este valor es propio de google sheets.');
            }
        } catch (\Throwable $th) {
            Myhelp::EscribirEnLog($this, 'DELETE:Centrotrabajos', 'usuario id:' . $Centrotrabajo->id . ' | ' . $Centrotrabajo->nombre . ' fallo en el borrado ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile(), false);

            return back()->with('error', __('app.label.deleted_error', ['name' => $Centrotrabajo->nombre]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }

    public function destroyBulk(Request $request){
        try {
            $Centrotrabajo = Centrotrabajo::whereIn('id', $request->id);
            $Centrotrabajo->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . __('app.label.Centrotrabajo')]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . __('app.label.Centrotrabajo')]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
    //FIN : STORE - UPDATE - DELETE

    public function subirexceles()
    { //just  a view
        $permissions = Myhelp::EscribirEnLog($this, ' Centrotrabajo');
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);

        return Inertia::render('Centrotrabajo/subirExceles', [
            'breadcrumbs'   => [['label' => __('app.label.Centrotrabajo'), 'href' => route('Centrotrabajo.index')]],
            'title'         => __('app.label.Centrotrabajo'),
            'numUsuarios'   => count(Centrotrabajo::all()) - 1,
            // 'UniversidadSelect'   => Universidad::all()
        ]);
    }


    // Duplicate entry '1152194566' for key 'Centrotrabajos_identificacion_unique'
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

                Myhelp::EscribirEnLog($this, 'IMPORT:Centrotrabajos', ' finalizo con exito', false);
                if ($countfilas == 0)
                    return back()->with('success', __('app.label.op_successfully') . ' No hubo cambios');
                else
                    return back()->with('success', __('app.label.op_successfully') . ' Se leyeron ' . $countfilas . ' filas con exito');
            } else {
                return back()->with('error', __('app.label.op_not_successfully') . ' archivo no seleccionado');
            }
        } catch (\Throwable $th) {
            Myhelp::EscribirEnLog($this, 'IMPORT:Centrotrabajos', ' Fallo importacion: ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile(), false);
            return back()->with('error', __('app.label.op_not_successfully') . ' Usuario del error: ' . session('larow')[0] . ' error en la iteracion ' . $countfilas . ' ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
}
