<!-- resources/views/actors/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Crear Actor</h3>
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
                    
                    <form action="{{ route('actors.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="first_name">Nombre:</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="Nombre">
                        </div>
                        
                        <div class="form-group">
                            <label for="last_name">Apellido:</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Apellido">
                        </div>
                        
                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('actors.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection