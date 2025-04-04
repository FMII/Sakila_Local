@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Crear Cliente</h3>
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

                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="first_name">Nombre:</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="Nombre">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Apellido:</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Apellido">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="store_id">Tienda:</label>
                            <select name="store_id" class="form-control">
                                @foreach($stores as $store)
                                    <option value="{{ $store->store_id }}">{{ $store->store_id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address_id">Dirección:</label>
                            <select name="address_id" class="form-control">
                                @foreach($addresses as $address)
                                    <option value="{{ $address->address_id }}">{{ $address->address }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="active">Activo:</label>
                            <select name="active" class="form-control">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('customers.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection