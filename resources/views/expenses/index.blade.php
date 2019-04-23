@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Gastos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Gastos</a></li>
                        <li class="breadcrumb-item active">Índice</li>
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
                        <a href="{{ route('expense.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Agregar nuevo gasto
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="selectDate">Selecciona fecha</label>
                                @if($date->month<10)
                                    <input class="form-control" type="month" id="selectDate" name="selectDate" min="2019-01" value="{{$date->year.'-0'.$date->month}}">
                                @else
                                    <input class="form-control" type="month" id="selectDate" name="selectDate" min="2019-01" value="{{$date->year.'-'.$date->month}}">
                                @endif

                            </div>
                        </div>
                        <table id="pedido" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->descripcion }}</td>
                                    <td>{{ $expense->monto_total }}</td>
                                    <td>{{ $expense->fecha }}</td>
                                    <td>
                                        <a href="{{ route('expense.edit', $expense->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('expense.destroy', $expense->id) }}" method="POST" class="form-button">
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
                        <h3>Gastos totales: {{$monto_total}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('#selectDate').change(function () {
            var date = $('#selectDate').val();
            //console.log(date);
            window.location.href = '/expense/search/' + date;
        });
    </script>
@endsection
