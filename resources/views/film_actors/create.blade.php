<!-- resources/views/film_actors/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Asignar Actor a Película</h3>
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
                    
                    <form action="{{ route('film-actors.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="film_id">Película:</label>
                            <select name="film_id" class="form-control">
                                <option value="">Seleccione una película</option>
                                @foreach($films as $film)
                                    <option value="{{ $film->film_id }}" {{ old('film_id') == $film->film_id ? 'selected' : '' }}>
                                        {{ $film->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="actor_id">Actor:</label>
                            <select name="actor_id" class="form-control">
                                <option value="">Seleccione un actor</option>
                                @foreach($actors as $actor)
                                    <option value="{{ $actor->actor_id }}" {{ old('actor_id') == $actor->actor_id ? 'selected' : '' }}>
                                        {{ $actor->first_name }} {{ $actor->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('film-actors.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection