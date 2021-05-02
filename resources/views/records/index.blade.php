@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="title_text">Historial de cambios</h2>
            </div>
            <div class="pull-right">
                <a class="my-2 btn btn-success" href="{{ route('blogs.index') }}">Volver a todos los blogs</a>
            </div>
        </div>
        <br>
        <div>
            <!--Searchbar -->
            <form action="/searchRecord" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Busca en historial">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-search p-1"></i>
                        </button>
                    </span>
                    <a href="{{ route('records.index') }}" class="btn btn-primary ml-2">Volver a todo el historial</i></a>
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
        @if (isset($details))
            <h2> Resultados de la busqueda <b> {{ $query }} </b> :</h2>
            <table class="table table-bordered">
                <tr>
                    <br>
                    <th>Fecha</th>
                    <th>Autor de los Cambios</th>
                    <th>Tipo</th>
                    <th>Espacio modificado</th>
                    <th>Detalle</th>
                </tr>
                @foreach ($details as $record)
                    <tr>
                        <td>{{ $record->created_at }}</td>
                        <td>{{ $record->modifier }}</td>
                        <td>{{ $record->type }}</td>
                        <td>{{ $record->modificated }}</td>
                        <td>{{ $record->description }}</td>
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
                    <th>Fecha</th>
                    <th>Autor de los Cambios</th>
                    <th>Tipo</th>
                    <th>Espacio modificado</th>
                    <th>Detalle</th>
                </tr>
                @foreach ($data as $key => $record)
                    <tr>
                        <td>{{ $record->created_at }}</td>
                        <td>{{ $record->modifier }}</td>
                        <td>{{ $record->type }}</td>
                        <td>{{ $record->modificated }}</td>
                        <td>{{ $record->description }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
    <p class="text-center text-primary"><small>©Servisoft</small></p>
@endsection