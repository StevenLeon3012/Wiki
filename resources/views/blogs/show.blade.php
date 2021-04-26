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
{{-- Agregar Comentario --}}
<div class = "row col-md-12">
    <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="p-2 col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">                    
                    <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="blog_id" class="form-control" value="{{ $blog->id }}">
                </div>
            </div>
            <div class="p-2 col-xs-12 col-sm-12 col-md-12">
                <strong>Comentario:</strong><br>
                <div class="form-group">
                    <textarea class="form-control" style="height:150px" name="body" placeholder="Escribe aquí tu Blog"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                <button type="submit" class="btn btn-success">Comentar</button>
            </div>
        </div>
    </form>    
</div>
{{-- Comentarios --}}
<div>
    @if($comments)
    <ul style="list-style: none; padding: 0">
      @foreach($comments as $comment)
        <li class="panel-body">
          <div class="list-group">
            <div class="list-group-item">
              <h6 id="author" class="card-title">{{ $user->name }}</h6>
              <h6 id="date" class="card-title">Fecha: {{ $comment->created_at }}</h6>
            </div>
            <div class="list-group-item">
              <p id="paragraph" class="card-text">{{ $comment->body }}</p>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
    @endif
  </div>

<p class="text-center text-primary"><small>Servisoft</small></p>
@endsection
