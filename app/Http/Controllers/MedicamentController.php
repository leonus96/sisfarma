<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicament;
use App\Laboratory;
use App\Pharmacy;
use App\ActivePrinciple;

class MedicamentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_descripcion' => 'required|max:150',
            'producto_unidad' => 'required',
            'producto_laboratorio' => 'required',
            'producto_principio_activo' => 'required',
            'producto_stock' => 'required|integer',
            'producto_precio_costo' => 'required|decimal',
            'producto_precio_publico' => 'required|decimal',
        ]);

        $laboratory = new Laboratory([
            'nombre' => $request->get('producto_laboratorio'),
            'pharmacy_id' => Pharmacy::ID,
        ]);
        $laboratory->save();

        $active_principle = new ActivePrinciple([
            'nombre' => $request->get('producto_principio_activo'),
            'descripcion' => 'Descripción de prueba',
            'pharmacy_id' => Pharmacy::ID,
        ]);
        $active_principle->save();

        $medicament = new Medicament([
            'descripcion' => $request->get('producto_descripcion'),
            'unidad' => $request->get('producto_unidad'),
            'stock' => $request->get('producto_stock'),
            'precio_costo' => $request->get('producto_precio_costo'),
            'precio_publico' => $request->get('producto_precio_publico'),
            'pharmacy_id' => Pharmacy::ID,
            'laboratory_id' => $laboratory->id,
            'active_principle_id' => $active_principle->id,
        ]);
        $medicament->save();
        return redirect('/home')->with('success', 'Ha sido agregado el medicamento');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
