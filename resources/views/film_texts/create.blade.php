@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Crear Texto de Película</h3>
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

                    <form action="{{ route('film_texts.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="film_id">Película:</label>
                            <select name="film_id" class="form-control">
                                @foreach($films as $film)
                                    <option value="{{ $film->film_id }}">{{ $film->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Título:</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Título">
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea name="description" class="form-control" placeholder="Descripción">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('film_texts.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection