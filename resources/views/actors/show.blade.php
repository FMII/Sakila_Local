<!-- resources/views/actors/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del Actor</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $actor->actor_id }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $actor->first_name }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Apellido:</strong>
                        {{ $actor->last_name }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $actor->last_update }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Películas:</strong>
                        <ul>
                            @forelse($actor->films as $film)
                                <li>{{ $film->title }}</li>
                            @empty
                                <li>No hay películas asociadas a este actor.</li>
                            @endforelse
                        </ul>
                    </div>
                    
                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('actors.edit', $actor->actor_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('actors.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection