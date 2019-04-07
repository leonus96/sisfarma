<?php

namespace App\Http\Controllers;

use App\Inventory;
use Illuminate\Http\Request;
use App\Pharmacy;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::all();
        return view('inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        dd($request);

        $inventory = new Inventory([
            'stock' => $request->get('stock'),
            'precio_costo' => $request->get('precio_costo'),
            'precio_publico' => $request->get('precio_publico'),
            'medicament_id' => $request->get('medicament_id'),
            'pharmacy_id' => Pharmacy::ID,
        ]);

        /*if($request->get('gasto')) {

        }*/
        $inventory->save();
        return redirect('/inventory')->with('success', 'Inventario registrado exitósamente.');
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

    public function autocomplete(Request $request) {
        $data = [];
        if($request->query('q') != null) {
            //dd($request->query('q')['term']);
            $search = $request->query('q')['term'];
            $data = DB::table('inventories')
                        ->join('medicaments', 'medicaments.id', '=', 'inventories.medicament_id')
                        ->select('medicaments.descripcion', 'medicaments.unidad', 'inventories.stock', 'inventories.precio_publico')
                        ->where('medicaments.descripcion', 'LIKE', '%'.$search.'%')
                        ->get();
        }
        return response()->json($data);
    }
}
