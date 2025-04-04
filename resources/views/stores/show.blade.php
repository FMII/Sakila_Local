@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles de la Tienda</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $store->store_id }}
                    </div>

                    <div class="form-group">
                        <strong>Gerente:</strong>
                        {{ $store->manager->first_name }} {{ $store->manager->last_name }}
                    </div>

                    <div class="form-group">
                        <strong>Dirección:</strong>
                        {{ $store->address->address }}
                    </div>

                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $store->last_update }}
                    </div>

                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('stores.edit', $store->store_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('stores.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection