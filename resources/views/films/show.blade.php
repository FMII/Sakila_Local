@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles de la Película</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $film->film_id }}
                    </div>

                    <div class="form-group">
                        <strong>Título:</strong>
                        {{ $film->title }}
                    </div>

                    <div class="form-group">
                        <strong>Descripción:</strong>
                        {{ $film->description }}
                    </div>

                    <div class="form-group">
                        <strong>Año de Lanzamiento:</strong>
                        {{ $film->release_year }}
                    </div>

                    <div class="form-group">
                        <strong>Idioma:</strong>
                        {{ $film->language->name }}
                    </div>

                    <div class="form-group">
                        <strong>Duración de Alquiler (días):</strong>
                        {{ $film->rental_duration }}
                    </div>

                    <div class="form-group">
                        <strong>Tarifa de Alquiler:</strong>
                        {{ $film->rental_rate }}
                    </div>

                    <div class="form-group">
                        <strong>Duración (minutos):</strong>
                        {{ $film->length }}
                    </div>

                    <div class="form-group">
                        <strong>Costo de Reemplazo:</strong>
                        {{ $film->replacement_cost }}
                    </div>

                    <div class="form-group">
                        <strong>Clasificación:</strong>
                        {{ $film->rating }}
                    </div>

                    <div class="form-group">
                        <strong>Características Especiales:</strong>
                       {{ $film->special_features }}
                    </div>

                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $film->last_update }}
                    </div>

                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('films.edit', $film->film_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('films.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection