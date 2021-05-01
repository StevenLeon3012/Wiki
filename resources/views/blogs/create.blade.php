@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="title_text">Añadir un nuevo Blog</h2>
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
<form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
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
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
        </div>
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Blog:</strong>
                <textarea class="form-control" style="height:150px" name="body" placeholder="Escribe aquí tu Blog"></textarea>
            </div>
        </div>
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <strong>Tipo de Blog:</strong>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="1" name="blog_type_id">
                <label class="form-check-label" for="flexRadioDefault1">
                    {{ $blog_types[0]->type }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="2" name="blog_type_id">  
                <label class="form-check-label" for="flexRadioDefault2">
                    {{ $blog_types[1]->type }}
                </label>
            </div>
        </div>
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Categoría:</strong>
                <select name="category_id" class="form-select">
                    <option selected>Seleccione una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->type_category }}</option>
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
                            <input name="tags[]" type="checkbox" value="{{ $tag->id }}" aria-label="Checkbox for following text input">
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
<p class="text-center text-primary"><small>©Servisoft</small></p>
@endsection