<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Pharmacy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monto_total = 0;
        $expenses = Expense::all();
        foreach ($expenses as $expense) {
            $monto_total = $monto_total + $expense->monto_total;
        }
        return view('expenses.index', compact('expenses', 'monto_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'gasto_descripcion' => 'required',
            'gasto_monto' => 'required|numeric|min:1',
            'gasto_fecha' => 'required',
        ]);
        $expense  = new Expense([
            'descripcion' => $request->get('gasto_descripcion'),
            'monto_total' => $request->get('gasto_monto'),
            'fecha' => $request->get('gasto_fecha'),
            'pharmacy_id' => Pharmacy::ID,
        ]);
        $expense->save();
        return redirect('/expense')->with('success', 'Gasto registrado!');
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
        $expense = Expense::find($id);
        $expense->delete();
        return redirect('/expense')->with('success', 'El gasto se eliminó.');
    }

    public function indexByDate($date) {
        $monto_total = 0;
        if($date != 'now') {
            $date = Carbon::parse($date);
            //dd($date);
            $expenses = Expense::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)->get();
        } else {
            $date = Carbon::now();
            $expenses = Expense::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)->get();
        }
        foreach ($expenses as $expense) {
            $monto_total = $monto_total + $expense->monto_total;
        }
        return view('expenses.index', compact('expenses', 'date', 'monto_total'));
    }
}
