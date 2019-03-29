<?php

namespace App\Http\Controllers;

use App\ActivePrinciple;
use Illuminate\Http\Request;

class ActivePrinciplesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $principles = ActivePrinciple::all();
        return view('active_principles.index', compact('principles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('active_principles.create');
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
            'nombre' => 'required|max:100|unique:active_principles',
            'descripcion' => 'required|max:250',
        ]);
        $principle = new ActivePrinciple([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
        ]);
        $principle->save();
        return redirect('/principle')->with('success', 'El principio activo ha sido añadido exitósamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $principle = ActivePrinciple::find($id);
        return view('active_principles.edit', compact('principle'));
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
            'nombre' => 'required|max:100|unique:active_principles,nombre, ' . $id,
            'descripcion' => 'required|max:250',
        ]);
        $principle = ActivePrinciple::find($id);
        $principle->nombre = $request->get('nombre');
        $principle->descripcion = $request->get('descripcion');
        $principle->save();
        return redirect('/principle')->with('succces', 'El principio activo ha sido actualizado exitósamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $principle = ActivePrinciple::find($id);
        $principle->delete();
        return redirect('/principle')->with('success', 'El principio activo ha sido eliminado exitosamente');
    }
}
