@extends('nav-foot')

@section('title','Pisos App - Editar piso')

@section('content')

<div class="container mt-3 mb-3">
  <h2 class="mt-2 mb-4 fw-light">MODIFICAR DIRECCIÓN PISO</h2>
    <h5 class="mb-2 fw-light">{{ $direccion->comunidad }} > {{ $direccion->provincia }} > {{ $direccion->municipio }}</h5>
    <form action="{{ route('direcciones.update', $direccion) }}" method="post">
    @method('put')
    @csrf
        <input type="hidden" name="id" value="{{ $direccion->id }}">
        <input type="hidden" name="comunidad_hidden" value="{{ $direccion->comunidad }}">
        <input type="hidden" name="provincia_hidden" value="{{ $direccion->provincia }}">
        <input type="hidden" name="municipio_hidden" value="{{ $direccion->municipio }}">
        <div class="row">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" id="aviso">
                    <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill"/>
                    </svg>
                    <div>
                        {{$errors->first()}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @else
                <div class="alert-direccion alert-primary" role="alert">
                    Vuelve a seleccionar comunidad, provincia y municipio.
                </div>
            @endif
            
            <div class="col">
                @livewire('direccion-form')
            </div>
            <div class="col">
                <div class="mb-3">
                    <label class="form-label" for="calle">Calle <span class="text-danger fw-bold">(*)</span></label>
                    <input class="form-control" type="text" name="calle" id="calle" value="{{ $direccion->calle }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="numero">Número <span class="text-danger fw-bold">(*)</span></label>
                    <input class="form-control" type="number" name="numero" id="numero" value="{{ $direccion->numero }}" required>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="portal">Portal</label>
                            <input class="form-control" type="text" name="portal" id="portal" value="{{ $direccion->portal }}">
                        </div>
                        <div class="col">
                            <label class="form-label" for="cod_postal">Código postal <span class="text-danger fw-bold">(*)</span></label>
                            <input class="form-control" type="text" name="cod_postal" id="cod_postal" value="{{  $direccion->cod_postal }}" required>
                        </div>
                    </div>
                    
                </div>
                <div class="d-flex justify-content-end mt-4 mb-2">
                    <a class="btn btn-outline-primary me-3" href="{{ route('perfil.index') }}">
                    <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-arrow-left">
                            <symbol id="bi-arrow-left" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </symbol>
                        </svg>
                        <use xlink:href="#bi-arrow-left"/>
                    </svg>&nbsp;Volver atrás
                    </a>
                    <button type="submit" class="btn btn-primary">Modificar</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

