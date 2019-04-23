<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Sale;
use App\SaleDetail;
use App\Inventory;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::with('customer')->get();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "details" => "required",
            "total" => "required",
        ]);

        $details = $request->details;
        $sale = new Sale([
            'fecha'         => Carbon::now()->format('Y/m/d'),
            'customer_id'   => $request->customer_id,
            'cantidad'      => $request->total,
        ]);

        $sale->save();
        foreach(json_decode($details[0]) as $detail) {
            $det = new SaleDetail([
                'cantidad'      => $detail->cantidad,
                'inventory_id'  => $detail->id_inventory,
                'sale_id'       => $sale->id,
            ]);
            $inventory = Inventory::find($detail->id_inventory);
            $inventory->stock = $inventory->stock - $detail->cantidad;
            $inventory->save();
            $det->save();
        }
        return redirect('/home')->with('success', 'Venta registrada!');

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
        $sale = Sale::find($id);
        $sale->delete();
        return redirect('/sales/search/now')->with('success', 'La venta se anuló.');
    }

    public function indexByDate($date) {
        $monto_total = 0;
        if($date != 'now') {
            $sales = Sale::whereDate('created_at', $date)->get();
        } else {
            $date = Carbon::now()->toDateString();
            $sales = Sale::whereDate('created_at', $date)->get();
        }
        foreach ($sales as $sale) {
            $monto_total = $monto_total + $sale->cantidad;
        }
        return view('sales.index', compact('sales', 'date', 'monto_total'));
    }
}
