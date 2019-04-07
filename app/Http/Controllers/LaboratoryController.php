<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Laboratory;
use Illuminate\Support\Facades\DB;

class LaboratoryController extends Controller
{
    protected $create_rules = [
        'nombre' => 'required|max:100',
    ];

    public function index()
    {
        $laboratories = Laboratory::all();
        return view('laboratories.index', compact('laboratories'));
    }

    public function create()
    {
        return view('laboratories.create');
    }

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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $laboratory = Laboratory::find($id);
        return view('laboratories.edit', compact('laboratory'));
    }

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

    public function destroy($id)
    {
        $laboratory = Laboratory::find($id);
        $laboratory->delete();
        return redirect('/laboratory')->with('success', 'El laboratorio ha sido eliminado exitosamente');
    }

    public function ajaxStore(Request $request) {
        $validator = Validator::make(Input::all(), $this->create_rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $laboratory = new Laboratory([
                'nombre' => $request->nombre,
            ]);
            $laboratory->save();
            return response()->json($laboratory);
        }
    }

    public function autocomplete(Request $request) {
        $data = [];
        if($request->query('q') != null) {
            //dd($request->query('q')['term']);
            $search = $request->query('q')['term'];
            $data = DB::table('laboratories')
                        ->select('id', 'nombre')
                        ->where('nombre', 'LIKE', '%'.$search.'%')
                        ->get();
        }
        return response()->json($data);
    }
}
