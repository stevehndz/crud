@extends('theme.base') {{-- Extends from another view, base --}}

@section('content')
    <div class="container py-5">
        <h2 class="text-center">Listado de clientes</h2>
        <a href="{{ route('client.create') }}" class="btn btn-primary m-1 text-center">Crear cliente</a>

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table-striped table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $item) {{-- For else to fill state --}}
                        <tr>
                            <td scope="row">{{ $item->name }}</td>
                            <td>{{ $item->due }}</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="{{ route('client.edit', $item) }}">Editar</a>
                                <form action="{{ route('client.destroy', $item) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar el registro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty {{-- In case of empty table at DB --}}
                        <tr>
                            <td colespan="3">"No hay registros"</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            {{-- Table pagination --}}
            @if ($clients->count())
                <div class="d-flex justify-content-center align-items-center container">
                    {{ $clients->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
