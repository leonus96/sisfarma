@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Medicamentos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Medicamentos</a></li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('medicament.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Agregar Medicamento
                        </a>
                    </div>
                    <div class="card-body">
                         <p>Busca cualquier medicamento con CTRL + F</p>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Concentración</th>
                                <th>Forma farmaceútica</th>
                                <th>Principio activo</th>
                                <th>Laboratorio</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicamentos as $medicamento)
                                <tr>
                                    <td>{{ substr($medicamento->nombre, 0, 15) }}</td>
                                    <td>{{ substr($medicamento->concentracion, 0, 15) }}</td>
                                    <td>{{ $medicamento->forma_farmaceutica_simp}}</td>
                                    @if ($medicamento->activePrinciple)
                                        <td>{{ $medicamento->activePrinciple->nombre }}</td>
                                    @else
                                        <td> - </td>
                                    @endif
                                    @if ($medicamento->laboratory)
                                        <td>{{ substr($medicamento->laboratory->nombre, 0, 15) }}</td>
                                    @else
                                        <td> - </td>
                                    @endif
                                    <td>
                                        <a href="{{ route('medicament.edit', $medicamento->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('medicament.destroy', $medicamento->id) }}" method="POST" class="form-button">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
