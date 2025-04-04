@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Crear Película</h3>
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

                    <form action="{{ route('films.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Título:</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Título">
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea name="description" class="form-control" placeholder="Descripción">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="release_year">Año de Lanzamiento:</label>
                            <input type="number" name="release_year" class="form-control" value="{{ old('release_year') }}" placeholder="Año">
                        </div>

                        <div class="form-group">
                            <label for="language_id">Idioma:</label>
                            <select name="language_id" class="form-control">
                                @foreach($languages as $language)
                                    <option value="{{ $language->language_id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="rental_duration">Duración de Alquiler (días):</label>
                            <input type="number" name="rental_duration" class="form-control" value="{{ old('rental_duration') }}" placeholder="Duración">
                        </div>

                        <div class="form-group">
                            <label for="rental_rate">Tarifa de Alquiler:</label>
                            <input type="number" step="0.01" min="0" max="99.99" name="rental_rate" class="form-control" value="{{ old('rental_rate') }}" placeholder="Tarifa">
                        </div>

                        <div class="form-group">
                            <label for="length">Duración (minutos):</label>
                            <input type="number" name="length" class="form-control" value="{{ old('length') }}" placeholder="Duración">
                        </div>

                        <div class="form-group">
                            <label for="replacement_cost">Costo de Reemplazo:</label>
                            <input type="number" step="0.01" min="0" max="999.99" name="replacement_cost" class="form-control" value="{{ old('replacement_cost') }}" placeholder="Costo">
                        </div>

                        <div class="form-group">
                            <label for="rating">Clasificación:</label>
                            <select name="rating" class="form-control">
                                <option value="G">G</option>
                                <option value="PG">PG</option>
                                <option value="PG-13">PG-13</option>
                                <option value="R">R</option>
                                <option value="NC-17">NC-17</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Características Especiales:</label>
                            <div>
                                <div class="form-check">
                                    <input type="checkbox" name="special_features[]" class="form-check-input" value="Trailers" id="trailers" {{ (is_array(old('special_features')) && in_array('Trailers', old('special_features'))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="trailers">Trailers</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="special_features[]" class="form-check-input" value="Commentaries" id="commentaries" {{ (is_array(old('special_features')) && in_array('Commentaries', old('special_features'))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="commentaries">Comentarios</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="special_features[]" class="form-check-input" value="Deleted Scenes" id="deleted-scenes" {{ (is_array(old('special_features')) && in_array('Deleted Scenes', old('special_features'))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="deleted-scenes">Escenas Eliminadas</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="special_features[]" class="form-check-input" value="Behind the Scenes" id="behind-scenes" {{ (is_array(old('special_features')) && in_array('Behind the Scenes', old('special_features'))) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="behind-scenes">Detrás de Escenas</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('films.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection