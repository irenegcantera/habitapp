@extends('nav-foot')

@section('title','Pisos App - Editar piso')

@section('content')

<div class="container mt-3 mb-3">
  <h2 class="mb-4 fw-light">MODIFICAR CARACTERÍSTICAS PISO</h2>
      <form action="{{ route('pisos.update', $piso) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="hidden" name="id" value="{{ $piso->id }}">
        <div class="row">
          <div class="col">
              <div class="mb-3">
                <label class="form-label fw-bold" for="titulo">Título <span class="text-danger">(*)</span></label>
                <input class="form-control" type="text" name="titulo" id="titulo" value="{{ $piso->titulo }}" required>
              </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label class="form-label fw-bold" for="fotos">Subir fotos</label>
              <input class="form-control" type="file" id="fotos" multiple>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold" for="descripcion">Descripción <span class="text-danger">(*)</span></label>
            <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3">{{ $piso->descripcion }}</textarea>
          </div>
          <div class="row mb-3">
              <div class="col">
                  <label class="form-label fw-bold" for="num_habitaciones">Número de habitaciones</label>
                  <select class="form-select" name="num_habitaciones" id="num_habitaciones">
                    @for($i = 1; $i < 7; $i++)
                      @if($piso->num_habitaciones == "$i")
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                      @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor                      
                  </select>
              </div>
              <div class="col">
                  <label class="form-label fw-bold" for="num_aseos">Número de aseos</label>
                  <select class="form-select" name="num_aseos" id="num_aseos">
                    @for($i = 1; $i < 4; $i++)
                      @if($piso->num_aseos == "$i")
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                      @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor    
                  </select>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col">
                  <label class="form-label fw-bold" for="m2">Superficie m2</label>
                  <input class="form-control" type="number" name="m2" id="m2" value="{{ $piso->m2 }}" required>
              </div>
              <div class="col">
                  <label class="form-label fw-bold" for="precio">Precio €/mes <span class="text-danger">(*)</span></label>
                  <input class="form-control" type="number" name="precio" id="precio" value="{{ $piso->precio }}" required>
              </div>
          </div>
          <div class="row mb-3">
              <div class="col">
                  <label class="form-label fw-bold" for="fumadores">Fumadores</label>
                  <select class="form-select" name="fumadores" id="fumadores">
                    @if($piso->fumadores == "0")
                      <option value="0" selected>No</option>
                      <option value="1">Sí</option>
                    @endif
                    @if($piso->fumadores == "1")
                      <option value="0">No</option>
                      <option value="1" selected>Sí</option>
                    @endif
                  </select>
              </div>
              <div class="col">
                  <label class="form-label fw-bold" for="animales">Animales domésticos</label>
                  <select class="form-select" name="animales" id="animales">
                    @if($piso->animales == "0")
                      <option value="0" selected>No</option>
                      <option value="1">Sí</option>
                    @endif
                    @if($piso->animales == "1")
                      <option value="0">No</option>
                      <option value="1" selected>Sí</option>
                    @endif
                  </select>
              </div>
              <div class="col">
                  <label class="form-label fw-bold" for="sexo">Compañeros de piso</label>
                  <select class="form-select" name="sexo" id="sexo">
                    @if($piso->sexo == "hombre")
                      <option value="hombre" selected>Hombre</option>
                      <option value="mujer">Mujer</option>
                      <option value="mixto">Mixto</option>
                    @endif
                    @if($piso->sexo == "mujer")
                      <option value="hombre">Hombre</option>
                      <option value="mujer" selected>Mujer</option>
                      <option value="mixto">Mixto</option>
                    @endif
                    @if($piso->sexo == "mixto")
                      <option value="hombre">Hombre</option>
                      <option value="mujer">Mujer</option>
                      <option value="mixto" selected>Mixto</option>
                    @endif
                  </select>
              </div>
          </div>
          
          <br>
          <div class="d-flex justify-content-end mt-4">
            <a class="btn btn-outline-primary me-3" href="{{ route('perfil.index') }}">
              <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                  <use xlink:href="#bi-arrow-left"/>
              </svg>&nbsp;Volver atrás
            </a>
            <button type="submit" class="btn btn-primary">Modificar</button>
          </div>
        </div>
      </form>
</div>

@endsection

<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-arrow-left">
    <symbol id="bi-arrow-left" fill="currentColor" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
    </symbol>
</svg>