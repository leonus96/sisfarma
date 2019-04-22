<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OtherUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'email' => 'required|email',
            'rol' => 'required|max:8',
            'password' => 'required|min:3|max:16',
            'password_confirmation' => 'required|min:3|max:16',
        ]);
        if($request->get('password') != $request->get('password_confirmation')) {
            return redirect('/users/create')->withErrors(['La contraseña no coincide']);
        }
        $user = new User([
            'nombre' => $request->get('nombre'),
            'email' => $request->get('email'),
            'rol' => $request->get('rol'),
            'password' => bcrypt($request->get('password')),
            'pharmacy_id' => Pharmacy::ID,
        ]);
        $user->save();
        return redirect('/users')->with('success', 'Usuario añadido!');
    }

    public function destroy($id) {
        $inventory = User::find($id);
        $inventory->delete();
        return redirect('/users')->with('success', 'El usuario se eliminó.');
    }


}
