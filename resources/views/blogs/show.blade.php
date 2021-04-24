@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Blog</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('blogs.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class = "row col-md-12">
    <h5 id="title_blog" class = "card-title">{{ $blog->title }}</h5>
    <h6 id="author" class="card-title"><img src = "@if(Auth::user()->image) {{ Storage::url(Auth::user()->image->url) }} @else https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/user.png @endif" class = "profile_picture_blog" alt = "Foto de Perfil">{{ $user->name }}</h6>
    <h6 id="date" class="card-title">Date: {{ $blog->created_at }}</h6>
    <p id="paragraph" class="card-text">{{ $blog->body }}</p>        
</div>  
@if($blog->image) 
    <img src = "{{ Storage::url($blog->image->url) }}" class = "card-img-top" alt = "Imagen">
@endif
<!--<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $blog->title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Details:</strong>
            {{ $blog->body }}
        </div>
    </div>
</div>-->
<p class="text-center text-primary"><small>Servisoft</small></p>
@endsection
