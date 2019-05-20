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

    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Productos</h3>
                    </div>
                    <div class="card-body row">
                        <div class="form-group col-12">
                            <label for="medicamento">Buscar medicamento</label>
                            <select name="" id="selectInventory" class="selectInventory form-control"></select>
                            <input type="text" id="medicamento" placeholder="Ingresa medicamento o principio activo a buscar" style="display:none;">
                        </div>
                        <div class="options col-12">
                        </div>
                        <div class="form-group col-4">
                            <label for="medicamento">Precio</label>
                            <input id="medicamento_precio" type="text" disabled class="form-control" id="medicamento">
                        </div>
                        <div class="form-group col-3">
                            <label for="cantidad">Stock actual</label>
                            <input type="number" disabled class="form-control" id="stock_actual">
                        </div>
                        <div class="form-group col-2">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" placeholder="# Unidades">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="agregar-al-pedido" class="btn btn-primary">Añadir</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!--<div class="col-5">
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>-->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pedido</h3>
                    </div>
                    <div class="card-body">
                        <table id="pedido" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody id="pedido-body">
                            </tbody>
                            <tfoot>
                        </table>
                    </div>
                    <div class="card-footer row">
                        <form action="/sale" method="POST" id="form-sale">
                            {{ csrf_field() }}
                            <input type="text" style="display:none;" id="details_form" name="details[]">
                            <input type="text"  style="display:none;" name="total" id="total_form">
                        </form>
                        <div class="col-8">
                            <button id="vender-pedido" class="btn btn-success" >Vender</button>
                        </div>
                        <h5 class="col-4">Precio total: <span id="total_field"></span></h5>
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
    var details = [];
    var total = 0;
    var inventory_id;
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
                        }, 5000);
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

    $('.selectInventory').select2({
        placeholder: 'Busca medicamento',
        ajax: {
            url: '/select-inventory/',
            datatype: 'json',
            delay: 250,
            data: function (term) {
                return {
                    q: term
                };
            },
            processResults: function (data) {
                if(data.length == 0) {
                    return {
                        results: [
                            {
                                text: 'No se encontraron resultados. 🥺',
                            }
                        ]
                    }
                }
                return{
                    results: $.map(data, function (inventory) {
                        return {
                            text: inventory.nombre + ' ' + inventory.concentracion + ' ' + inventory.forma_farmaceutica_simp + ' - ' + inventory.laboratory_name,
                            id: inventory.id,
                            active: inventory.active_principle_id,
                            stock: inventory.stock,
                            precio: inventory.precio,
                        }
                    })
                };
            },
            cache: true,
        },
    });

    $('#selectInventory').change(function () {
        const data = $('#selectInventory').select2('data')[0];
        $('#medicamento_precio').val('');
        $('#stock_actual').val('');
        inventory_id = data.id;
        $('#medicamento_precio').val(data.precio);
        $('#stock_actual').val(data.stock);
        $.ajax({
            type: 'GET',
            url: 'options-inventory/' + data.active,
            success: function (medicament) {
                if(medicament.length != 0) {
                    $('.options').empty();
                    for(var i = 0; i < medicament.length; i++) {
                        $('.options').append(
                            '<p>No hay stock</p>' +
                            '<table class="table table-bordered table-hover"><tr><td>Opciones: </td></tr>' + '<tr>' +
                            '<td>' + medicament[i].nombre +
                            ' ' + medicament[i].concentracion +
                            ' ' + medicament[i].forma_farmaceutica_simp +
                            ' ' + medicament[i].presentacion +
                            ' ' + medicament[i].laboratory_name +
                            '</td>' +
                            '</tr></table>');
                    }
                } else {
                    $('.options').empty();
                    $('.options').append("<p id='option_message'>No existen recomendaciones</p>");
                }
            }
        });
        /*$('#medicamento_precio').val($('#selectInventory').select2('data')[0].precio_publico);
        $('#stock_actual').val($('#selectInventory').select2('data')[0].stock);*/
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

    function removeRow(element) {
        $(element)[0].parentElement.remove();
    }

    $('#agregar-al-pedido').click(function(e) {
        e.preventDefault();
        if ($('#selectInventory').select2('data').length) {
            if ($('#cantidad').val() > 0 && $('#cantidad').val() <= parseInt($('#stock_actual').val())) {
                const rowElement = `
                    <tr data-id="${$('#selectInventory').select2('data')[0].id}">
                        <td>${$('#selectInventory').select2('data')[0].text}</td>
                        <td>${$('#medicamento_precio').val()}</td>
                        <td>${$('#cantidad').val()}</td>
                        <td>${ (parseInt($('#cantidad').val()) * parseFloat($('#medicamento_precio').val())).toFixed(2) }</td>
                        <td onclick="removeRow(this)" style="cursor: pointer;">❌</td>
                    </tr>
                `;
                $('#pedido-body').append(rowElement);

                // preparamos los datos
                details.push({
                    'id_inventory': inventory_id,
                    'cantidad': $('#cantidad').val(),
                });
                console.log((parseInt($('#cantidad').val()) * parseFloat($('#medicamento_precio').val())));
                total += (parseInt($('#cantidad').val()) * parseFloat($('#medicamento_precio').val()));
                $('#total_field').text(total.toFixed(2));

                $('#cantidad').val('');
            } else {
                alert('😥, la cantidad no puede ser mayor al stock actual y no puede ser 0');
            }
        } else {
            alert('😥, debe seleccionar un producto!');
        }
    });

    $('#vender-pedido').click(function(e){
        if(details.length == 0) {
            alert('😥, agrega producto al pedido!')
        }
        $('#details_form').val(JSON.stringify(details));
        $('#total_form').val(total);
        $('#form-sale').submit();
    });

</script>
@endsection
