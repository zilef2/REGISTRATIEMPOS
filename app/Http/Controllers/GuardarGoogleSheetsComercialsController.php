<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\GuardarGoogleSheetsComercial;
use App\Http\Requests\GuardarGoogleSheetsComercialRequest;

class GuardarGoogleSheetsComercialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $guardargooglesheetscomercials= GuardarGoogleSheetsComercial::all();
        return view('guardargooglesheetscomercials.index', ['guardargooglesheetscomercials'=>$guardargooglesheetscomercials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('guardargooglesheetscomercials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GuardarGoogleSheetsComercialRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GuardarGoogleSheetsComercialRequest $request)
    {
        $guardargooglesheetscomercial = new GuardarGoogleSheetsComercial;
		$guardargooglesheetscomercial->Nombre_tablero = $request->input('Nombre tablero');
		// $guardargooglesheetscomercial->OT+Item = $request->input('OT+Item');
		// $guardargooglesheetscomercial->avance = $request->input('avance');
		// $guardargooglesheetscomercial->Tiempo estimado Ing. mecanica = $request->input('Tiempo estimado Ing. mecanica');
		// $guardargooglesheetscomercial->Tiempo estimado Ing. electrica = $request->input('Tiempo estimado Ing. electrica');
		// $guardargooglesheetscomercial->Tiempo estimado corte = $request->input('Tiempo estimado corte');
		// $guardargooglesheetscomercial->Tiempo estimado doblez = $request->input('Tiempo estimado doblez');
		// $guardargooglesheetscomercial->Tiempo estimado soldadura = $request->input('Tiempo estimado soldadura');
		// $guardargooglesheetscomercial->Tiempo estimado pulida = $request->input('Tiempo estimado pulida');
		// $guardargooglesheetscomercial->Tiempo estimado ensamble = $request->input('Tiempo estimado ensamble');
		// $guardargooglesheetscomercial->Tiempo estimado cableado = $request->input('Tiempo estimado cableado');
		// $guardargooglesheetscomercial->Tiempo estimado cobre = $request->input('Tiempo estimado cobre');
        $guardargooglesheetscomercial->save();

        return to_route('guardargooglesheetscomercials.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $guardargooglesheetscomercial = GuardarGoogleSheetsComercial::findOrFail($id);
        return view('guardargooglesheetscomercials.show',['guardargooglesheetscomercial'=>$guardargooglesheetscomercial]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $guardargooglesheetscomercial = GuardarGoogleSheetsComercial::findOrFail($id);
        return view('guardargooglesheetscomercials.edit',['guardargooglesheetscomercial'=>$guardargooglesheetscomercial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GuardarGoogleSheetsComercialRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GuardarGoogleSheetsComercialRequest $request, $id)
    {
        $guardargooglesheetscomercial = GuardarGoogleSheetsComercial::findOrFail($id);
		// $guardargooglesheetscomercial->Nombre tablero = $request->input('Nombre tablero');
		// $guardargooglesheetscomercial->OT+Item = $request->input('OT+Item');
		// $guardargooglesheetscomercial->avance = $request->input('avance');
		// $guardargooglesheetscomercial->Tiempo estimado Ing. mecanica = $request->input('Tiempo estimado Ing. mecanica');
		// $guardargooglesheetscomercial->Tiempo estimado Ing. electrica = $request->input('Tiempo estimado Ing. electrica');
		// $guardargooglesheetscomercial->Tiempo estimado corte = $request->input('Tiempo estimado corte');
		// $guardargooglesheetscomercial->Tiempo estimado doblez = $request->input('Tiempo estimado doblez');
		// $guardargooglesheetscomercial->Tiempo estimado soldadura = $request->input('Tiempo estimado soldadura');
		// $guardargooglesheetscomercial->Tiempo estimado pulida = $request->input('Tiempo estimado pulida');
		// $guardargooglesheetscomercial->Tiempo estimado ensamble = $request->input('Tiempo estimado ensamble');
		// $guardargooglesheetscomercial->Tiempo estimado cableado = $request->input('Tiempo estimado cableado');
		// $guardargooglesheetscomercial->Tiempo estimado cobre = $request->input('Tiempo estimado cobre');
        $guardargooglesheetscomercial->save();

        return to_route('guardargooglesheetscomercials.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $guardargooglesheetscomercial = GuardarGoogleSheetsComercial::findOrFail($id);
        $guardargooglesheetscomercial->delete();

        return to_route('guardargooglesheetscomercials.index');
    }
}
