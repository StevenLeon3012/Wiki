@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="title_text">Editar nuevo usuario</h2>
        </div>
        <div class="pull-right">
            @if(Auth::user()->hasRole('Admin'))
                <a class="btn btn-primary" href="{{ route('users.index') }}">Atrás</a>
            @endif
        </div>
    </div>
</div>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong>Problemas con la información.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id, ], 'files' => true]) !!}
<div class="row">
    <div class="offset-md-5 col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <img class="show_profile_picture" src="
                @if($user->image) 
                    {{ Storage::url($user->image->url) }} 
                @else 
                    https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/user.png 
                @endif" 
            alt="alt"/>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
             <strong>Foto de Perfil:</strong>
            {!! Form::label('file', 'Foto de perfil') !!}
            {!! Form::file('file', ['class' => 'form-control-file']) !!}            
        </div>
    </div>
    @if (Auth::user()->hasRole('Admin'))
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Rol:</strong>
                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
            </div>
        </div>
    @endif
    <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
        <button type="submit" class="btn btn-success">Actualizar</button>
    </div>
</div>
{!! Form::close() !!}
<p class="text-center text-primary"><small>©Servisoft</small></p>
@endsection
