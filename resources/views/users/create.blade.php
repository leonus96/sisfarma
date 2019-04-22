@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Registrar Usuario</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Usuario</a></li>
                        <li class="breadcrumb-item active">Registrar</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if($errors->any())
        <div class="alert alert-danger">
            <pre>{{$errors->first()}}</pre>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form role="form" method="POST" action="{{route('user.store')}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="dni">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="rol">Rol</label>
                                <select name="rol" id="rol" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="vendedor">Vendedor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dni">Contraseña</label>
                                <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="dni">Confirma contraseña</label>
                                <input type="password" class="form-control" id="password-confirm" placeholder="Confirma contraseña" name="password_confirmation" required>
                            </div>

                        </div>                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
