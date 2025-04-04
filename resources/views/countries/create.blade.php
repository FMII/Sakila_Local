<!-- resources/views/countries/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Crear País</h3>
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
                    
                    <form action="{{ route('countries.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="country">Nombre del País:</label>
                            <input type="text" name="country" class="form-control" value="{{ old('country') }}" placeholder="Nombre del País">
                        </div>
                        
                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('countries.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection