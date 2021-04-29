@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="title_text">Usuario</h2>
        </div>
        <div class="pull-right">
            @if(Auth::user()->hasRole('Admin'))
                <a class="btn btn-primary" href="{{ route('users.index') }}">Atrás</a>
            @endif
            @if($user->id == Auth::user()->id)
                <a class="btn btn-success" href="{{ route('users.edit', $user->id) }}">Editar tu perfil</a>
            @endif
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="offset-md-5 col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <img class="show_profile_picture" src="@if($user->image) {{ Storage::url($user->image->url) }} @else https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/user.png @endif" alt="alt"/>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre:</strong>
            <li class="list-group-item">{{ $user->name }}</li>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            <li class="list-group-item">{{ $user->email }}</li>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Rol:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <li class="list-group-item">  <label class="badge badge-success">{{ $v }}</label></li>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection