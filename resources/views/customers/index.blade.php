{{-- filepath: c:\Users\panch\Documents\Proyectos\Practicas Elias\Sakila\resources\views\customers\index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="float-left">Clientes</h3>
                    {{-- Mostrar el botón "Nuevo Cliente" solo si el usuario no es invitado --}}
                    @if(auth()->user()->role->name !== 'invitado')
                        <a href="{{ route('customers.create') }}" class="btn btn-primary float-right">
                            <i class="fas fa-plus"></i> Nuevo Cliente
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
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Activo</th>
                                <th>Tienda</th>
                                <th>Última Actualización</th>
                                <th width="280px">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->customer_id }}</td>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->active ? 'Sí' : 'No' }}</td>
                                <td>{{ $customer->store->store_id }}</td>
                                <td>{{ $customer->last_update }}</td>
                                <td>
                                    <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" class="d-inline">
                                        <a class="btn btn-info btn-sm" href="{{ route('customers.show', $customer->customer_id) }}">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        {{-- Mostrar los botones "Editar" y "Eliminar" solo si el usuario no es invitado --}}
                                        @if(auth()->user()->role->name !== 'invitado')
                                            <a class="btn btn-primary btn-sm" href="{{ route('customers.edit', $customer->customer_id) }}">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este cliente?')">
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
                <div class="card-footer clearfix">
                    @if(isset($customers) && method_exists($customers, 'links'))
                        <div class="pagination pagination-sm m-0 float-right">
                            {{ $customers->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection