<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicament;
use App\Laboratory;
use App\Pharmacy;
use App\ActivePrinciple;
use Illuminate\Support\Facades\DB;

class MedicamentController extends Controller
{

    public function index()
    {
        $medicamentos = Medicament::with('laboratory', 'activePrinciple')->get();
        return view('medicaments.index', compact('medicamentos'));
    }

    public function create() {
        return view('medicaments.create');
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'medicamento_nombre' => 'required|max:150',
            'medicamento_concentracion' => 'required',
            'medicamento_forma_farmaceutica' => 'sometimes',
            'medicamento_presentacion' => 'sometimes',
            'selectLaboratory' => 'sometimes',
            'selectPrinciple' => 'sometimes',
        ]);


        $medicament = new Medicament([
            'nombre' => $request->get('medicamento_nombre'),
            'concentracion' => $request->get('medicamento_concentracion'),
            'forma_farmaceutica' => $request->get('medicamento_forma_farmaceutica'),
            'presentacion' => $request->get('medicamento_presentacion'),
            'laboratory_id' => $request->get('selectLaboratory'),
            'active_principle_id' => $request->get('selectPrinciple'),
        ]);
        $medicament->save();
        return redirect('/medicament')->with('success', 'Ha sido agregado el medicamento');
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

    public function edit($id)
    {
        $medicament = Medicament::find($id);
        return view('medicaments.edit', compact($medicament));
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        //
    }

    public function autocomplete(Request $request) {
        $data = [];
        if($request->query('q') != null) {
            //dd($request->query('q')['term']);
            $search = $request->query('q')['term'];
            $data = DB::table('medicaments')
                        ->select('medicaments.id',
                            'medicaments.nombre',
                            'medicaments.concentracion',
                            'medicaments.presentacion',
                            'medicaments.forma_farmaceutica_simp',
                            'medicaments.active_principle_id',
                            'laboratories.nombre as laboratory_name')
                        ->join('laboratories', 'laboratories.id', '=', 'medicaments.laboratory_id')
                        ->where('medicaments.nombre', 'LIKE', '%'.$search.'%')
                        ->get();
        }
        return response()->json($data);
    }
}
