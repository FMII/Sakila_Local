
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-user"></i> Detalle del Usuario
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="m-0">{{ $user->name }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 30%"><i class="fas fa-id-card"></i> ID:</th>
                                                    <td>{{ $user->id }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-user"></i> Nombre:</th>
                                                    <td>{{ $user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-envelope"></i> Email:</th>
                                                    <td>{{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-user-tag"></i> Rol:</th>
                                                    <td>
                                                        <span class="badge bg-info text-white">{{ $user->role->name }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-envelope-open"></i> Verificación:</th>
                                                    <td>
                                                        @if($user->email_verified_at)
                                                            <span class="badge bg-success">Verificado: {{ $user->email_verified_at->format('d/m/Y H:i') }}</span>
                                                        @else
                                                            <span class="badge bg-warning text-dark">No verificado</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-calendar-alt"></i> Creado:</th>
                                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-edit"></i> Actualizado:</th>
                                                    <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Volver
                                        </a>
                                        <div>
                                            @if(auth()->user()->role->name !== 'invitado')
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            @endif
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
</div>

@endsection