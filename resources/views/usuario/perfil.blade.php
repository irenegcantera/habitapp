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
    <div class="row">
        <div class="col-2 h-100">
            <div class="card">
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('mensajes.index') }}" class="list-group-item list-group-item-action" aria-current="true">
                          Ver mensajes
                        </a>
                        <a href="{{ route('perfil.edit', auth()->user()) }}" class="list-group-item list-group-item-action">Editar perfil</a>
                        <a href="#" class="list-group-item list-group-item-action disabled">A third link item</a>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-10">
            <div class="card rounded-3 border border-2">
                <div class="card-body">
                    <div class="row d-flex justify-content-evenly">
                        <div class="col-md-3">
                            <img src="{{ asset('logo/perfil.png') }}" alt="" width="250">
                        </div>
                        <div class="col-md-5 mt-5">
                            <div class="mb-3">
                                <h1>{{ $user->nombre." ".$user->apellidos }}</h1>
                            </div>
                            <div class="mb-3">
                                <h1>{{ $user->info }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

@if($user->rol == 'arrendatario')
<div class="container mb-3">
    <div class="card">
        <div class="card-header">
            <h3>LISTADO DE PISOS</h3>
        </div>
        <div class="card-body">
            <form class="mb-3" action="{{ route('pisos.create') }}" method="get">
                <button type="submit" class="btn btn-success fw-bold">Añadir piso</button>
            </form>
            <table id="tabla2" class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Título</th>
                        {{-- Dirección: calle+municipio+codPostal+provincia+comunidad --}}
                        <th>Dirección</th> 
                        <th colspan="4">Inquilinos</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                </thead>
                {{-- @if(isset($pisos) && isset($inquilinos)) --}}
                    @for($i = 0; $i < sizeof($pisos); $i++)
                        <tr>
                            <td>{{ $pisos[$i]->titulo }}</td>
                            {{-- Dirección: calle+municipio+codPostal+provincia+comunidad --}}
                            @if($direcciones[$i][0]->portal == null)
                                <td>{{ $direcciones[$i][0]->calle.", ".$direcciones[$i][0]->numero.", ".$direcciones[$i][0]->cod_postal.", "
                                .$direcciones[$i][0]->municipio.", ".$direcciones[$i][0]->provincia.", ".$direcciones[$i][0]->comunidad; }}</td> 
                            @else
                                <td>{{ $direcciones[$i][0]->calle.", ".$direcciones[$i][0]->numero.", ".$direcciones[$i][0]->cod_postal.", "
                                .$direcciones[$i][0]->cod_postal.", ".$direcciones[$i][0]->municipio.", ".$direcciones[$i][0]->provincia.", "
                                .$direcciones[$i][0]->comunidad; }}</td> 
                            @endif
                            <td>INQUILINOS</td> 
                            <td>INQUILINOS</td> 
                            <td>INQUILINOS</td> 
                            <td>INQUILINOS</td> 
                            {{-- @foreach ($inquilinos as $inquilino)
                            <td><img src="{{ asset($inquilino->avatar) }}" alt="" width="50">{{ $inquilino->nombre.' '.$inquilino->apellidos }}</td> 
                            @endforeach --}}
                            <td>
                                <form action="{{ route('pisos.edit', $pisos[$i]) }}" method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm fw-bold">Editar</button>
                                </form>
                            </td>
                            <td>
                                <form action="" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm fw-bold">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endfor
                {{-- @endif --}}
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
            <table id="tabla" class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Título</th>
                        {{-- Dirección: calle+municipio+codPostal+provincia+comunidad --}}
                        <th>Dirección</th> 
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Propietario</th>
                        {{-- <th colspan="2">Acciones</th> --}}
                        <th>Acciones</th>
                    </tr>
                </thead>
                @if(isset($pisos) && isset($rents) && isset($arrendatarios))
                    @foreach($pisos as $piso)
                        <tr>
                            <td>{{ $piso->titulo }}</td>
                            {{-- Dirección: calle+municipio+codPostal+provincia+comunidad --}}
                            <td>{{ $piso->calle.', '.$piso->cod_postal }}</td> 
                            @foreach ($rents as $rent)
                                @if($rent->piso_id == $piso->id)
                                    <td>{{ $rent->fecha_inicio }}</td>
                                    <td>{{ $rent->fecha_fin }}</td>
                                @endif
                            @endforeach
                            @foreach ($arrendatarios as $arrendatario)
                                @if($arrendatario->id == $piso->user_id)
                                    <td>{{ $arrendatario->nombre.' '.$arrendatario->apellidos }}</td>
                                @endif
                            @endforeach
                            <td>
                                <form action="" method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm fw-bold">Ver Piso</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
    <br> 
</div>

@endif

@endsection


@section('scripts')
    <script>
        var exampleModal = document.getElementById('exampleModal');

        exampleModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever');
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            var modalTitle = exampleModal.querySelector('.modal-title')
            var modalBodyInput = exampleModal.querySelector('.modal-body input')

            modalTitle.textContent = 'New message to ' + recipient
            modalBodyInput.value = recipient
        });
    </script>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    <script>
        $('#tabla').DataTable({
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
    <script>
        $('#tabla2').DataTable({
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