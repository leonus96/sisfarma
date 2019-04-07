<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;

class CustomerController extends Controller
{
    protected $create_rules = [
        'nombre' => 'required|max:100',
        'dni' => 'required|min:8|max:8|unique:customers',
    ];

    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
            'nombre' => 'required|max:100',
            'dni' => 'required|min:8|max:8|unique:customers',
        ]);
        $customer = new Customer([
            'nombre' => $request->get('nombre'),
            'dni' => $request->get('dni'),
        ]);
        $customer->save();
        return redirect('/customer')->with('success', 'Cliente añadido!');
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
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
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
        $customer = Customer::find($id);
        $request->validate([
            'name' => 'max:100',
            'dni' => 'required|min:8|max:8',
        ]);
        $customer->name = $request->get('name');
        $customer->dni = $request->get('dni');
        $customer->save();
        return redirect('/customer')->with('sucess', 'Cliente actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect('/customer')->with('sucess', 'Cliente eliminado');
    }

    public function ajaxStore(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->create_rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $customer = new Customer([
                'nombre' => $request->nombre,
                'dni' => $request->dni,
            ]);
            $customer->save();
            return response()->json($customer);
        }
    }
}
