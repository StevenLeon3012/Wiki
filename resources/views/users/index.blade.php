@extends('layouts.app')
@section('content')
  <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="pull-left">
              <h2>Gestión de Usuarios</h2>
          </div>
          <div class="pull-right">
              <a class="my-2 btn btn-success" href="{{ route('users.create') }}"> Crear nuevo usuario</a>
          </div>
      </div>
      <br>
      <div>
        <!--Searchbar -->
        <form action="/searchUser" method="POST" role="search">
          {{ csrf_field() }}
          <div class="input-group">
              <input type="text" class="form-control" name="q"
                  placeholder="Busca en usuarios"> <span class="input-group-btn">
                  <button type="submit" class="btn btn-default">
                      <span class="glyphicon glyphicon-search"></span>
                  </button>
              </span>
          </div>
        </form>
      </div>
  </div>
@if ($message = Session::get('success'))
  <div class="alert alert-success">
    <p>{{ $message }}</p>
  </div>
@endif

<!-- Searchbar Resultados -->
<div class="container">
  @if(isset($details))
    <p> Resultados del query <b> {{ $query }} </b> :</p>
    <h2>Sample User details</h2>
    @php
      $i = 0
    @endphp
    <table class="table table-bordered">
      <tr>
        <br>
        <th>No</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Roles</th>
        <th width="280px">Acciones</th>
      </tr>
          @foreach($details as $user)
            <tr>
              <td>{{ ++$i }}</td>
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
                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
                  {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                      {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
              </td>
            </tr>
          @endforeach
      </tbody>
    </table>
  @elseif (isset($vacio)) 
    <strong>No se pudo encontrar resultados para la busqueda de: <b> {{ $query }} </b> </strong>
  @else
    <table class="table table-bordered">
      <tr>
        <br>
        <th>No</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Roles</th>
        <th width="280px">Acciones</th>
      </tr>
    @foreach ($data as $key => $user)
      <tr>
        <td>{{ ++$i }}</td>
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
          <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
    </table>
    {!! $data->render() !!}
  @endif
</div>



  <p class="text-center text-primary"><small>Servisoft</small></p>
@endsection