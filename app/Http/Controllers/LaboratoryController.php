<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Laboratory;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratories = Laboratory::all();
        return view('laboratories.index', compact('laboratories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laboratories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:laboratories',
        ]);
        $laboratory = new Laboratory([
            'nombre' => $request->get('nombre'),
        ]);
        $laboratory->save();
        return redirect('/laboratory')->with('success', 'El laboratorio ha sido añadido exitósamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laboratory = Laboratory::find($id);
        return view('laboratories.edit', compact('laboratory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:laboratories,nombre, ' . $id,
        ]);
        $laboratory = Laboratory::find($id);
        $laboratory->nombre = $request->get('nombre');
        $laboratory->save();
        return redirect('/laboratory')->with('succces', 'El laboratorio ha sido actualizado exitósamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $laboratory = Laboratory::find($id);
        $laboratory->delete();
        return redirect('/laboratory')->with('success', 'El laboratorio ha sido eliminado exitosamente');
    }
}
