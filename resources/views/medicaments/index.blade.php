@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Medicamentos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Medicamentos</a></li>
                        <li class="breadcrumb-item active">Index</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Medicamentos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="pedido" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Unidad</th>
                                <th>Laboratorio</th>
                                <th>Principio activo</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Panadol</td>
                                    <td>1g</td>
                                    <td>Laboratorio</td>
                                    <td>Parecetamol</td>
                                    <td>
                                        <a href="/medicament/1/edit" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="#" method="POST" class="form-button">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
