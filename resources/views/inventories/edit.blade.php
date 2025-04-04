@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Inventario</h3>
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

                    <form action="{{ route('inventories.update', $inventory->inventory_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="film_id">Película:</label>
                            <select name="film_id" class="form-control">
                                @foreach($films as $film)
                                    <option value="{{ $film->film_id }}" {{ $inventory->film_id == $film->film_id ? 'selected' : '' }}>{{ $film->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="store_id">Tienda:</label>
                            <select name="store_id" class="form-control">
                                @foreach($stores as $store)
                                    <option value="{{ $store->store_id }}" {{ $inventory->store_id == $store->store_id ? 'selected' : '' }}>{{ $store->store_id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group text-right">
                            <a class="btn btn-secondary" href="{{ route('inventories.index') }}">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection