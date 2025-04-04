@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Textos de Películas</h3>
                    @if(auth()->user()->role->name !== 'invitado')
                    <a href="{{ route('film_texts.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i> Nuevo Texto
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
                                <th>Título</th>
                                <th>Descripción</th>
                                <th width="280px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($filmTexts as $filmText)
                            <tr>
                                <td>{{ $filmText->film_id }}</td>
                                <td>{{ $filmText->title }}</td>
                                <td>{{ $filmText->description }}</td>
                                <td>
                                    <form action="{{ route('film_texts.destroy', $filmText->film_id) }}" method="POST" class="d-inline">
                                        <a class="btn btn-info btn-sm" href="{{ route('film_texts.show', $filmText->film_id) }}">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        @if(auth()->user()->role->name !== 'invitado')
                                        <a class="btn btn-primary btn-sm" href="{{ route('film_texts.edit', $filmText->film_id) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este texto?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="pagination pagination-sm m-0 float-right">
                        {{ $filmTexts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection