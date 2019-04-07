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
                    <form role="form" method="POST" action="{{ route('medicament.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group col-12">
                                <label for="producto_descripcion">Descripción</label>
                                <input type="text" class="form-control" id="producto_descripcion" placeholder="Descripción">
                            </div>

                            <div class="row col-12">
                                <div class="form-group col-6">
                                    <label for="producto_unidad" class="mt-1">Unidad</label>
                                    <input type="text" class="form-control" id="producto_unidad" placeholder="Unidad">
                                </div>
                                <div class="form-group col-6">
                                        <label for="producto_laboratorio" class="mt-1">Laboratorio</label>
                                        <button type="button" class="btn btn-sm btn-success mb-2 ml-1" data-toggle="modal" data-target="#new_laboratory_modal">Nuevo</button>
                                    <input type="text" class="form-control" id="producto_laboratorio" placeholder="Laboratorio">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <div class="label-with-modal">
                                    <label for="producto_principio_activo" class="mt-1">Principio activo</label>
                                    <button type="button" class="btn btn-sm btn-success mb-2 ml-1" data-toggle="modal" data-target="#new_active_modal">Nuevo</button>
                                </div>
                                <input type="text" class="form-control" id="producto_principio_activo" placeholder="Principio activo">
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
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Añadir a inventario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Add Laboratory Modal --}}
    <div class="modal fade ultramodal" id="new_laboratory_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nuevo Laboratorio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="new_laboratory_form">
                    <div class="modal-body row">
                        <div class="form-group col-12">
                            <label for="new_laboratory_name">Nombre</label>
                            <input required type="text" class="form-control" id="new_laboratory_name">
                            <p class="modal_error error_laboratory_name alert alert-danger"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Add Active Principle Modal --}}
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
