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
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary float-right" id="daterange-btn">
                                        <i class="fa fa-calendar"></i> Selecciona fecha
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="pedido" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Unidad</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Trident</td>
                                    <td>Internet
                                        Explorer 4.0
                                    </td>
                                    <td>Win 95+</td>
                                    <td> 4</td>
                                    <td>X</td>
                                </tr>
                                </tbody>
                                <tfoot>
                            </table>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
