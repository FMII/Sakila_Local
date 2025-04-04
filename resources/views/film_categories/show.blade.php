<!-- resources/views/film-categories/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles de Categoría de Película</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID de Película:</strong>
                        {{ $filmCategory->film_id }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Título de Película:</strong>
                        {{ $filmCategory->film->title }}
                    </div>
                    
                    <div class="form-group">
                        <strong>ID de Categoría:</strong>
                        {{ $filmCategory->category_id }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Nombre de Categoría:</strong>
                        {{ $filmCategory->category->name }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $filmCategory->last_update }}
                    </div>
                    
                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary " href="{{ route('film-categories.edit', ['film_category' => $filmCategory->film_id . '-' . $filmCategory->category_id]) }}"> Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('film-categories.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection