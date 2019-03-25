@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Inventario de medicamentos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inventario</a></li>
                        <li class="breadcrumb-item active">Modificar</li>
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
                        <h3 class="card-title">Ingresar medicamento</h3>
                    </div>
                    <form role="form">
                        <div class="card-body">
                            <div class="form-group col-12">
                                <label for="producto_descripcion">Descripción</label>
                                <input type="text" class="form-control" id="producto_descripcion" placeholder="Descripción">
                            </div>

                            <div class="row col-12">
                                <div class="form-group col-6">
                                    <label for="producto_unidad">Unidad</label>
                                    <input type="text" class="form-control" id="producto_unidad" placeholder="Unidad">
                                </div>
                                <div class="form-group col-6">
                                    <label for="producto_unidad">Laboratorio</label>
                                    <input type="text" class="form-control" id="producto_laboratorio" placeholder="Laboratorio">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="producto_principio_activo">Principio activo</label>
                                <input type="text" class="form-control" id="producto_principio_activo" placeholder="Principio activo">
                            </div>
                            <div class="row col-12">
                                <div class="form-group col-4">
                                    <label for="producto_unidad">Stock</label>
                                    <input type="number" class="form-control" id="producto_unidad" placeholder="Unidad">
                                </div>
                                <div class="form-group col-4">
                                    <label for="producto_unidad">Precio de costo</label>
                                    <input type="number" class="form-control" id="producto_laboratorio" placeholder="Laboratorio">
                                </div>
                                <div class="form-group col-4">
                                    <label for="producto_unidad">Precio público</label>
                                    <input type="number" class="form-control" id="producto_laboratorio" placeholder="Laboratorio">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" for="exampleCheck2">Ingresar como gasto</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Añadir a inventario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
