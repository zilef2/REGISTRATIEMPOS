<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Ordentrabajo;
use App\helpers\Myhelp;

use App\helpers\HelpExcel;
use App\Http\Requests\OrdentrabajoRequest;
use App\Imports\PersonalImport;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class OrdentrabajosController extends Controller
{
    public $nombreClase = 'ordentrabajo';
    public $MayusnombreClase = 'Ordentrabajo';
    public $thisAtributos;

    public function __construct()
    {
        $this->thisAtributos = (new Ordentrabajo())->getFillable();
    }

    public function MapearClasePP(&$Ordentrabajos, $numberPermissions)
    {
        $Ordentrabajos = $Ordentrabajos->get()->map(function ($Ordentrabajo) use ($numberPermissions) {
            // $Ordentrabajo->actividad_s = $Ordentrabajo->actividad()->first() !== null ? $Ordentrabajo->actividad()->first()->nombre : '';

            return $Ordentrabajo;
        })->filter();
    }

    public function index(Request $request)
    {
        $permissions = Myhelp::EscribirEnLog($this, $this->nombreClase);
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);
        $user = Auth::user();
        // if($numberPermissions > 1){
        $Ordentrabajos = Ordentrabajo::query();
        // }else{
        // $Ordentrabajos = Ordentrabajo::Where('operario_id',$user->id);
        // }

        if ($request->has('search')) {
            $Ordentrabajos->where(function ($query) use ($request) {
                $query->where('codigo', 'LIKE', "%" . $request->search . "%")
                    ->orWhere('nombre', 'LIKE', "%" . $request->search . "%");
            });
        }
        if ($request->has(['field', 'order'])) {
            $Ordentrabajos = $Ordentrabajos->orderBy($request->field, $request->order);
        }
        $this->MapearClasePP($Ordentrabajos, $numberPermissions);

        // $losSelect = $this->SelectsMasivos($numberPermissions, $atributos_id);

        $perPage = $request->has('perPage') ? $request->perPage : 10;
        $total = $Ordentrabajos->count();
        $page = request('page', 1); // Current page number
        $fromController =  new LengthAwarePaginator(
            $Ordentrabajos->forPage($page, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return Inertia::render('ordentrabajo/Index', [
            'breadcrumbs'           => [['label' => __('app.label.ordentrabajo'), 'href' => route('ordentrabajo.index')]],
            'title'                 => __('app.label.ordentrabajo'),
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
    public function store(OrdentrabajoRequest $request)
    {
        $user = Auth::User();
        Myhelp::EscribirEnLog($this, 'STORE:Ordentrabajos', '', false);

        DB::beginTransaction();
        try {
            $guardar = [];
            foreach ($this->thisAtributos as $value) {
                $guardar[$value] = $request->$value;
            }
            $Ordentrabajo = Ordentrabajo::create($guardar);

            DB::commit();
            Myhelp::EscribirEnLog($this, 'STORE:Ordentrabajos', 'usuario id:' . $user->id . ' | ' . $user->name . ' guardado', false);
            return back()->with('success', __('app.label.created_successfully', ['name' => $Ordentrabajo->name]));
        } catch (\Throwable $th) {
            DB::rollback();
            Myhelp::EscribirEnLog($this, 'STORE:Ordentrabajos', false);
            return back()->with('error', __('app.label.created_error', ['name' => __('app.label.Ordentrabajo')]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
    //fin store functions

    public function show($id)
    {
    }
    public function edit($id)
    {
    }


    public function update(OrdentrabajoRequest $request, $id)
    {
        $user = Auth::User();

        Myhelp::EscribirEnLog($this, 'UPGRADE:Ordentrabajos', '', false);
        DB::beginTransaction();
        try {
            $Ordentrabajo = Ordentrabajo::findOrFail($id);
            foreach ($this->thisAtributos as $value) {
                $guardar[$value] = $request->$value;
            }
            $Ordentrabajo->update($guardar);
            DB::commit();
            Myhelp::EscribirEnLog($this, 'UPDATE:Ordentrabajos', 'usuario id:' . $Ordentrabajo->id . ' | ' . $Ordentrabajo->name . ' actualizado', false);

            return back()->with('success', __('app.label.updated_successfully', ['name' => $Ordentrabajo->name]));
        } catch (\Throwable $th) {
            DB::rollback();
            Myhelp::EscribirEnLog($this, 'UPDATE:Ordentrabajos', 'usuario id:' . $Ordentrabajo->id . ' | ' . $Ordentrabajo->name . '  fallo en el actualizado', false);
            return back()->with('error', __('app.label.updated_error', ['name' => $Ordentrabajo->name]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordentrabajo $Ordentrabajo)
    {
        $permissions = Myhelp::EscribirEnLog($this, 'DELETE:Ordentrabajos');

        try {
            $Ordentrabajo->delete();
            Myhelp::EscribirEnLog($this, 'DELETE:Ordentrabajos', 'usuario id:' . $Ordentrabajo->id . ' | ' . $Ordentrabajo->name . ' borrado', false);
            return back()->with('success', __('app.label.deleted_successfully', ['name' => $Ordentrabajo->name]));
        } catch (\Throwable $th) {
            Myhelp::EscribirEnLog($this, 'DELETE:Ordentrabajos', 'usuario id:' . $Ordentrabajo->id . ' | ' . $Ordentrabajo->name . ' fallo en el borrado:: ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile(), false);
            return back()->with('error', __('app.label.deleted_error', ['name' => $Ordentrabajo->name]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $Ordentrabajo = Ordentrabajo::whereIn('id', $request->id);
            $Ordentrabajo->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . __('app.label.Ordentrabajo')]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . __('app.label.Ordentrabajo')]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
    //FIN : STORE - UPDATE - DELETE

    public function subirexceles()
    { //just  a view
        $permissions = Myhelp::EscribirEnLog($this, ' Ordentrabajo');
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);

        return Inertia::render('Ordentrabajo/subirExceles', [
            'breadcrumbs'   => [['label' => __('app.label.Ordentrabajo'), 'href' => route('Ordentrabajo.index')]],
            'title'         => __('app.label.Ordentrabajo'),
            'numUsuarios'   => count(Ordentrabajo::all()) - 1,
            // 'UniversidadSelect'   => Universidad::all()
        ]);
    }


    // Duplicate entry '1152194566' for key 'Ordentrabajos_identificacion_unique'
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

                Myhelp::EscribirEnLog($this, 'IMPORT:Ordentrabajos', ' finalizo con exito', false);
                if ($countfilas == 0)
                    return back()->with('success', __('app.label.op_successfully') . ' No hubo cambios');
                else
                    return back()->with('success', __('app.label.op_successfully') . ' Se leyeron ' . $countfilas . ' filas con exito');
            } else {
                return back()->with('error', __('app.label.op_not_successfully') . ' archivo no seleccionado');
            }
        } catch (\Throwable $th) {
            Myhelp::EscribirEnLog($this, 'IMPORT:Ordentrabajos', ' Fallo importacion: ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile(), false);
            return back()->with('error', __('app.label.op_not_successfully') . ' Usuario del error: ' . session('larow')[0] . ' error en la iteracion ' . $countfilas . ' ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
}
