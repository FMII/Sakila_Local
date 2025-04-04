@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Alquiler</h3>
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

                    <form action="{{ route('rentals.update', $rental->rental_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="rental_date">Fecha de Alquiler:</label>
                            <input type="datetime-local" name="rental_date" class="form-control" value="{{ old('rental_date', $rental->rental_date) }}">
                        </div>

                        <div class="form-group">
                            <label for="inventory_id">Inventario:</label>
                            <select name="inventory_id" class="form-control">
                                @foreach($inventories as $inventory)
                                    <option value="{{ $inventory->inventory_id }}" {{ $rental->inventory_id == $inventory->inventory_id ? 'selected' : '' }}>{{ $inventory->film->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="customer_id">Cliente:</label>
                            <select name="customer_id" class="form-control">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->customer_id }}" {{ $rental->customer_id == $customer->customer_id ? 'selected' : '' }}>{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="return_date">Fecha de Devolución:</label>
                            <input type="datetime-local" name="return_date" class="form-control" value="{{ old('return_date', $rental->return_date) }}">
                        </div>

                        <div class="form-group">
                            <label for="staff_id">Empleado:</label>
                            <select name="staff_id" class="form-control">
                                @foreach($staff as $staff)
                                    <option value="{{ $staff->staff_id }}" {{ $rental->staff_id == $staff->staff_id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('rentals.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection