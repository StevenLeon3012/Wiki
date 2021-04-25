@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Blog</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('blogs.index') }}">Atrás</a>
            @if(Auth::user()->id == $blog->user_id || !Auth::user()->hasRole('Usuario Autenticado'))
            <a class="btn btn-success" href="{{ route('blogs.edit', $blog->id) }}"> Editar</a>
            {!! Form::open(['method' => 'DELETE','route' => ['blogs.destroy', $blog->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endif
        </div>
    </div>
</div>
<div class = "row col-md-12">
    <h5 id="title_blog" class = "card-title">{{ $blog->title }}</h5>
    <h6 id="author" class="card-title"><img src = "@if($user->image) {{ Storage::url($user->image->url) }} @else https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/user.png @endif" class = "profile_picture_blog" alt = "Foto de Perfil">{{ $user->name }}</h6>
    <h6 id="date" class="card-title">Fecha: {{ $blog->created_at }}</h6>
    <p id="paragraph" class="card-text">{{ $blog->body }}</p>        
</div>  
@if($blog->image) 
<img src = "{{ Storage::url($blog->image->url) }}" class = "card-img-top" alt = "Imagen">
@endif
<p class="text-center text-primary"><small>Servisoft</small></p>
@endsection
