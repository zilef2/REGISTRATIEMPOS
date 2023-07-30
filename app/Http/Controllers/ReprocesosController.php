<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Reproceso;
use App\Http\Requests\ReprocesoRequest;

class ReprocesosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $reprocesos= Reproceso::all();
        return view('reprocesos.index', ['reprocesos'=>$reprocesos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('reprocesos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ReprocesoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReprocesoRequest $request)
    {
        $reproceso = new Reproceso;
		$reproceso->codigo = $request->input('codigo');
        $reproceso->save();

        return to_route('reprocesos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $reproceso = Reproceso::findOrFail($id);
        return view('reprocesos.show',['reproceso'=>$reproceso]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $reproceso = Reproceso::findOrFail($id);
        return view('reprocesos.edit',['reproceso'=>$reproceso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ReprocesoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ReprocesoRequest $request, $id)
    {
        $reproceso = Reproceso::findOrFail($id);
		$reproceso->codigo = $request->input('codigo');
        $reproceso->save();

        return to_route('reprocesos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $reproceso = Reproceso::findOrFail($id);
        $reproceso->delete();

        return to_route('reprocesos.index');
    }
}
