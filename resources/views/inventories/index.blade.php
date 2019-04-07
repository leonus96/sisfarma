@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Inventario de medicamentos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inventario</a></li>
                        <li class="breadcrumb-item active">Modificar</li>
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
                        <a href="{{ route('inventory.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Agregar nuevo producto al inventario
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="pedido" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Cantidad</th>
                                <th>Precio costo</th>
                                <th>Precio público</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($inventories as $inventory)
                                <tr>
                                    <td>{{ $inventory->medicament->descripcion }}</td>
                                    <td>{{ $inventory->stock }}</td>
                                    <td>{{ $inventory->precio_costo }}</td>
                                    <td>{{ $inventory->precio_publico }}</td>
                                    <td>
                                        <a href="{{ route('inventory.edit', $inventory->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST" class="form-button">
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
