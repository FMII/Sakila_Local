@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Pago</h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>¡Ups!</strong> Hay algunos problemas con tus datos.<br><br>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('payments.update', $payment->payment_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="customer_id">Cliente:</label>
                            <select name="customer_id" class="form-control">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->customer_id }}" {{ $payment->customer_id == $customer->customer_id ? 'selected' : '' }}>{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="staff_id">Empleado:</label>
                            <select name="staff_id" class="form-control">
                                @foreach($staff as $staff)
                                    <option value="{{ $staff->staff_id }}" {{ $payment->staff_id == $staff->staff_id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="rental_id">Alquiler:</label>
                            <select name="rental_id" class="form-control">
                                @foreach($rentals as $rental)
                                    <option value="{{ $rental->rental_id }}" {{ $payment->rental_id == $rental->rental_id ? 'selected' : '' }}>{{ $rental->rental_id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="amount">Monto:</label>
                            <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $payment->amount) }}" placeholder="Monto">
                        </div>

                        <div class="form-group">
                            <label for="payment_date">Fecha de Pago:</label>
                            <input type="datetime-local" name="payment_date" class="form-control" value="{{ old('payment_date', $payment->payment_date) }}">
                        </div>

                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('payments.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection