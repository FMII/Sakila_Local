@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Películas</h3>
                    @if(auth()->user()->role->name !== 'invitado')
                    <a href="{{ route('films.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i> Nueva Película
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <h5><i class="icon fas fa-ban"></i> Error</h5>
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Año</th>
                                <th>Duración</th>
                                <th>Clasificación</th>
                                <th>Última Actualización</th>
                                <th width="280px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($films as $film)
                            <tr>
                                <td>{{ $film->film_id }}</td>
                                <td>{{ $film->title }}</td>
                                <td>{{ $film->description }}</td>
                                <td>{{ $film->release_year }}</td>
                                <td>{{ $film->length }}</td>
                                <td>{{ $film->rating }}</td>
                                <td>{{ $film->last_update }}</td>
                                <td>
                                    <form action="{{ route('films.destroy', $film->film_id) }}" method="POST" class="d-inline">
                                        <a class="btn btn-info btn-sm" href="{{ route('films.show', $film->film_id) }}">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        @if(auth()->user()->role->name !== 'invitado')
                                        <a class="btn btn-primary btn-sm" href="{{ route('films.edit', $film->film_id) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        @endif
                                        {{-- @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta película?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button> --}}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="pagination pagination-sm m-0 float-right">
                        {{ $films->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection