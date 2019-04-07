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

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ingresar medicamento</h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('inventory.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group col-12">
                                <select id="medicamentDescription" class="medicamentDescription form-control"></select>
                            </div>
                            <input type="number" style="display:none;" name="medicament_id" id="medicament_id">
                            <div class="row col-12">
                                <div class="form-group col-4">
                                    <label for="producto_stock">Stock</label>
                                    <input type="number" class="form-control" id="producto_stock" placeholder="Stock" name="stock">
                                </div>
                                <div class="form-group col-4">
                                    <label for="producto_precio_costo">Precio de costo</label>
                                    <input type="number" class="form-control" id="producto_precio_costo" placeholder="Laboratorio" name="precio_costo">
                                </div>
                                <div class="form-group col-4">
                                    <label for="producto_precio_publico">Precio público</label>
                                    <input type="number" class="form-control" id="producto_precio_publico" placeholder="Laboratorio" name="preio_publico">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" for="exampleCheck2" name="gasto">Ingresar como gasto</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Añadir a inventario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.error_laboratory_name').hide();
        $('#new_laboratory_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'save_laboratory',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nombre': $('#new_laboratory_name').val(),
                },
                success: function(data) {
                    $('.error_laboratory_name').hide();
                    if (data.errors) {
                        alert('😥, existen algunos errores de validación!')
                        $('.error_laboratory_name').text(data.errors.nombre);
                        $('.error_laboratory_name').show();
                        setTimeout(function() {
                            $('.error_laboratory_name').hide();
                        }, 2500);
                    } else {
                        alert('😄, cliente registrado exitosamente!')
                        $('#new_laboratory_modal').modal('toggle');
                        $('#new_laboratory_name').val('');
                    }
                },
                error: function(errors) {
                    console.log(errors);
                },
            });
        });
    });

    $('.medicamentDescription').select2({
        placeholder: 'Selecciona un medicamento',
        ajax: {
            url: '/select-medicament',
            datatype: 'json',
            delay: 250,
            data: function (term) {
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

    $('#medicamentDescription').change(function () {
        $('#medicament_id').val($('#medicamentDescription').select2('data')[0].id);
    });
</script>
@endsection
