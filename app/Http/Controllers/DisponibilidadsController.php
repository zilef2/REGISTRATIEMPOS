<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Disponibilidad;
use App\Http\Requests\DisponibilidadRequest;

class DisponibilidadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $disponibilidads= Disponibilidad::all();
        return view('disponibilidads.index', ['disponibilidads'=>$disponibilidads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('disponibilidads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DisponibilidadRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DisponibilidadRequest $request)
    {
        $disponibilidad = new Disponibilidad;
		$disponibilidad->codigo = $request->input('codigo');
        $disponibilidad->save();

        return to_route('disponibilidads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $disponibilidad = Disponibilidad::findOrFail($id);
        return view('disponibilidads.show',['disponibilidad'=>$disponibilidad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $disponibilidad = Disponibilidad::findOrFail($id);
        return view('disponibilidads.edit',['disponibilidad'=>$disponibilidad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DisponibilidadRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DisponibilidadRequest $request, $id)
    {
        $disponibilidad = Disponibilidad::findOrFail($id);
		$disponibilidad->codigo = $request->input('codigo');
        $disponibilidad->save();

        return to_route('disponibilidads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $disponibilidad = Disponibilidad::findOrFail($id);
        $disponibilidad->delete();

        return to_route('disponibilidads.index');
    }
}
