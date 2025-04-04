<!-- resources/views/film-categories/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Categoría de Película</h3>
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
                    
                    <form action="{{ route('film-categories.update', ['film_category' => $filmCategory->film_id . '-' . $filmCategory->category_id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="film_id">Película:</label>
                            <select name="film_id" class="form-control" disabled>
                                @foreach($films as $film)
                                    <option value="{{ $film->film_id }}" {{ $filmCategory->film_id == $film->film_id ? 'selected' : '' }}>{{ $film->title }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="film_id" value="{{ $filmCategory->film_id }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="category_id">Categoría:</label>
                            <select name="category_id" class="form-control" disabled>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ $filmCategory->category_id == $category->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="category_id" value="{{ $filmCategory->category_id }}">
                        </div>
                        
                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('film-categories.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection