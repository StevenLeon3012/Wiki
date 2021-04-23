@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre:</strong>
            <input type="text" name="name" class="form-control" placeholder="Nombre Completo">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Correo Electronico:</strong>
            <input type="text" name="email" class="form-control" placeholder="ejemplo@gmail.com">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Contraseña:</strong>
            <input type="password" name="password" class="form-control" placeholder="Contraseña">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirmar Contraseña:</strong>
            <input type="password" name="confirm-password" class="form-control" placeholder="Confirmar Contraseña">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Foto de perfil(opcional):</strong>
            <input type="file" name="file" class="form-control" placeholder="Elige una foto">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Rol:</strong>
            @foreach ($roles as $role)
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input name="roles[]" class="form-check-input mt-0" type="checkbox" value="{{ $role->id }}" aria-label="Checkbox for following text input">
                    </div>
                    <input type="text" class="form-control" value="{{ $role->name }}">
                </div>
                @endforeach
        </div>
    </div>    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>


<p class="text-center text-primary"><small>Servisoft</small></p>
@endsection