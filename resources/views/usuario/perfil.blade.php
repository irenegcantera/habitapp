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
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <img src="{{ asset('logo/perfil.png') }}" alt="" width="250">
                </div>
                <div class="col-9 mt-5">
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
<br>
@if(auth()->user()->rol == 'arrendatario')
<div class="container">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Listado pisos</button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Listado inquilinos</button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">TABLA1 1</div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">TABLA 2</div>
    </div>
</div>
@elseif(auth()->user()->rol == 'inquilino')
<div class="container">
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
@endsection