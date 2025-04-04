@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del Cliente</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $customer->customer_id }}
                    </div>

                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $customer->first_name }}
                    </div>

                    <div class="form-group">
                        <strong>Apellido:</strong>
                        {{ $customer->last_name }}
                    </div>

                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $customer->email }}
                    </div>

                    <div class="form-group">
                        <strong>Activo:</strong>
                        {{ $customer->active ? 'Sí' : 'No' }}
                    </div>

                    <div class="form-group">
                        <strong>Tienda:</strong>
                        {{ $customer->store->store_id }}
                    </div>

                    <div class="form-group">
                        <strong>Dirección:</strong>
                        {{ $customer->address->address }}
                    </div>

                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $customer->last_update }}
                    </div>

                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('customers.edit', $customer->customer_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('customers.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection