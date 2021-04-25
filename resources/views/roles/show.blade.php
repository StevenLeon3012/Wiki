@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Mostrar roles</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}">Atrás</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre:</strong>
            <li class="list-group-item">{{ $role->name }}</li>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permisos:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                <li class="list-group-item"><label class="label label-success">{{ $v->name }}</label></li>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection