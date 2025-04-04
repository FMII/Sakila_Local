@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-user"></i> Detalle del Personal
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="m-0">{{ $staff->first_name }} {{ $staff->last_name }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 30%"><i class="fas fa-id-card"></i> ID:</th>
                                                    <td>{{ $staff->staff_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-user"></i> Nombre:</th>
                                                    <td>{{ $staff->first_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-user"></i> Apellido:</th>
                                                    <td>{{ $staff->last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-envelope"></i> Email:</th>
                                                    <td>{{ $staff->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-map-marker-alt"></i> Dirección:</th>
                                                    <td>{{ $staff->address->address }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-store"></i> Tienda:</th>
                                                    <td>Tienda {{ $staff->store->store_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-toggle-on"></i> Estado:</th>
                                                    <td>
                                                        @if($staff->active)
                                                            <span class="badge bg-success">Activo</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactivo</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-user-tag"></i> Nombre de Usuario:</th>
                                                    <td>{{ $staff->username }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-user-shield"></i> Rol:</th>
                                                    <td>{{ $staff->role ? $staff->role->name : 'Sin rol asignado' }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-calendar-alt"></i> Última Actualización:</th>
                                                    <td>{{ $staff->last_update }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="text-right mt-4">
                                        <a class="btn btn-secondary" href="{{ route('staffs.index') }}">
                                            <i class="fas fa-arrow-left"></i> Volver
                                        </a>
                                        <a class="btn btn-primary" href="{{ route('staffs.edit', $staff->staff_id) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection