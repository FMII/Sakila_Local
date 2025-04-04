@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Película</h3>
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

                    <form action="{{ route('films.update', $film->film_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Título:</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $film->title) }}" placeholder="Título">
                        </div>

                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea name="description" class="form-control" placeholder="Descripción">{{ old('description', $film->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="release_year">Año de Lanzamiento:</label>
                            <input type="number" name="release_year" class="form-control" value="{{ old('release_year', $film->release_year) }}" placeholder="Año">
                        </div>

                        <div class="form-group">
                            <label for="language_id">Idioma:</label>
                            <select name="language_id" class="form-control">
                                @foreach($languages as $language)
                                    <option value="{{ $language->language_id }}" {{ $film->language_id == $language->language_id ? 'selected' : '' }}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="rental_duration">Duración de Alquiler (días):</label>
                            <input type="number" name="rental_duration" class="form-control" value="{{ old('rental_duration', $film->rental_duration) }}" placeholder="Duración">
                        </div>

                        <div class="form-group">
                            <label for="rental_rate">Tarifa de Alquiler:</label>
                            <input type="number" step="0.01" min="0" max="99.99" name="rental_rate" class="form-control" value="{{ old('rental_rate', $film->rental_rate) }}" placeholder="Tarifa">
                        </div>

                        <div class="form-group">
                            <label for="length">Duración (minutos):</label>
                            <input type="number" name="length" class="form-control" value="{{ old('length', $film->length) }}" placeholder="Duración">
                        </div>

                        <div class="form-group">
                            <label for="replacement_cost">Costo de Reemplazo:</label>
                            <input type="number" step="0.01" min="0" max="999.99" name="replacement_cost" class="form-control" value="{{ old('replacement_cost', $film->replacement_cost) }}" placeholder="Costo">
                        </div>

                        <div class="form-group">
                            <label for="rating">Clasificación:</label>
                            <select name="rating" class="form-control">
                                <option value="G" {{ $film->rating == 'G' ? 'selected' : '' }}>G</option>
                                <option value="PG" {{ $film->rating == 'PG' ? 'selected' : '' }}>PG</option>
                                <option value="PG-13" {{ $film->rating == 'PG-13' ? 'selected' : '' }}>PG-13</option>
                                <option value="R" {{ $film->rating == 'R' ? 'selected' : '' }}>R</option>
                                <option value="NC-17" {{ $film->rating == 'NC-17' ? 'selected' : '' }}>NC-17</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Características Especiales:</label>
                            @php
                                $specialFeatures = $film->special_features ? explode(',', $film->special_features) : [];
                            @endphp
                            <div>
                                <div class="form-check">
                                    <input type="checkbox" name="special_features[]" class="form-check-input" value="Trailers" id="trailers" {{ in_array('Trailers', $specialFeatures) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="trailers">Trailers</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="special_features[]" class="form-check-input" value="Commentaries" id="commentaries" {{ in_array('Commentaries', $specialFeatures) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="commentaries">Comentarios</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="special_features[]" class="form-check-input" value="Deleted Scenes" id="deleted-scenes" {{ in_array('Deleted Scenes', $specialFeatures) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="deleted-scenes">Escenas Eliminadas</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="special_features[]" class="form-check-input" value="Behind the Scenes" id="behind-scenes" {{ in_array('Behind the Scenes', $specialFeatures) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="behind-scenes">Detrás de Escenas</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('films.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection