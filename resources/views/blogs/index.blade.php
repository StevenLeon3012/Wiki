@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="title_text">Blogs</h2>
        </div>
        <div class="pull-right">
            @can('blog-create')
            <a class="my-2 btn btn-success" href="{{ route('blogs.create') }}">Crear nuevo blog</a>
            @endcan
        </div>
        <div>
            <!--Searchbar -->
            <form action="/searchBlog" method="POST" role="search">
              {{ csrf_field() }}
              <div class="input-group">
                  <input type="text" class="form-control" name="q"
                      placeholder="Busca en blogs"> <span class="input-group-btn">
                      <button type="submit" class="btn btn-secondary">
                        <i class="fas fa-search p-1"></i>
                      </button>
                  </span>
              </div>
            </form>
          </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<!-- Searchbar -->
<div class="container">
    @if(isset($details))
        <p> Resultados del query <b> {{ $query }} </b> :</p>
        @foreach($details as $blog)
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
    @elseif (isset($vacio)) 
        <strong>No se pudo encontrar resultados para la busqueda de: <b> {{ $query }} </b> </strong>
    @else 
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
    @endif
<p class="text-center text-primary"><small>©Servisoft</small></p>
@endsection