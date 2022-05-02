@extends('perfil')

@section('title','Perfil arrendatario')

@section('tabla-pisos')
    <div class="container">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>CALLE</th>
                    <th>POBLACIÓN</th>
                    <th>PROVINCIA</th>
                    <th>COD POSTAL</th>
                    <th>DESCRIPCIÓN</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>
            @foreach($clientes as $cliente)
                <tr>
                    <td>
                        @if(!empty($cliente->avatar))
                            <img src="{{ asset('storage/images/'.$cliente->avatar) }}" width="60" height="54" class="d-inline-block align-text-top">
                        @else
                            <img src="{{ asset('img/avatar.png') }}" width="60" height="54" class="d-inline-block align-text-top">
                        @endif
                    </td>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nif }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->poblacion }}</td>
                    <td>{{ $cliente->provincia }}</td>
                    <td>{{ $cliente->cod_postal }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>
                        <form action="{{ route('clientes.show', $cliente) }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm fw-bold">Info</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('clientes.edit', $cliente) }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm fw-bold">Editar</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm fw-bold">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <br>
        <div class="d-flex justify-content-center">
            {{ $clientes->links() }}
        </div>
    </div>
@endsection