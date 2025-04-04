@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del Inventario</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $inventory->inventory_id }}
                    </div>

                    <div class="form-group">
                        <strong>Película:</strong>
                        {{ $inventory->film->title }}
                    </div>

                    <div class="form-group">
                        <strong>Tienda:</strong>
                        {{ $inventory->store->store_id }}
                    </div>

                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $inventory->last_update }}
                    </div>

                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('inventories.edit', $inventory->inventory_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('inventories.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection