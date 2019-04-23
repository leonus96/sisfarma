@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reporte de ventas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ventas</a></li>
                        <li class="breadcrumb-item active">Reporte</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form role="form">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="selectDate">Selecciona fecha</label>
                                    <input class="form-control" type="date" id="selectDate" name="selectDate" min="2019-01-01" value="{{$date}}">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="pedido" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Monto</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ $sale->fecha }}</td>
                                        @if($sale->customer)
                                            <td>{{ $sale->customer->nombre }}</td>
                                        @else
                                            <td> - </td>
                                        @endif
                                        <td>{{$sale->cantidad}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                            </table>
                        </div>
                        <div class="card-footer">
                            <h3>Ventas totales: {{$monto_total}}</h3>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('script')
<script>
    $('#selectDate').change(function () {
       var date = $('#selectDate').val();
       window.location.href = '/sale/search/' + date;
    });
</script>
@endsection
