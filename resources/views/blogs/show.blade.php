@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 class="title_text">Blog</h2>
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
@if ($message = Session::get('success'))
    <div class="alert alert-success my-3">
        <p>{{ $message }}</p>
    </div>
@endif
<div class = "row">
    <div class="col-md-8">
        <h5 id="title_blog" class = "card-title">{{ $blog->title }}</h5>
        <h6 id="author" class="card-title"><img src = "@if($user->image) {{ Storage::url($user->image->url) }} @else https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/user.png @endif" class = "profile_picture_blog" alt = "Foto de Perfil">{{ $user->name }}</h6>
        <h6 id="date" class="card-title">Fecha: {{ $blog->created_at }}</h6>
        @if ($blog->blog_type_id == 2)
            <h6 id="status_id">            
                @if ($blog->status_id == 1)
                    <span class="badge badge-danger mt-3"> {{ $status[0]->status}} </span>
                @else 
                    <span class="badge badge-success mt-3"> {{ $status[0]->status}} </span>
                @endif            
            </h6>
        @endif
        <p id="paragraph" class="card-text">{{ $blog->body }}</p>    
        @if($blog->image) 
            <img src = "{{ Storage::url($blog->image->url) }}" class = "card-img-top" alt = "Imagen">
        @endif 
        {{-- Agregar Comentario --}}
        <div class = "row col-md-8">
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
                        <li class="panel-body my-3">
                            <div class="list-group">
                                <div class="list-group-item">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['comments.destroy', $comment->id], 'style' => 'display:inline']) !!}
                                    <h5  class="card-title">
                                        <img src = "@if($comment->user->image){{ Storage::url($comment->user->image->url) }}  @else https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/user.png @endif" class = "profile_picture" alt = "Foto de Perfil">                                        
                                        {{ $comment->user->name}} · {{ $comment->created_at }}
                                        @if (Auth::user()->id == $comment->user_id || !Auth::user()->hasRole('Usuario Autenticado'))
                                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger ml-3']) !!}
                                        @endif                               
                                    </h5>                     
                                    {!! Form::close() !!}
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
    </div>
    <div class="col-md-4">
        <h6 class="fs-4 title_text">
            Más en {{ $category[0]->type_category }}:
        </h6>
        @foreach ($blogs_by_category as $blog_by_category)
            @if($blog_by_category->id != $blog->id) 
                <div class="ms-4 my-4 card" style="width: 15rem; height: 20rem;">
                    <img src="
                        @if($blog_by_category->image) 
                            {{ Storage::url($blog_by_category->image->url) }} 
                        @else 
                            https://recasens.com/wp-content/uploads/2017/02/r_095_pvc_1.jpg  
                        @endif" 
                    class="rounded mt-2 card-img-top" alt="Imagen">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog_by_category->title }}</h5>
                        <p class="card-text">{{ substr($blog_by_category->body, 0, 20) . " ..." }}</p>
                        <a href="{{ route('blogs.show', $blog_by_category->id) }}" class="btn btn-primary">Leer Blog</a>           
                    </div>
                </div>
            @endif      
        @endforeach
    </div>
</div>  
<p class="text-center text-primary"><small>©Servisoft</small></p>
@endsection
