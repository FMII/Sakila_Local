@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Tienda</h3>
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

                    <form action="{{ route('stores.update', $store->store_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="manager_staff_id">Gerente:</label>
                            <select name="manager_staff_id" class="form-control">
                                @foreach($staff as $staff)
                                    <option value="{{ $staff->staff_id }}" {{ $store->manager_staff_id == $staff->staff_id ? 'selected' : '' }}>{{ $staff->first_name }} {{ $staff->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address_id">Dirección:</label>
                            <select name="address_id" class="form-control">
                                @foreach($addresses as $address)
                                    <option value="{{ $address->address_id }}" {{ $store->address_id == $address->address_id ? 'selected' : '' }}>{{ $address->address }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('stores.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection