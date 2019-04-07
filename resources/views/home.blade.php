@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Vender</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ventas</a></li>
                        <li class="breadcrumb-item active">Vender</li>
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
                    <div class="card-body">
                        <div class="row">
                            <button type="button" class="btn btn-primary ml-3 mb-3" data-toggle="modal" data-target="#new_client_modal">Registrar nuevo cliente</button>
                        </div>
                        <form role="form" class="row">
                            {{ csrf_field() }}
                            <div class="form-group col-12">
                                <select name="" id="DNICustomer" class="DNICustomer form-control"></select>
                                <!--<label for="cliente_search">Buscar cliente</label>
                                <input type="text" class="form-control" id="cliente_search" placeholder="Ingrese DNI del cliente">-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pedido</h3>
                    </div>
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
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Vender</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade ultramodal" id="new_client_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Nuevo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="new_client_form">
                    <div class="modal-body row">
                        <div class="form-group col-12">
                            <label for="new_client_name">Nombre</label>
                            <input required type="text" class="form-control" id="new_client_name">
                            <p class="modal_error error_name alert alert-danger"></p>
                        </div>
                        <div class="col-8">
                            <label for="new_client_dni">DNI</label>
                            <input required type="text" class="form-control" id="new_client_dni" placeholder="Ingrese DNI de 8 dígitos">
                            <p class="modal_error error_dni alert alert-danger"></p>
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
        $('.error_name').hide();
        $('.error_dni').hide();
        $('#new_client_form').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'save_customer',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nombre': $('#new_client_name').val(),
                    'dni': $('#new_client_dni').val(),
                },
                success: function(data) {
                    $('.error_name').hide();
                    $('.error_dni').hide();
                    if (data.errors) {
                        alert('😥, existen algunos errores de validación!')
                        $('.error_name').text(data.errors.nombre);
                        $('.error_dni').text(data.errors.dni);
                        $('.error_name').show();
                        $('.error_dni').show();
                        setTimeout(function() {
                            $('.error_name').hide();
                            $('.error_dni').hide();
                        }, 2500);
                    } else {
                        alert('😄, cliente registrado exitosamente!')
                        $('#new_client_modal').modal('toggle');
                        $('#new_client_name').val('');
                        $('#new_client_dni').val('');
                    }
                },
                error: function(errors) {
                    console.log(errors);
                },
            });
        });
    });

    $('.DNICustomer').select2({
        placeholder: 'Busca por DNI',
        ajax: {
            url: '/select-customer',
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
                    results: $.map(data, function (customer) {
                        return {
                            text: customer.nombre,
                            id: customer.id,
                        }
                    })
                };
            },
            cache: true,
        },
    });

    /*$('#DNICustomer').change(function() {
        $('#nombreCustomer').val()
    });*/
</script>
@endsection
