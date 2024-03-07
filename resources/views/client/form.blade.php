@extends('theme.base') {{-- Extends from another view, base --}}

@section('content')
    <div class="bg-primary min-vh-100 d-flex justify-content-center align-items-center p-2">
        <div class="col-5 bg-light rounded-top rounded-bottom container p-5">
            @if (isset($client))
                {{-- isset for exits or not exists client --}}
                <h2 class="text-center">Editar cliente</h2>
            @else
                <h2 class="text-center">Crear cliente</h2>
            @endif

            @if (isset($client))
                <form action="{{ route('client.update', $client) }}" method="POST">
                    @method('put')
                @else
                    <form action="{{ route('client.store') }}" method="POST">
            @endif

            @csrf {{-- Token de autorizacion --}}

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Ingresa tu nombre"
                    value="{{ old('name') ?? @$client->name }}" />
                @error('name')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="due" class="form-label">Saldo</label>
                <input type="number" class="form-control" name="due" id="due" placeholder="100.00" step="0.01"
                    value="{{ old('due') ?? @$client->due }}" />
                @error('due')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Comentario</label>
                <textarea class="form-control" name="comment" id="comment" rows="4">{{ old('comment') ?? @$client->comment }}</textarea>
                @error('comment')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="row">
                <div class="d-flex col-4 justify-content-center align-items-center text-center">
                    <button type="submit" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="d-flex col-4 justify-content-center align-items-center text-center">
                    <a class="btn btn-sm btn-danger w-100" role="button" href="{{ route('client.index') }}">Cancelar</a>
                </div>
            </div>

            </form>
        </div>
    </div>
@endsection
