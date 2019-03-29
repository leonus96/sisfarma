@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Editar principio activo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Principios activos</a></li>
                        <li class="breadcrumb-item active">Editar</li>
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
                        <form role="form" method="POST" action="{{ route('principle.update', $principle->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ $principle->nombre }}" required autofocus>
                                    @if ($errors->has('nombre'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input id="descripcion" type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ $principle->descripcion }}" required autofocus>
                                    @if ($errors->has('descripcion'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
