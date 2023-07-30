<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Pieza;
use App\Http\Requests\PiezaRequest;

class PiezasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $piezas= Pieza::all();
        return view('piezas.index', ['piezas'=>$piezas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('piezas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PiezaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PiezaRequest $request)
    {
        $pieza = new Pieza;
		$pieza->codigo = $request->input('codigo');
        $pieza->save();

        return to_route('piezas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $pieza = Pieza::findOrFail($id);
        return view('piezas.show',['pieza'=>$pieza]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $pieza = Pieza::findOrFail($id);
        return view('piezas.edit',['pieza'=>$pieza]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PiezaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PiezaRequest $request, $id)
    {
        $pieza = Pieza::findOrFail($id);
		$pieza->codigo = $request->input('codigo');
        $pieza->save();

        return to_route('piezas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $pieza = Pieza::findOrFail($id);
        $pieza->delete();

        return to_route('piezas.index');
    }
}
