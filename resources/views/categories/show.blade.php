@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="title_text">Blogs</h2>
        </div>
        <div class="pull-right">
            <a class="my-2 btn btn-success" href="{{ route('categories.index') }}">Volver a todos los blogs</a>
        </div>
    </div>
    <div class="pull-right md-col-3 mt-4">
        <strong>Seleccione una Categoría: </strong>
        @foreach ($categories as $option)
        <a href="{{ route('categories.show', $option->id) }}" class="btn-sm btn btn-outline-warning ms-3">{{ $option->type_category }}</a>
        @endforeach
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class = "row">
    <h6 class="mt-4 fs-1 text-success category_identifier">
        @foreach ($category_name as $category)
        <strong>Categoria: {{ $category->type_category }}</strong>
        @endforeach
    </h6>
</div>
<div class="row offset-1">
    @foreach ($blogs as $blog)
    <div class="ms-4 my-4 card" style="width: 18rem;">
        <img src="@if($blog->image) {{ Storage::url($blog->image->url) }} @else https://recasens.com/wp-content/uploads/2017/02/r_095_pvc_1.jpg  @endif" class="rounded mt-2 card-img-top" alt="Imagen">
        <div class="card-body">
            <h5 class="card-title">{{ $blog->title }}</h5>
            <p class="card-text">{{ substr($blog->body, 0, 150) . " ..." }}</p>
            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary">Leer Blog</a>           
        </div>
        <div class="card-footer">
            <small class="text-muted">
                @foreach($blog->tags as $tag)
                <a href="{{ route('tags.show', $tag )}}" class="badge bg-success p-2">#{{ $tag->tag }}</a>
                @endforeach
            </small>
        </div>
    </div>
    @endforeach
</div>
<p class="text-center text-primary"><small>©Servisoft</small></p>
@endsection