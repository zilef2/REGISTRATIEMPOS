<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Ordentrabajo;
use App\Http\Requests\OrdentrabajoRequest;

class OrdentrabajosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $ordentrabajos= Ordentrabajo::all();
        return view('ordentrabajos.index', ['ordentrabajos'=>$ordentrabajos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('ordentrabajos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrdentrabajoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrdentrabajoRequest $request)
    {
        $ordentrabajo = new Ordentrabajo;
		$ordentrabajo->codigo = $request->input('codigo');
        $ordentrabajo->save();

        return to_route('ordentrabajos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $ordentrabajo = Ordentrabajo::findOrFail($id);
        return view('ordentrabajos.show',['ordentrabajo'=>$ordentrabajo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $ordentrabajo = Ordentrabajo::findOrFail($id);
        return view('ordentrabajos.edit',['ordentrabajo'=>$ordentrabajo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrdentrabajoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrdentrabajoRequest $request, $id)
    {
        $ordentrabajo = Ordentrabajo::findOrFail($id);
		$ordentrabajo->codigo = $request->input('codigo');
        $ordentrabajo->save();

        return to_route('ordentrabajos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $ordentrabajo = Ordentrabajo::findOrFail($id);
        $ordentrabajo->delete();

        return to_route('ordentrabajos.index');
    }
}
