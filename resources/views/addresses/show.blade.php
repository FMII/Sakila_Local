<!-- resources/views/addresses/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles de la Dirección</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $address->address_id }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Dirección:</strong>
                        {{ $address->address }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Dirección 2:</strong>
                        {{ $address->address2 ?? 'N/A' }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Distrito:</strong>
                        {{ $address->district }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Ciudad:</strong>
                        {{ $address->city->city ?? 'N/A' }}
                    </div>
                    
                    <div class="form-group">
                        <strong>País:</strong>
                        {{ $address->city->country->country ?? 'N/A' }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Código Postal:</strong>
                        {{ $address->postal_code ?? 'N/A' }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Teléfono:</strong>
                        {{ $address->phone }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $address->last_update }}
                    </div>
                    
                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('addresses.edit', $address->address_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('addresses.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection