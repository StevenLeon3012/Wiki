@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="title_text">Editar Blog</h2>
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
<form action="{{ route('blogs.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="p-2 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                <li class="list-group-item"><label>{{ Auth::user()->name }}</label></li>
                <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
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
            <strong>Tipo de Blog:</strong>
            <div class="form-check">
                @if ($blog->blog_type_id == 1)
                <input class="form-check-input" type="radio" value="1" name="blog_type_id" checked>  
                @else
                    <input class="form-check-input" type="radio" value="1" name="blog_type_id"> 
                @endif 
                <label class="form-check-label" for="flexRadioDefault1">
                    {{ $blog_types[0]->type }}
                </label>
            </div>
            <div class="form-check">
                @if ($blog->blog_type_id == 2)
                <input class="form-check-input" type="radio" value="2" name="blog_type_id" checked>  
                @else
                    <input class="form-check-input" type="radio" value="2" name="blog_type_id"> 
                @endif 
                <label class="form-check-label" for="flexRadioDefault2">
                    {{ $blog_types[1]->type }}
                </label>
            </div>
        </div>
        <div class="p-2 col-xs-12 col-sm-12 col-md-12"> 
            @if ($blog->blog_type_id == 1)
                <input type="hidden" name="status_id" class="form-control" value="{{ $blog->status_id}}">           
            @else
                <strong>Estado del blog:</strong>
                <div class="form-check">
                    @if ($blog->status_id == 1)
                    <input class="form-check-input" type="radio" value="1" name="status_id" checked>  
                    @else
                        <input class="form-check-input" type="radio" value="1" name="status_id"> 
                    @endif 
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{ $status[0]->status}}
                    </label>
                </div>
                <div class="form-check">
                    @if ($blog->status_id == 2)
                    <input class="form-check-input" type="radio" value="2" name="status_id" checked>  
                    @else
                        <input class="form-check-input" type="radio" value="2" name="status_id"> 
                    @endif 
                    <label class="form-check-label" for="flexRadioDefault2">
                        {{ $status[1]->status}}
                    </label>
                </div>
            @endif    
            
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
                <strong>Etiquetas:</strong><br>               
                @foreach($tags as $value)
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            @if(in_array($value->id, $blog_tag))
                                <input name="tags[]" type="checkbox" value="{{ $value->id }}" checked>
                            @else
                                <input name="tags[]" type="checkbox" value="{{ $value->id }}">
                            @endif                         
                        </div>
                        <input type="text" class="form-control" value="{{ $value->tag }}">
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