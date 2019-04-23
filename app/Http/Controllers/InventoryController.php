<?php

namespace App\Http\Controllers;

use App\ActivePrinciple;
use App\Inventory;
use App\Medicament;
use Illuminate\Http\Request;
use App\Pharmacy;
use Illuminate\Support\Facades\DB;
use App\Expense;
use Carbon\Carbon;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::with('medicament')->get();
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
        $request->validate([
            'medicament_id' => 'required',
            'stock' => 'required',
            'precio_costo' => 'required',
            'precio_publico' => 'required',
            'fecha_vencimiento' => 'sometimes',
            'active_principle' => 'sometimes',
        ]);

        if($request->get('active_principle')) {
            $medicament = Medicament::find($request->get('medicament_id'));
            $principle = new ActivePrinciple([
                'nombre' => $request->get('active_principle'),
                'descripcion' => $request->get('active_principle'),
            ]);
            $principle->save();
            $medicament->active_principle_id = $principle->id;
            $medicament->save();
        }

        $inventory = Inventory::where('medicament_id', $request->get('medicament_id'))
            ->get()
            ->first();
        if($inventory) {
            $inventory->stock = $inventory->stock + $request->get('stock');
            $inventory->precio_publico =  $request->get('precio_publico');
        } else {
            $inventory = new Inventory([
                'stock' => $request->get('stock'),
                'precio_costo' => $request->get('precio_costo'),
                'precio_publico' => $request->get('precio_publico'),
                'medicament_id' => $request->get('medicament_id'),
                'fecha_vencimiento' => $request->get('fecha_vencimiento'),
                'pharmacy_id' => Pharmacy::ID,
            ]);
        }

        $inventory->save();

        if ($request->get('gasto')) {
            $expense = new Expense([
                'descripcion' => $inventory->medicament->nombre,
                'monto_total' => $inventory->precio_costo * $inventory->stock,
                'fecha' => Carbon::now(),
                'pharmacy_id' => Pharmacy::ID,
            ]);
            $expense->save();
            return redirect('/inventory')->with('success', 'El producto se registró correctamente en el inventario y además como gasto.');
        }

        return redirect('/inventory')->with('success', 'El producto se registró correctamente en el inventario.');
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
        $inventory = Inventory::find($id);
        $inventory->delete();
        return redirect('/inventory')->with('success', 'El producto se eliminó del inventario.');
    }

    public function getInventoryByIdMedicament($idProduct) {
        $inventories = Inventory::where('medicament_id', $idProduct)->get();
        return response()->json($inventories);
    }

    public function getInventoriesByPrincipleActive($idActive) {
        //dd($idActive);
        if($idActive == 'null') {
            return response()->json([]);
        }
        $inventories = DB::table('inventories')
            ->join('medicaments', 'medicaments.id', '=', 'inventories.medicament_id')
            ->join('active_principles', 'active_principles.id', '=', 'medicaments.active_principle_id')
            ->join('laboratories', 'laboratories.id', '=', 'medicaments.laboratory_id')
            ->select('inventories.id',
                'medicaments.nombre',
                'medicaments.concentracion',
                'medicaments.forma_farmaceutica_simp',
                'medicaments.presentacion',
                'laboratories.nombre as laboratory_name',
                'inventories.stock',
                'inventories.precio_publico',
                'active_principles.nombre as active_nombre')
            ->where('active_principles.id', $idActive)
            ->get();
        return response()->json($inventories);
    }

    public function autocomplete(Request $request) {
        $data = [];
        if($request->query('q') != null) {
            //dd($request->query('q')['term']);
            $search = $request->query('q')['term'];
            $data = DB::table('inventories')
                        ->join('medicaments', 'medicaments.id', '=', 'inventories.medicament_id')
                        ->join('laboratories', 'laboratories.id', '=', 'medicaments.laboratory_id')
                        ->select('inventories.id', 'medicaments.nombre', 'medicaments.concentracion', 'medicaments.forma_farmaceutica_simp', 'medicaments.presentacion', 'laboratories.nombre as laboratoryName', 'inventories.stock', 'inventories.precio_publico')
                        ->where('medicaments.nombre', 'LIKE', '%'.$search.'%')
                        ->get();
        }
        return response()->json($data);
    }
}
