<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Material;
use App\Http\Requests\MaterialRequest;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $materials= Material::all();
        return view('materials.index', ['materials'=>$materials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('materials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MaterialRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MaterialRequest $request)
    {
        $material = new Material;
		$material->codigo = $request->input('codigo');
        $material->save();

        return to_route('materials.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $material = Material::findOrFail($id);
        return view('materials.show',['material'=>$material]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('materials.edit',['material'=>$material]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MaterialRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MaterialRequest $request, $id)
    {
        $material = Material::findOrFail($id);
		$material->codigo = $request->input('codigo');
        $material->save();

        return to_route('materials.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return to_route('materials.index');
    }
}
