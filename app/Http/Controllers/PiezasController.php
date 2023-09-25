<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Pieza;
use App\helpers\Myhelp;

use App\helpers\HelpExcel;
use App\Http\Requests\PiezaRequest;
use App\Imports\PersonalImport;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;


class PiezasController extends Controller
{
    public $nombreClase = 'Pieza';
    public $MayusnombreClase = 'Pieza';
    public $thisAtributos;

    public function __construct()
    {
        $this->thisAtributos = (new Pieza())->getFillable();
    }

    public function MapearClasePP(&$Piezas, $numberPermissions)
    {
        $Piezas = $Piezas->get()->map(function ($Pieza) use ($numberPermissions) {
            // $Pieza->Pieza_s = $Pieza->Pieza()->first() !== null ? $Pieza->Pieza()->first()->nombre : '';

            return $Pieza;
        })->filter();
    }

    public function index(Request $request)
    {
        $permissions = Myhelp::EscribirEnLog($this, $this->nombreClase);
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);
        $user = Auth::user();

        // if($numberPermissions > 1){
        $Piezas = Pieza::query();
        // }else{
        //     $Piezas = Pieza::Where('operario_id',$user->id);
        // }

        if ($request->has('search')) {
            $Piezas->where(function ($query) use ($request) {
                $query->where('codigo', 'LIKE', "%" . $request->search . "%")
                    ->orWhere('nombre', 'LIKE', "%" . $request->search . "%");
            });
        }
        if ($request->has(['field', 'order'])) {
            $Piezas = $Piezas->orderBy($request->field, $request->order);
        }
        $this->MapearClasePP($Piezas, $numberPermissions);

        // $losSelect = $this->SelectsMasivos($numberPermissions, $atributos_id);

        $perPage = $request->has('perPage') ? $request->perPage : 10;
        $total = $Piezas->count();
        $page = request('page', 1); // Current page number
        $fromController =  new LengthAwarePaginator(
            $Piezas->forPage($page, $perPage),
            $total,
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return Inertia::render('pieza/Index', [
            'breadcrumbs'           => [['label' => __('app.label.pieza'), 'href' => route('pieza.index')]],
            'title'                 => __('app.label.pieza'),
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
    public function store(PiezaRequest $request)
    {
        $user = Auth::User();
        Myhelp::EscribirEnLog($this, 'STORE:Piezas', '', false);

        DB::beginTransaction();
        try {
            $guardar = [];
            foreach ($this->thisAtributos as $value) {
                $guardar[$value] = $request->$value;
            }
            $Pieza = Pieza::create($guardar);

            DB::commit();
            Myhelp::EscribirEnLog($this, 'STORE:Piezas', 'usuario id:' . $user->id . ' | ' . $user->name . ' guardado', false);
            return back()->with('success', __('app.label.created_successfully', ['name' => $Pieza->name]));
        } catch (\Throwable $th) {
            DB::rollback();
            Myhelp::EscribirEnLog($this, 'STORE:Piezas', false);
            return back()->with('error', __('app.label.created_error', ['name' => __('app.label.Pieza')]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
    //fin store functions

    public function show($id)
    {
    }
    public function edit($id)
    {
    }


    public function update(PiezaRequest $request, $id)
    {
        $user = Auth::User();

        Myhelp::EscribirEnLog($this, 'UPGRADE:Piezas', '', false);
        DB::beginTransaction();
        try {
            $Pieza = Pieza::findOrFail($id);
            foreach ($this->thisAtributos as $value) {
                $guardar[$value] = $request->$value;
            }
            $Pieza->update($guardar);
            DB::commit();
            Myhelp::EscribirEnLog($this, 'UPDATE:Piezas', 'usuario id:' . $Pieza->id . ' | ' . $Pieza->name . ' actualizado', false);

            return back()->with('success', __('app.label.updated_successfully', ['name' => $Pieza->name]));
        } catch (\Throwable $th) {
            DB::rollback();
            Myhelp::EscribirEnLog($this, 'UPDATE:Piezas', 'usuario id:' . $Pieza->id . ' | ' . $Pieza->name . '  fallo en el actualizado', false);
            return back()->with('error', __('app.label.updated_error', ['name' => $Pieza->name]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pieza $Pieza)
    {
        $permissions = Myhelp::EscribirEnLog($this, 'DELETE:Piezas');

        try {
            $Pieza->delete();
            Myhelp::EscribirEnLog($this, 'DELETE:Piezas', 'usuario id:' . $Pieza->id . ' | ' . $Pieza->name . ' borrado', false);
            return back()->with('success', __('app.label.deleted_successfully', ['name' => $Pieza->name]));
        } catch (\Throwable $th) {
            Myhelp::EscribirEnLog($this, 'DELETE:Piezas', 'usuario id:' . $Pieza->id . ' | ' . $Pieza->name . ' fallo en el borrado:: ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile(), false);
            return back()->with('error', __('app.label.deleted_error', ['name' => $Pieza->name]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }

    public function destroyBulk(Request $request)
    {
        try {
            $Pieza = Pieza::whereIn('id', $request->id);
            $Pieza->delete();
            return back()->with('success', __('app.label.deleted_successfully', ['name' => count($request->id) . ' ' . __('app.label.Pieza')]));
        } catch (\Throwable $th) {
            return back()->with('error', __('app.label.deleted_error', ['name' => count($request->id) . ' ' . __('app.label.Pieza')]) . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
    //FIN : STORE - UPDATE - DELETE

    public function subirexceles()
    { //just  a view
        $permissions = Myhelp::EscribirEnLog($this, ' Pieza');
        $numberPermissions = Myhelp::getPermissionToNumber($permissions);

        return Inertia::render('Pieza/subirExceles', [
            'breadcrumbs'   => [['label' => __('app.label.Pieza'), 'href' => route('Pieza.index')]],
            'title'         => __('app.label.Pieza'),
            'numUsuarios'   => count(Pieza::all()) - 1,
            // 'UniversidadSelect'   => Universidad::all()
        ]);
    }


    // Duplicate entry '1152194566' for key 'Piezas_identificacion_unique'
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

                Myhelp::EscribirEnLog($this, 'IMPORT:Piezas', ' finalizo con exito', false);
                if ($countfilas == 0)
                    return back()->with('success', __('app.label.op_successfully') . ' No hubo cambios');
                else
                    return back()->with('success', __('app.label.op_successfully') . ' Se leyeron ' . $countfilas . ' filas con exito');
            } else {
                return back()->with('error', __('app.label.op_not_successfully') . ' archivo no seleccionado');
            }
        } catch (\Throwable $th) {
            Myhelp::EscribirEnLog($this, 'IMPORT:Piezas', ' Fallo importacion: ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile(), false);
            return back()->with('error', __('app.label.op_not_successfully') . ' Usuario del error: ' . session('larow')[0] . ' error en la iteracion ' . $countfilas . ' ' . $th->getMessage() . ' L:' . $th->getLine() . ' Ubi: ' . $th->getFile());
        }
    }
}
