<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Centrotrabajo;
use App\Http\Requests\CentrotrabajoRequest;

class CentrotrabajosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $centrotrabajos= Centrotrabajo::all();
        return view('centrotrabajos.index', ['centrotrabajos'=>$centrotrabajos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('centrotrabajos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CentrotrabajoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CentrotrabajoRequest $request)
    {
        $centrotrabajo = new Centrotrabajo;
		$centrotrabajo->codigo = $request->input('codigo');
        $centrotrabajo->save();

        return to_route('centrotrabajos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $centrotrabajo = Centrotrabajo::findOrFail($id);
        return view('centrotrabajos.show',['centrotrabajo'=>$centrotrabajo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $centrotrabajo = Centrotrabajo::findOrFail($id);
        return view('centrotrabajos.edit',['centrotrabajo'=>$centrotrabajo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CentrotrabajoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CentrotrabajoRequest $request, $id)
    {
        $centrotrabajo = Centrotrabajo::findOrFail($id);
		$centrotrabajo->codigo = $request->input('codigo');
        $centrotrabajo->save();

        return to_route('centrotrabajos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $centrotrabajo = Centrotrabajo::findOrFail($id);
        $centrotrabajo->delete();

        return to_route('centrotrabajos.index');
    }
}
