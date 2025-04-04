<!-- resources/views/film_actors/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles de Asignación Actor-Película</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>Película:</strong>
                        {{ $filmActor->film->title }}
                    </div>
                    
                    <div class="form-group">
                        <strong>ID Película:</strong>
                        {{ $filmActor->film_id }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Actor:</strong>
                        {{ $filmActor->actor->first_name }} {{ $filmActor->actor->last_name }}
                    </div>
                    
                    <div class="form-group">
                        <strong>ID Actor:</strong>
                        {{ $filmActor->actor_id }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $filmActor->last_update }}
                    </div>
                    
                    <div class="form-group text-right">
                    {{-- <a class="btn btn-primary" href="{{ route('film-actors.edit', $filmActor->actor_id . '-' . $filmActor->film_id) }}">Editar</a> --}}
<a class="btn btn-secondary" href="{{ route('film-actors.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection