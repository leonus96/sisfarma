@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Vender</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ventas</a></li>
                        <li class="breadcrumb-item active">Vender</li>
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
                        <h3 class="card-title">Productos</h3>
                    </div>
                    <form role="form">
                        <div class="card-body row">
                            <div class="form-group col-12">
                                <label for="medicamento">Buscar medicamento</label>
                                <input type="text" class="form-control" id="medicamento" placeholder="Ingresa medicamento o principio activo a buscar">
                            </div>
                            <div class="form-group col-10">
                                <label for="medicamento">Medicamento</label>
                                <input type="text" disabled class="form-control" id="medicamento">
                            </div>
                            <div class="form-group col-2">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" placeholder="# Unidades">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cliente</h3>
                    </div>
                    <form role="form">
                        <div class="card-body row">
                            <div class="form-group col-12">
                                <label for="cliente">Buscar cliente</label>
                                <input type="text" class="form-control" id="cliente" placeholder="Ingrese DNI del cliente">
                            </div>
                            <div class="form-check col-9">
                                <input type="checkbox" class="form-check-input" name="agregar_cliente" id="agregar_cliente">
                                <label class="form-check-label" for="agregar_cliente">¿Agregar nuevo cliente?</label>
                            </div>
                            <div class="col-9">
                                <label for="nombre">Nombre</label>
                                <input type="text" disabled class="form-control" id="nombre">
                            </div>
                            <div class="col-3">
                                <label for="dni">DNI</label>
                                <input type="text" disabled class="form-control" id="dni">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pedido</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="pedido" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Principio Activo</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Trident</td>
                                <td>Blabla</td>
                                <td>Win 95+</td>
                                <td>4</td>
                                <td>X</td>
                            </tr>
                            </tbody>
                            <tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <!-- card-footer -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Vender</button>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
