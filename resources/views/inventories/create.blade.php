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
                    <form role="form" method="POST" action="{{ route('medicament.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group col-12">
                                <select name="medicamentDescription" class="medicamentDescription form-control" multiple="multiple"></select>
                                <!--<label for="producto_descripcion">Descripción</label>
                                <input type="text" class="form-control" id="producto_descripcion" placeholder="Descripción">-->
                            </div>
                            <div class="row col-12">
                                <div class="form-group col-4">
                                    <label for="producto_stock">Stock</label>
                                    <input type="number" class="form-control" id="producto_stock" placeholder="Stock">
                                </div>
                                <div class="form-group col-4">
                                    <label for="producto_precio_costo">Precio de costo</label>
                                    <input type="number" class="form-control" id="producto_precio_costo" placeholder="Laboratorio">
                                </div>
                                <div class="form-group col-4">
                                    <label for="producto_precio_publico">Precio público</label>
                                    <input type="number" class="form-control" id="producto_precio_publico" placeholder="Laboratorio">
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

@section('script')
    <script>
        $('.medicamentDescription').select2({
            placeholder: 'Selecciona un medicamento',
            ajax: {
                url: '/select-medicament',
                datatype: 'json',
                delay: 250,
                data: function (term) {
                    console.log(term);
                    return {
                        q: term
                    };
                },
                processResults: function (data) {
                    return{
                        results: $.map(data, function (medicament) {
                            return {
                                text: medicament.descripcion + ' ' + medicament.unidad,
                                id: medicament.id,
                            }
                        })
                    };
                },
                cache: true,
            },
        });
    </script>
@endsection
