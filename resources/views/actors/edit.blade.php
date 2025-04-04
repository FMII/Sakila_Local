<!-- resources/views/actors/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Actor</h3>
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
                    
                    <form action="{{ route('actors.update', $actor->actor_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="first_name">Nombre:</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $actor->first_name) }}" placeholder="Nombre">
                        </div>
                        
                        <div class="form-group">
                            <label for="last_name">Apellido:</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $actor->last_name) }}" placeholder="Apellido">
                        </div>
                        
                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('actors.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
