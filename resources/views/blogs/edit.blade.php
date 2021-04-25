@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Blog</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('blogs.index') }}">Atrás</a>
        </div>
    </div>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Ups!</strong> Hay un error en los input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('blogs.update',$blog->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                <li class="list-group-item"><label>{{ Auth::user()->name }}</label></li>
                <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
                <input type="hidden" name="status_id" class="form-control" value="1">
            </div>
        </div>
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Título:</strong>
                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $blog->title }}">
            </div>
        </div>
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Blog:</strong>
                <textarea class="form-control" style="height:150px" name="body" placeholder="Escribe aquí tu Blog">{{ $blog->body }}</textarea>
            </div>
        </div>
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Categoría:</strong>
                <select name="category_id" class="form-select">
                    @foreach ($categories as $category)
                    @if($blog->category_id == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->type_category }}</option>
                    @else
                    <option value="{{ $category->id }}">{{ $category->type_category }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Etiquetas:</strong>
                @foreach ($tags as $tag)
                <div class="input-group mb-3">
                    <div class="input-group-text"> 
                        @if($blog->tags)
                        <input name="tags[]" class="form-check-input mt-0" type="checkbox" value="{{ $tag->id }}" checked>
                        @else
                        <input name="tags[]" class="form-check-input mt-0" type="checkbox" value="{{ $tag->id }}">
                        @endif
                    </div>
                    <input type="text" class="form-control" value="{{ $tag->tag }}">
                </div>
                @endforeach
            </div>
        </div>
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Imagen:</strong>
                <input type="file" name="picture" class="form-control" placeholder="Elige una foto">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
            <button type="submit" class="btn btn-success">Publicar</button>
        </div>
    </div>
</form>
<p class="text-center text-primary"><small>Servisoft</small></p>
@endsection