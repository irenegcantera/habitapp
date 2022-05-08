@extends('nav-foot')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <form action="">
                <img src="{{ asset('logo/perfil.png') }}" alt="" width="250">
                <br>
                <button type="button" class="btn btn-danger" value="Eliminar">Eliminar</button>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Cambiar</button>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cambiar foto perfil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="formFile" class="form-label">Default file input example</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-9 mt-5">
            <div class="row gx-5">
                <div class="col-5">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos">
                    </div>
                    <div class="mb-3">
                        <label for="info" class="form-label">Sobre mí</label>
                        <textarea class="form-control" placeholder="" id="info"></textarea>
                    </div>
                </div>
                <div class="col-7">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success" value="Modificar">Modificar</button>
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
@else
<div class="container">
    <div class="row">
        <div class="col">
            <h1>LISTADO DE PISOS:</h1>
        </div>
    </div>
    
    <br>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
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
        {{-- @foreach($clientes as $cliente) --}}
            <tr>
                <td>ID</td>
                <td>Título</td>
                <td>Dirección</td> 
                <td>Fecha Inicio</td>
                <td>Fecha Fin</td>
                <td>Propietario</td>
                <td>
                    <form action="" method="get">
                        @csrf
                        <button type="submit" class="btn btn-info btn-sm fw-bold">Ver Piso</button>
                    </form>
                </td>
            </tr>
        {{-- @endforeach --}}
    </table>
    {{-- <br>
    <div class="d-flex justify-content-center">
        {{ $clientes->links() }}
    </div> --}}
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