@extends('nav-foot')

@section('title','Pisos App - Perfil')

@section('content')
<br>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    {{-- <form action="{{ route('perfil.update', $user) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <img src="{{ asset($user->avatar) }}" alt="" width="250">
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
                                    <img src="{{ asset($user->avatar) }}" alt="" width="150">
                                    <input class="form-control" type="file" name="avatar">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form> --}}
                </div>
                <div class="col-9 mt-5">
                    <form action="{{ route('perfil.update', $user) }}" method="post">
                        @method('put')
                        @csrf
                        <label class="form-label fw-bold">Datos personales</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nombre" value="{{ $user->nombre }}">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="apellidos" value="{{ $user->apellidos }}">
                            <label for="apellidos">Apellidos</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="{{ $user->info }}" name="info">{{ $user->info }}</textarea>
                            <label for="info">Información personal</label>
                        </div>
                        <label class="form-label fw-bold">Datos de la cuenta</label>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" value="{{ $user->username }}" readonly>
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" value="{{ $user->password }}">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" value="{{ $user->password }}">
                            <label for="password">Re-Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            <label for="email">Email</label>
                        </div>
                        <button type="submit" class="btn btn-success" value="Modificar">Modificar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection