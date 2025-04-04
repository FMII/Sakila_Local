{{-- filepath: c:\Users\panch\Documents\Proyectos\Practicas Elias\Sakila\resources\views\addresses\index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Direcciones</h3>
                <div class="card-tools">
                    {{-- Mostrar el botón "Nueva Dirección" solo si el usuario no es invitado --}}
                    @if(auth()->user()->role->name !== 'invitado')
                        <a href="{{ route('addresses.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Nueva Dirección
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
                            <th>Dirección</th>
                            <th>Distrito</th>
                            <th>Ciudad</th>
                            <th>País</th>
                            <th width="200px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($addresses as $address)
                        <tr>
                            <td>{{ $address->address_id }}</td>
                            <td>{{ $address->address }}</td>
                            <td>{{ $address->district }}</td>
                            <td>{{ $address->city->city ?? 'N/A' }}</td>
                            <td>{{ $address->city->country->country ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('addresses.destroy', $address->address_id) }}" method="POST" class="d-inline">
                                    <a class="btn btn-info btn-xs" href="{{ route('addresses.show', $address->address_id) }}">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    {{-- Mostrar los botones "Editar" y "Eliminar" solo si el usuario no es invitado --}}
                                    @if(auth()->user()->role->name !== 'invitado')
                                        <a class="btn btn-primary btn-xs" href="{{ route('addresses.edit', $address->address_id) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('¿Está seguro de eliminar esta dirección?')">
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
                {{ $addresses->links() }}
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection