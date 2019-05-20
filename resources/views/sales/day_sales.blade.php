@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ventas diarias</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ventas</a></li>
                        <li class="breadcrumb-item active">Ventas diarias</li>
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
                        <a href="/home" class="btn btn-success">
                            Nueva Venta
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="pedido" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Fecha</th>
                                <th>Medicamento</th>
                                <th>Cantidad</th>
                                <th>Monto</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{$sale->id }}</td>
                                    <td>{{ $sale->created_at }}</td>
                                    <td>{{$sale->inventory->medicament->nombre}}</td>
                                    <td>{{$sale->cantidad}}</td>
                                    <td>{{$sale->inventory->precio_publico * $sale->cantidad}}</td>
                                    <td>
                                        <form action="{{ route('sale.destroy', $sale->id) }}" method="POST" class="form-button">
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
                    <div class="card-footer">
                        <h3>Ventas totales: {{$monto_total}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

