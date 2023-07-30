<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Actividad;
use App\Http\Requests\ActividadRequest;

class ActividadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $actividads= Actividad::all();
        return view('actividads.index', ['actividads'=>$actividads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('actividads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ActividadRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ActividadRequest $request)
    {
        $actividad = new Actividad;
		$actividad->codigo = $request->input('codigo');
        $actividad->save();

        return to_route('actividads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $actividad = Actividad::findOrFail($id);
        return view('actividads.show',['actividad'=>$actividad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $actividad = Actividad::findOrFail($id);
        return view('actividads.edit',['actividad'=>$actividad]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ActividadRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ActividadRequest $request, $id)
    {
        $actividad = Actividad::findOrFail($id);
		$actividad->codigo = $request->input('codigo');
        $actividad->save();

        return to_route('actividads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->delete();

        return to_route('actividads.index');
    }
}
