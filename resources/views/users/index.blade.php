@extends('layouts.app')
@section('content')
  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2 class="title_text">Gestión de Usuarios</h2>
          </div>
          <div class="pull-right">
              <a class="my-2 btn btn-success" href="{{ route('users.create') }}"> Crear nuevo usuario</a>
          </div>
      </div>
  </div>
@if ($message = Session::get('success'))
  <div class="alert alert-success">
    <p>{{ $message }}</p>
  </div>
@endif
<table class="table table-bordered">
  <tr>
    <br>
    <th>Foto de Perfil</th>
    <th>Nombre</th>
    <th>Email</th>
    <th>Roles</th>
    <th width="280px">Acciones</th>
  </tr>
 @foreach ($data as $key => $user)
    <tr>
      <td><img class="profile_picture ms-5" src="@if($user->image) {{ Storage::url($user->image->url) }} @else https://d1nhio0ox7pgb.cloudfront.net/_img/o_collection_png/green_dark_grey/512x512/plain/user.png @endif" alt="alt"/></td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
        @if(!empty($user->getRoleNames()))
          @foreach($user->getRoleNames() as $v)
            <label class="badge bg-success">{{ $v }}</label>
          @endforeach
        @endif
      </td>
      <td>
        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Mostrar</a>
        @if(Auth::user()->hasRole('Admin'))
          <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        @endif
      </td>
    </tr>
 @endforeach
</table>
  <p class="text-center text-primary"><small>©Servisoft</small></p>
@endsection