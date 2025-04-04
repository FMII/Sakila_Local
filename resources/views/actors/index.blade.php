{{-- filepath: c:\Users\panch\Documents\Proyectos\Practicas Elias\Sakila\resources\views\actors\index.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Actores</h3>
                <div class="card-tools">
                    {{-- Mostrar el botón "Nuevo Actor" solo si el usuario no es invitado --}}
                    @if(auth()->user()->role->name !== 'invitado')
                        <a href="{{ route('actors.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Nuevo Actor
                        </a>
                    @endif
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Error</h5>
                        {{ session('error') }}
                    </div>
                @endif
                
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Última Actualización</th>
                            <th width="200px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actors as $actor)
                        <tr>
                            <td>{{ $actor->actor_id }}</td>
                            <td>{{ $actor->first_name }}</td>
                            <td>{{ $actor->last_name }}</td>
                            <td>{{ $actor->last_update }}</td>
                            <td>
                                <a class="btn btn-info btn-xs" href="{{ route('actors.show', $actor->actor_id) }}">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                {{-- Mostrar los botones "Editar" y "Eliminar" solo si el usuario no es invitado --}}
                                @if(auth()->user()->role->name !== 'invitado')
                                    <a class="btn btn-primary btn-xs" href="{{ route('actors.edit', $actor->actor_id) }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('actors.destroy', $actor->actor_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('¿Está seguro de eliminar este actor?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <!-- Si tienes paginación puedes colocarla aquí -->
                @if(isset($actors) && method_exists($actors, 'links'))
                    <div class="pagination pagination-sm m-0 float-right">
                        {{ $actors->links() }}
                    </div>
                @endif
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection