@extends('nav-foot')

@section('title','Pisos App - Editar perfil')

@section('content')
<br>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="col-9 mt-5">
                <form action="{{ route('pisos.update', $piso) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="row gx-5">
                        <div class="col-5">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" name="titulo" value="{{ $piso->titulo }}">
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" value="{{ $user->apellidos }}">
                            </div>
                            <div class="mb-3">
                                <label for="info" class="form-label">Sobre mí</label>
                                <textarea class="form-control" placeholder="{{ $user->info }}" name="info">{{ $user->info }}</textarea>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" value="{{ $user->password }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" value="Modificar">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<select class="form-select form-select-sm mb-3" name="comunidad">
    <option selected>Comunidad...</option>
    <option value="1">Región de Murcia</option>
    <option value="1">Comunidad valenciana</option>
  </select>

  <select class="form-select form-select-sm mb-3" name="provincia">
    <option selected>Provincia...</option>
    <option value="1">Murcia</option>
  </select>

  <select class="form-select form-select-sm mb-3" name="municipio">
      <option selected>Municipio...</option>
      <option value="1">Mula</option>
  </select>

  {{-- <h1>{{ $first['geometry']['lng'] . ';' . $first['geometry']['lat'] }}</h1> --}}
  <label for="precio" class="form-label fw-bold">Precio</label>
  <input type="text" class="form-control form-control-sm" name="place" name="precioMin" placeholder="Mín. 150 €">
  <input type="text" class="form-control form-control-sm mt-2" name="place" name="precioMax" placeholder="Máx. 1000 €">

  <label for="num_habitaciones" class="form-label fw-bold mt-2">Número de habitaciones</label>
  <input type="range" class="form-range" min="0" max="6" step="1" name="num_habitaciones" value="0">

  <label for="num_aseos" class="form-label fw-bold">Número de aseos</label>
  <input type="range" class="form-range" min="0" max="3" step="1" name="num_aseos" value="0">

  <label for="fumadores" class="form-label fw-bold">Fumadores</label><br>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="fumadoresSI" value="true">
    <label class="form-check-label" for="fumadoresSI">Sí</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="fumadoresNO" value="false">
    <label class="form-check-label" for="fumadoresNO">No</label>
  </div>

  <br><label for="animales" class="form-label fw-bold">Animales domésticos</label><br>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="animalesSI" value="true">
    <label class="form-check-label" for="animalesSI">Sí</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="animalesNO" value="false">
    <label class="form-check-label" for="animalesNO">No</label>
  </div>

  <br><label for="animales" class="form-label fw-bold">Compañeros de piso</label><br>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" name="sexoHombre" value="hombre">
    <label class="form-check-label" for="sexoHombre">Hombre</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" name="sexoMujer" value="mujer">
    <label class="form-check-label" for="sexoMujer">Mujer</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" name="sexoMixto" value="mixto">
    <label class="form-check-label" for="sexoMixto">Mixto</label>
  </div>