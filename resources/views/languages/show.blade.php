@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Detalles del Idioma</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>ID:</strong>
                        {{ $language->language_id }}
                    </div>

                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $language->name }}
                    </div>

                    <div class="form-group">
                        <strong>Última Actualización:</strong>
                        {{ $language->last_update }}
                    </div>

                    <div class="form-group text-right">
                        @if(auth()->user()->role->name !== 'invitado')
                        <a class="btn btn-primary" href="{{ route('languages.edit', $language->language_id) }}">Editar</a>
                        @endif
                        <a class="btn btn-secondary" href="{{ route('languages.index') }}">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection