@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Blogs</h2>
        </div>
        <div class="pull-right">
            @can('blog-create')
            <a class="my-2 btn btn-success" href="{{ route('blogs.create') }}"> Create New Blog</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<div class="row">
    @foreach ($blogs as $blog)
    <div class="col-xs-12 col-sm-3 col-md-3">
        <article>
            <div>
                <img src="@if($blog->image) {{ Storage::url($blog->image->url) }} @else https://recasens.com/wp-content/uploads/2017/02/r_095_pvc_1.jpg  @endif" class="img-thumbnail" alt="Imagen"/>
                <a>{{ $blog->title }}</a>
            </div>
        </article>
    </div>
    @endforeach
</div>


{!! $blogs->links() !!}


<p class="text-center text-primary"><small>Servisoft</small></p>
@endsection