@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<h1 class="display-2 text-center mb-3">Tabla Clientes</h1>
<div class="container">
    <div class="row mb-5">
        <a href="{{ route('customer.create')}}" class="btn btn-lg btn-info">Agregar nuevo cliente</a>
    </div>
    <div class="row justify-content-center">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            <br/>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>Cliente</td>
                    <td>Dni</td>
                    <td>Acción</td>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->dni }}</td>
                    <td class="centered">
                        <a href="{{ route('customer.edit',$customer->id)}}" class="btn btn-primary">Editar</a>
                        <form class="form-button" action="{{ route('customer.destroy', $customer->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
