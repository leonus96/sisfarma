<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Input;
use App\ActivePrinciple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ActivePrinciplesController extends Controller
{
    protected $create_rules = [
        'nombre' => 'required|max:100|unique:active_principles',
        'descripcion' => 'required|max:250',
    ];

    public function index()
    {
        $principles = ActivePrinciple::all();
        return view('active_principles.index', compact('principles'));
    }

    public function create()
    {
        return view('active_principles.create');
    }

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

      public function show($id)
    {

    }

    public function edit($id)
    {
        $principle = ActivePrinciple::find($id);
        return view('active_principles.edit', compact('principle'));
    }

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

    public function destroy($id)
    {
        $principle = ActivePrinciple::find($id);
        $principle->delete();
        return redirect('/principle')->with('success', 'El principio activo ha sido eliminado exitosamente');
    }

    public function ajaxStore(Request $request) {
        $validator = Validator::make(Input::all(), $this->create_rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $active = new ActivePrinciple([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);
            $active->save();
            return response()->json($active);
        }
    }

    public function autocomplete(Request $request) {
        $data = [];
        if($request->query('q') != null) {
            //dd($request->query('q')['term']);
            $search = $request->query('q')['term'];
            $data = DB::table('active_principles')
                        ->select('id', 'nombre')
                        ->where('nombre', 'LIKE', '%'.$search.'%')
                        ->get();
        }
        return response()->json($data);
    }
}
