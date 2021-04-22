@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left bg-success text-white mb-3 p-2">
            <h2>Añadir un nuevo Blog</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('blogs.index') }}"> Atras</a>
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
                <label>{{ Auth::user()->name }}</label>
                <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
                <input type="hidden" name="status_id" class="form-control" value="1">
            </div>
        </div>
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Titulo:</strong>
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
            <div class="form-group">
                <strong>Categoria:</strong>
                <select name="category_id" class="form-select">
                    <option selected>Seleccione una categoria</option>
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
                        <input name="tags[]" class="form-check-input mt-0" type="checkbox" value="{{ $tag->id }}" aria-label="Checkbox for following text input">
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
        <div class="p-2 col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Publicar</button>
        </div>
    </div>


</form>


<p class="text-center text-primary"><small>Servisoft</small></p>
@endsection