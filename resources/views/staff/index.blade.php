@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">
                        <i class="fas fa-users"></i> Gestión de Personal
                    </h3>
                    @if(auth()->user()->role && auth()->user()->role->name !== 'invitado')
                    <a href="{{ route('staffs.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i> Nuevo Personal
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

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Email</th>
                                    <th>Tienda</th>
                                    <th>Estado</th>
                                    <th>Rol</th>
                                    <th width="200px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffs as $staff)
                                <tr>
                                    <td>{{ $staff->staff_id }}</td>
                                    <td>{{ $staff->first_name }}</td>
                                    <td>{{ $staff->last_name }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td>Tienda {{ $staff->store->store_id }}</td>
                                    <td>
                                        @if($staff->active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>{{ $staff->role ? $staff->role->name : 'Sin rol' }}</td>
                                    <td>
                                        <form action="{{ route('staffs.destroy', $staff->staff_id) }}" method="POST" class="d-inline">
                                            <a class="btn btn-info btn-sm" href="{{ route('staffs.show', $staff->staff_id) }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-primary btn-sm" href="{{ route('staffs.edit', $staff->staff_id) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este miembro del personal?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="pagination pagination-sm m-0 float-right">
                        {{ $staffs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection