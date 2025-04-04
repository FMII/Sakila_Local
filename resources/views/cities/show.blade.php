<!-- resources/views/cities/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles de la Ciudad</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $city->city_id }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Ciudad:</strong>
                        {{ $city->city }}
                    </div>
                    
                    <div class="form-group">
                        <strong>País:</strong>
                        {{ $city->country->country }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $city->last_update }}
                    </div>
                    
                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('cities.edit', $city->city_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('cities.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection