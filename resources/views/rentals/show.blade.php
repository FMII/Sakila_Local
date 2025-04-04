@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del Alquiler</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $rental->rental_id }}
                    </div>

                    <div class="form-group">
                        <strong>Fecha de Alquiler:</strong>
                        {{ $rental->rental_date }}
                    </div>

                    <div class="form-group">
                        <strong>Inventario:</strong>
                        {{ $rental->inventory->film->title }}
                    </div>

                    <div class="form-group">
                        <strong>Cliente:</strong>
                        {{ $rental->customer->first_name }} {{ $rental->customer->last_name }}
                    </div>

                    <div class="form-group">
                        <strong>Fecha de Devolución:</strong>
                        {{ $rental->return_date }}
                    </div>

                    <div class="form-group">
                        <strong>Empleado:</strong>
                        {{ $rental->staff->first_name }} {{ $rental->staff->last_name }}
                    </div>

                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $rental->last_update }}
                    </div>

                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('rentals.edit', $rental->rental_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('rentals.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection