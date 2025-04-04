@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del Pago</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $payment->payment_id }}
                    </div>

                    <div class="form-group">
                        <strong>Cliente:</strong>
                        {{ $payment->customer->first_name }} {{ $payment->customer->last_name }}
                    </div>

                    <div class="form-group">
                        <strong>Empleado:</strong>
                        {{ $payment->staff->first_name }} {{ $payment->staff->last_name }}
                    </div>

                    <div class="form-group">
                        <strong>Alquiler:</strong>
                        {{ $payment->rental_id }}
                    </div>

                    <div class="form-group">
                        <strong>Monto:</strong>
                        {{ $payment->amount }}
                    </div>

                    <div class="form-group">
                        <strong>Fecha de Pago:</strong>
                        {{ $payment->payment_date }}
                    </div>

                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $payment->last_update }}
                    </div>

                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('payments.edit', $payment->payment_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('payments.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection