<!-- resources/views/film_actors/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Asignaciones de Actores a Películas</h3>
                    @if(auth()->user()->role->name !== 'invitado')
                    <a href="{{ route('film-actors.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i> Nueva Asignación
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
                                <th>Película</th>
                                <th>Actor</th>
                                <th>Última Actualización</th>
                                <th width="280px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filmActors as $filmActor)
                            <tr>
                                <td>{{ $filmActor->film->title }}</td>
                                <td>{{ $filmActor->actor->first_name }} {{ $filmActor->actor->last_name }}</td>
                                <td>{{ $filmActor->last_update }}</td>
                                <td>
                                    <form action="{{ route('film-actors.destroy', ['film_actor' => $filmActor->actor_id . '-' . $filmActor->film_id]) }}" method="POST" class="d-inline">
                                        <a class="btn btn-info btn-sm" href="{{ route('film-actors.show', ['film_actor' => $filmActor->actor_id . '-' . $filmActor->film_id]) }}">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        {{-- <a class="btn btn-primary btn-sm" href="{{ route('film-actors.edit', ['film_actor' => $filmActor->actor_id . '-' . $filmActor->film_id]) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a> --}}
                                        {{-- @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta asignación?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button> --}}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="pagination pagination-sm m-0 float-right">
                        {{ $filmActors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection