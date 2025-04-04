{{-- filepath: c:\Users\panch\Documents\Proyectos\Practicas Elias\Sakila\resources\views\categories\index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Categorías</h3>
                <div class="card-tools">
                    {{-- Mostrar el botón "Nueva Categoría" solo si el usuario no es invitado --}}
                    @if(auth()->user()->role->name !== 'invitado')
                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Nueva Categoría
                        </a>
                    @endif
                </div>
            </div>
            <!-- /.card-header -->
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
                            <th>Nombre</th>
                            <th>Última Actualización</th>
                            <th width="200px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->category_id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->last_update }}</td>
                            <td>
                                <form action="{{ route('categories.destroy', $category->category_id) }}" method="POST" class="d-inline">
                                    <a class="btn btn-info btn-xs" href="{{ route('categories.show', $category->category_id) }}">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    {{-- Mostrar los botones "Editar" y "Eliminar" solo si el usuario no es invitado --}}
                                    @if(auth()->user()->role->name !== 'invitado')
                                        <a class="btn btn-primary btn-xs" href="{{ route('categories.edit', $category->category_id) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('¿Está seguro de eliminar esta categoría?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                @if(isset($categories) && method_exists($categories, 'links'))
                    <div class="pagination pagination-sm m-0 float-right">
                        {{ $categories->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection