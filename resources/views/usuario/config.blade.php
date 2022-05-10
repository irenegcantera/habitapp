@extends('nav-foot')

@section('title','Pisos App - Perfil configuración')

@section('content')
<br>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <form action="">
                    <div class="col-3">
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
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </div>
                            </div>
                        </div>
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
                </form>
            </div>
        </div>
    </div>
</div>
<br>
@endsection