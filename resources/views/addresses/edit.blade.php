<!-- resources/views/addresses/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Dirección</h3>
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
                    
                    <form action="{{ route('addresses.update', $address->address_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $address->address) }}" placeholder="Dirección">
                        </div>
                        
                        <div class="form-group">
                            <label for="address2">Dirección 2 (opcional):</label>
                            <input type="text" name="address2" class="form-control" value="{{ old('address2', $address->address2) }}" placeholder="Dirección 2">
                        </div>
                        
                        <div class="form-group">
                            <label for="district">Distrito:</label>
                            <input type="text" name="district" class="form-control" value="{{ old('district', $address->district) }}" placeholder="Distrito">
                        </div>
                        
                        <div class="form-group">
                            <label for="city_id">Ciudad:</label>
                            <select name="city_id" class="form-control">
                                <option value="">Seleccione una ciudad</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->city_id }}" {{ (old('city_id', $address->city_id) == $city->city_id) ? 'selected' : '' }}>
                                        {{ $city->city }} ({{ $city->country->country ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="postal_code">Código Postal:</label>
                            <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $address->postal_code) }}" placeholder="Código Postal">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Teléfono:</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $address->phone) }}" placeholder="Teléfono">
                        </div>
                        
                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('addresses.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
