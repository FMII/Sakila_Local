<!-- resources/views/film-categories/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Categorías de Películas</h3>
                    @if(auth()->user()->role->name !== 'invitado')
                    <a href="{{ route('film-categories.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i> Nueva Categoría de Película
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <h5><i class="icon fas fa-ban"></i> Error</h5>
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Película</th>
                                <th>Categoría</th>
                                <th>Última Actualización</th>
                                <th width="280px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filmCategories as $filmCategory)
                            <tr>
                                <td>{{ $filmCategory->film_id }} - {{ $filmCategory->category_id }}</td>
                                <td>{{ $filmCategory->film->title }}</td>
                                <td>{{ $filmCategory->category->name }}</td>
                                <td>{{ $filmCategory->last_update }}</td>
                                <td>
                                    <form action="{{ route('film-categories.destroy', ['film_category' => $filmCategory->film_id . '-' . $filmCategory->category_id]) }}" method="POST" class="d-inline">
                                        <a class="btn btn-info btn-sm" href="{{ route('film-categories.show', ['film_category' => $filmCategory->film_id . '-' . $filmCategory->category_id]) }}">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        @if(auth()->user()->role->name !== 'invitado')
                                        <a class="btn btn-primary btn-sm" href="{{ route('film-categories.edit', ['film_category' => $filmCategory->film_id . '-' . $filmCategory->category_id]) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        @endif
                                        {{-- @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta categoría de película?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button> --}}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="pagination pagination-sm m-0 float-right">
                        {{ $filmCategories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection