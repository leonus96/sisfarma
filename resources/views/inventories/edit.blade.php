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
                    <form role="form" method="POST" action="{{ route('inventory.update', $inventory->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group col-12">
                                <input type="text" class="form-control" value="{{$inventory->medicament->nombre .' '. $inventory->medicament->concentracion .' '. $inventory->medicament->forma_farmaceutica_simp}}">
                            </div>
                            <div class="row col-12">
                                <div class="form-group col-4">
                                    <label for="producto_stock">Stock</label>
                                    <input type="number" class="form-control" id="producto_stock" placeholder="Stock" name="stock" value="{{$inventory->stock}}">
                                    @if ($errors->has('stock'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-4">
                                    <label for="producto_precio_costo">Precio de costo</label>
                                    <input type="number" step="0.01" class="form-control" id="producto_precio_costo" placeholder="Precio de costo" name="precio_costo" value="{{$inventory->precio_costo}}">
                                    @if ($errors->has('precio_costo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('precio_costo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="form-group col-4">
                                    <label for="producto_precio_publico">Precio público</label>
                                    <input type="number" step="0.01" class="form-control" id="producto_precio_publico" placeholder="Precio de público" name="precio_publico" value="{{$inventory->precio_publico}}">
                                    @if ($errors->has('precio_publico'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('precio_publico') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-4">
                                    <label for="producto_precio_publico">Fecha de vencimiento</label>
                                    <input type="date" class="form-control" id="producto_precio_publico" placeholder="Laboratorio" name="fecha_vencimiento" value="{{$inventory->fecha_vencimiento}}">
                                    @if ($errors->has('precio_publico'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('precio_publico') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-4">
                                    <label for="producto_lote">Lote</label>
                                    <input type="text" class="form-control" id="producto_lote" placeholder="Lote" name="lote" value="{{$inventory->lote}}">
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
                            //console.log(medicament);
                            return {
                                text: medicament.nombre + ' ' + medicament.concentracion + ' ' + medicament.forma_farmaceutica_simp + ' ' + medicament.laboratory_name,
                                id: medicament.id,
                                active: medicament.active_principle_id,
                            }
                        })
                    };
                },
                cache: true,
            },
        });

        $('#medicamentDescription').change(function () {
            $('#medicament_id').val($('#medicamentDescription').select2('data')[0].id);
            console.log($('#medicamentDescription').select2('data')[0]);
            if($('#medicamentDescription').select2('data')[0].active == undefined
                || $('#medicamentDescription').select2('data')[0].active == null ) {
                $('#active_principle').prop('disabled', false);
            }
        });

        $('#porcentaje').change(function() {
            var porcentaje = $('#porcentaje').val();
            if(porcentaje > 100 || porcentaje < 0) {
                return;
            }
            $('#producto_precio_publico').val($('#producto_precio_costo').val() + $('#producto_precio_costo').val() * porcentaje/100);
        });
    </script>
@endsection
