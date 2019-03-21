@extends('layouts.app')

@section('title', 'Laboratorios')

@section('content')
<h1 class="display-2 text-center mb-3">Tabla Laboratorios</h1>
<div class="container">
    <div class="row mb-5">
        <a href="{{ route('laboratory.create')}}" class="btn btn-lg btn-info">Agregar Nuevo Laboratorio</a>
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
                    <td>Laboratorio</td>
                    <td>Acción</td>
                </tr>
            </thead>
            <tbody>
                @foreach($laboratories as $laboratory)
                <tr>
                    <td>{{ $laboratory->nombre }}</td>
                    <td class="centered">
                        <a href="{{ route('laboratory.edit',$laboratory->id)}}" class="btn btn-primary">Editar</a>
                        <form class="form-button" action="{{ route('laboratory.destroy', $laboratory->id)}}" method="POST">
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
