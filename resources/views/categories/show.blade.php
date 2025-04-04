<!-- resources/views/categories/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles de la Categoría</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $category->category_id }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $category->name }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $category->last_update }}
                    </div>
                    
                    <div class="form-group">
                        <strong>Películas de esta categoría:</strong>
                        @if($category->films->count() > 0)
                            <ul>
                                @foreach($category->films as $film)
                                    <li>{{ $film->title }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No hay películas asociadas a esta categoría.</p>
                        @endif
                    </div>
                    
                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('categories.edit', $category->category_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('categories.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection