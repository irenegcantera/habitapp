@extends('nav-foot')

@section('title','Pisos App - Perfil')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
@endsection

@section('content')

<br>

<div class="container">
    <div class="card white-card rounded-3 border border-2 ">
        <div class="card-body">
            {{-- <div class="row d-flex align-items-center justify-content-evenly">
                <div class="col">
                    <a class="btn btn-outline-primary" href="{{ route('logout') }}">
                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                            <use xlink:href="#bi-arrow-left"/>
                        </svg>&nbsp;Volver al inicio</a>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Cerra sesión</a>
                </div>
            </div> --}}
            <div class="row d-flex align-items-center justify-content-evenly">
                <div class="col-md-3">
                    <img src="{{ asset('logo/perfil.png') }}" alt="" width="200">
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <h1>{{ $user->nombre." ".$user->apellidos }}</h1>
                        <h3 class="text-muted">{{ $user->email }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
        @if($user->rol == 'arrendatario')
            <div class="card white-card">
                <div class="card-header">
                    <h3>LISTADO DE PISOS</h3>
                </div>
                <div class="card-body">
                    <form class="mb-3" action="{{ route('pisos.create') }}" method="get">
                        <button type="submit" class="btn btn-primary fw-bold">Añadir piso</button>
                    </form>
                    @if(session('informacion'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert" id="aviso">
                            <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                            <use xlink:href="#check-circle-fill"/>
                            </svg>
                            <div>
                                {{ session('informacion') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <table class="display table table-bordered table-hover align-middle text-center">
                        <thead class="table-light align-middle">
                            <tr>
                                <th>Título</th>
                                <th>Dirección</th>
                                <th>Descripción</th>
                                <th>Precio €/mes</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        @if(isset($pisos))
                            @for($i = 0; $i < sizeof($pisos); $i++)
                                <tr>
                                    <td>{{ $pisos[$i]->titulo }}</td>
                                    @if($direcciones[$i][0]->portal == null)
                                        <td>{{ $direcciones[$i][0]->calle.", ".$direcciones[$i][0]->numero.", ".$direcciones[$i][0]->cod_postal.", "
                                        .$direcciones[$i][0]->municipio.", ".$direcciones[$i][0]->provincia.", ".$direcciones[$i][0]->comunidad; }}</td> 
                                    @else
                                        <td>{{ $direcciones[$i][0]->calle.", ".$direcciones[$i][0]->numero.", ".$direcciones[$i][0]->cod_postal.", "
                                        .$direcciones[$i][0]->cod_postal.", ".$direcciones[$i][0]->municipio.", ".$direcciones[$i][0]->provincia.", "
                                        .$direcciones[$i][0]->comunidad; }}</td> 
                                    @endif
                                    <td>{{ $pisos[$i]->descripcion }}</td>
                                    <td>{{ $pisos[$i]->precio }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                <form action="{{ route('pisos.edit', $pisos[$i]) }}" method="get">
                                                    <button type="submit" class="btn btn-warning btn-sm fw-bold">Características</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col">
                                                <form action="{{ route('direccion.edit', $direcciones[$i][0]) }}" method="get">
                                                    <button type="submit" class="btn btn-warning btn-sm fw-bold" disabled>Dirección</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    @if(count($inquilinos[$i]) == 0)
                                        <td>
                                            <form action="{{ route('pisos.destroy', $pisos[$i]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm fw-bold">Eliminar</button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            No disponible
                                        </td>
                                    @endif
                                </tr>
                            @endfor
                        @endif
                    </table>
                </div>
                <br>
            </div>
        </div>
        @elseif($user->rol == 'inquilino')
        <div class="container mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>LISTADO DE PISOS</h3>
                </div>
                <div class="card-body">
                    <table id="" class="display table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Título</th>
                                <th>Dirección</th> 
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Propietario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        @if(isset($pisos) && isset($rents) /*&& isset($propietarios)*/)
                            @for($i = 0; $i < sizeof($pisos); $i++)
                                <tr>
                                    <td>{{ $pisos[$i][0]->titulo }}</td>
                                    {{-- Dirección: calle+municipio+codPostal+provincia+comunidad --}}
                                    <td>{{ $pisos[$i][0]->calle.', '.$pisos[$i][0]->cod_postal }}</td> 
                                    @foreach ($rents as $rent)
                                        @if($rent->piso_id == $pisos[$i][0]->piso_id)
                                            <td>{{ $rent->fecha_inicio }}</td>
                                            <td>{{ $rent->fecha_fin }}</td>
                                        @endif
                                    @endforeach
                                    {{-- @foreach ($propietarios as $propietario) --}}
                                        {{-- @if($propietario->id == $piso->user_id) --}}
                                            <td>{{ $pisos[$i][0]->nombre.' '.$pisos[$i][0]->apellidos }}</td>
                                        {{-- @endif --}}
                                    {{-- @endforeach --}}
                                    <td>
                                        <form action="{{ route('pisos.show', $pisosShow[$i])}}" method="get">
                                            <button type="submit" class="btn btn-info btn-sm fw-bold">Ver Piso</button>
                                        </form>
                                    </td>
                                </tr>
                            @endfor
                        @endif
                    </table>
                </div>
            </div>
            <br> 
        </div>

        @endif
    </div>

    @endsection

    @section('js')
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
        <script>
            $('table.display').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No hay registros",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
            
        </script>
    @endsection

    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-arrow-left">
        <symbol id="bi-arrow-left" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </symbol>
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
    </svg>