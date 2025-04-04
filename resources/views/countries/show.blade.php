<!-- resources/views/countries/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del País</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $country->country_id }}
                    </div>
                    
                    <div class="form-group">
                        <strong>País:</strong>
                        {{ $country->country }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $country->last_update }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Ciudades:</strong>
                        <ul>
                            @forelse($country->cities as $city)
                                <li>{{ $city->city }}</li>
                            @empty
                                <li>No hay ciudades asociadas a este país.</li>
                            @endforelse
                        </ul>
                    </div>
                    
                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('countries.edit', $country->country_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('countries.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
