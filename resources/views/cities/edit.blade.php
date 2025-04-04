<!-- resources/views/cities/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Ciudad</h3>
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
                    
                    <form action="{{ route('cities.update', $city->city_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="city">Nombre de la Ciudad:</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city', $city->city) }}" placeholder="Nombre de la Ciudad">
                        </div>
                        
                        <div class="form-group">
                            <label for="country_id">País:</label>
                            <select name="country_id" class="form-control">
                                <option value="">Seleccione un país</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->country_id }}" {{ old('country_id', $city->country_id) == $country->country_id ? 'selected' : '' }}>
                                        {{ $country->country }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('cities.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection