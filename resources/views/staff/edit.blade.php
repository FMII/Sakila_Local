@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-user-edit"></i> Editar Personal
                    </h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>¡Ups!</strong> Hay algunos problemas con tus datos.<br><br>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('staffs.update', $staff->staff_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">Nombre:</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ old('first_name', $staff->first_name) }}" placeholder="Nombre">
                                    @if($errors->has('first_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('first_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Apellido:</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ old('last_name', $staff->last_name) }}" placeholder="Apellido">
                                    @if($errors->has('last_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('last_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo electrónico:</label>
                                    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', $staff->email) }}" placeholder="ejemplo@correo.com">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address_id">Dirección:</label>
                                    <select name="address_id" id="address_id" class="form-control {{ $errors->has('address_id') ? 'is-invalid' : '' }}">
                                        <option value="">Seleccione una dirección</option>
                                        @foreach($addresses as $address)
                                            <option value="{{ $address->address_id }}" {{ old('address_id', $staff->address_id) == $address->address_id ? 'selected' : '' }}>
                                                {{ $address->address }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('address_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('address_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="store_id">Tienda:</label>
                                    <select name="store_id" id="store_id" class="form-control {{ $errors->has('store_id') ? 'is-invalid' : '' }}">
                                        <option value="">Seleccione una tienda</option>
                                        @foreach($stores as $store)
                                            <option value="{{ $store->store_id }}" {{ old('store_id', $staff->store_id) == $store->store_id ? 'selected' : '' }}>
                                                Tienda {{ $store->store_id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('store_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('store_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="active">Estado:</label>
                                    <select name="active" id="active" class="form-control {{ $errors->has('active') ? 'is-invalid' : '' }}">
                                        <option value="1" {{ old('active', $staff->active) == '1' ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ old('active', $staff->active) == '0' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                    @if($errors->has('active'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('active') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Nombre de Usuario:</label>
                                    <input type="text" name="username" id="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username', $staff->username) }}" placeholder="Nombre de Usuario">
                                    @if($errors->has('username'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('username') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Contraseña (dejar en blanco para mantener la actual):</label>
                                    <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Mínimo 8 caracteres">
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rol_id">Rol:</label>
                                    <select name="rol_id" id="rol_id" class="form-control {{ $errors->has('rol_id') ? 'is-invalid' : '' }}">
                                        <option value="">Seleccione un rol</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('rol_id', $staff->rol_id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('rol_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('rol_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <a class="btn btn-secondary" href="{{ route('staffs.index') }}">
                                        <i class="fas fa-arrow-left"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection