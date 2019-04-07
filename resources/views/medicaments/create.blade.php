@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Medicamentos en General</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Medicamentos</a></li>
                        <li class="breadcrumb-item active">Registrar</li>
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
                                        <select name="selectLaboratory" id="selectLaboratory" class="selectLaboratory form-control"></select>
                                    <input type="text" class="form-control" style="display:none;" id="producto_laboratorio" placeholder="Laboratorio">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <div class="label-with-modal">
                                    <label for="producto_principio_activo" class="mt-1">Principio activo</label>
                                    <button type="button" class="btn btn-sm btn-success mb-2 ml-1" data-toggle="modal" data-target="#new_active_modal">Nuevo</button>
                                </div>
                                <select name="selectPrinciple" id="selectPrinciple" class="selectPrinciple form-control"></select>
                                <input type="text" class="form-control" style="display:none;" id="producto_principio_activo" placeholder="Principio activo">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Añadir medicamento</button>
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
    <div class="modal fade ultramodal" id="new_active_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nuevo Principio Activo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="new_active_form">
                    <div class="modal-body row">
                        <div class="form-group col-12">
                            <label for="new_active_name">Nombre</label>
                            <input required type="text" class="form-control" id="new_active_name">
                            <p class="modal_error error_active_name alert alert-danger"></p>
                        </div>
                        <div class="form-group col-12">
                            <label for="new_active_description">Descripción</label>
                            <textarea required class="form-control" id="new_active_description"></textarea>
                            <p class="modal_error error_active_description alert alert-danger"></p>
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

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.error_laboratory_name').hide();
        $('.error_active_name').hide();
        $('.error_active_description').hide();

        $('#new_laboratory_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/save_laboratory',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nombre': $('#new_laboratory_name').val(),
                },
                success: function(data) {
                    $('.error_laboratory_name').hide();
                    if (data.errors) {
                        alert('😥, existen algunos errores de validación!');
                        $('.error_laboratory_name').text(data.errors.nombre);
                        $('.error_laboratory_name').show();
                        setTimeout(function() {
                            $('.error_laboratory_name').hide();
                        }, 5000);
                    } else {
                        alert('😄, laboratorio registrado exitosamente!')
                        $('#new_laboratory_modal').modal('toggle');
                        $('#new_laboratory_name').val('');
                    }
                },
                error: function(errors) {
                    console.log(errors);
                },
            });
        });

        $('#new_active_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/save_active',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nombre': $('#new_active_name').val(),
                    'descripcion': $('#new_active_description').val(),
                },
                success: function(data) {
                    $('.error_active_name').hide();
                    $('.error_active_description').hide();
                    if (data.errors) {
                        alert('😥, existen algunos errores de validación!');
                        $('.error_active_name').text(data.errors.nombre);
                        $('.error_active_description').text(data.errors.descripcion);
                        $('.error_active_name').show();
                        $('.error_active_description').show();
                        setTimeout(function() {
                            $('.error_active_name').hide();
                            $('.error_active_description').hide();
                        }, 5000);
                    } else {
                        alert('😄, principio activo registrado exitosamente!')
                        $('#new_active_modal').modal('toggle');
                        $('#new_active_name').val('');
                        $('#new_active_description').val('');
                    }
                },
                error: function(errors) {
                    console.log(errors);
                },
            });
        });
    });


    $('.selectLaboratory').select2({
        placeholder: 'Busca laboratorio',
        ajax: {
            url: '/select-laboratory',
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
                    results: $.map(data, function (laboratory) {
                        return {
                            text: laboratory.nombre,
                            id: laboratory.id,
                        }
                    })
                };
            },
            cache: true,
        },
    });

    $('.selectPrinciple').select2({
        placeholder: 'Busca principio activo',
        ajax: {
            url: '/select-principle',
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
                    results: $.map(data, function (principle) {
                        return {
                            text: principle.nombre,
                            id: principle.id,
                        }
                    })
                };
            },
            cache: true,
        },
    });
</script>
@endsection
