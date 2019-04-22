@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Gastos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Gastos</a></li>
                        <li class="breadcrumb-item active">Crear</li>
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
                        <h3 class="card-title">Ingresar Gasto</h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('expense.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group col-12">
                                <label for="gasto_descripcion">Descripcion</label>
                                <input type="text" class="form-control" id="gasto_descripcion" placeholder="Descripcion del gasto" name="gasto_descripcion">
                                @if ($errors->has('gasto_descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gasto_descripcion') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="row col-12">
                                <div class="form-group col-6">
                                    <label for="gasto_monto">Monto</label>
                                    <input type="number" step="0.1" class="form-control" id="gasto_monto" placeholder="Monto" name="gasto_monto">
                                    @if ($errors->has('gasto_monto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gasto_monto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-6">
                                    <label for="gasto_fecha">Fecha</label>
                                    <input type="date" class="form-control" id="gasto_fecha" placeholder="Laboratorio" name="gasto_fecha">
                                    @if ($errors->has('gasto_fecha'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gasto_fecha') }}</strong>
                                        </span>
                                    @endif
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
