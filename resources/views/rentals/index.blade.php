@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Alquileres</h3>
                    @if(auth()->user()->role->name !== 'invitado')
                    <a href="{{ route('rentals.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i> Nuevo Alquiler
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
                                <th>Fecha de Alquiler</th>
                                <th>Inventario</th>
                                <th>Cliente</th>
                                <th>Fecha de Devolución</th>
                                <th>Empleado</th>
                                <th>Última Actualización</th>
                                <th width="280px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rentals as $rental)
                            <tr>
                                <td>{{ $rental->rental_id }}</td>
                                <td>{{ $rental->rental_date }}</td>
                                <td>{{ $rental->inventory->film->title }}</td>
                                <td>{{ $rental->customer->first_name }} {{ $rental->customer->last_name }}</td>
                                <td>{{ $rental->return_date }}</td>
                                <td>{{ $rental->staff->first_name }} {{ $rental->staff->last_name }}</td>
                                <td>{{ $rental->last_update }}</td>
                                <td>
                                    <form action="{{ route('rentals.destroy', $rental->rental_id) }}" method="POST" class="d-inline">
                                        <a class="btn btn-info btn-sm" href="{{ route('rentals.show', $rental->rental_id) }}">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        @if(auth()->user()->role->name !== 'invitado')
                                        <a class="btn btn-primary btn-sm" href="{{ route('rentals.edit', $rental->rental_id) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este alquiler?')">
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
                        {{ $rentals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection