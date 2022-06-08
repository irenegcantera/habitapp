@extends('nav-foot')

@section('title','Pisos App - Crear piso')

@section('content')

<div class="container mt-3 mb-3">
    <h2 class="mb-4 fw-light">NUEVO PISO</h2>
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
    @endif
    <form action="{{ route('pisos.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label fw-bold" for="titulo">Título <span class="text-danger">(*)</span></label>
                    <input class="form-control" type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold" for="descripcion">Descripción <span class="text-danger">(*)</span></label>
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3" required>{{ old('descripcion') }}</textarea>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label fw-bold" for="num_habitaciones">Número de habitaciones <span class="text-danger fw-bold">(*)</span></label>
                        <select class="form-select" name="num_habitaciones" id="num_habitaciones">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bold" for="num_aseos">Número de aseos <span class="text-danger fw-bold">(*)</span></label>
                        <select class="form-select" name="num_aseos" id="num_aseos">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label fw-bold" for="m2">Superficie m2 <span class="text-danger fw-bold">(*)</span></label>
                        <input class="form-control" type="number" name="m2" id="m2"  value="{{ old('m2') }}" required>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bold" for="precio">Precio €/mes <span class="text-danger">(*)</span></label>
                        <input class="form-control" type="number" name="precio" id="precio" value="{{ old('precio') }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label fw-bold" for="fumadores">Fumadores <span class="text-danger fw-bold">(*)</span></label>
                        <select class="form-select" name="fumadores" id="fumadores">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                            <option value="2">Indiferente</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bold" for="animales">Animales domésticos <span class="text-danger fw-bold">(*)</span></label>
                        <select class="form-select" name="animales" id="animales">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                            <option value="2">Indiferente</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bold" for="sexo">Compañeros de piso <span class="text-danger fw-bold">(*)</span></label>
                        <select class="form-select" name="sexo" id="sexo">
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                            <option value="mixto">Indiferente</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold" for="fotos">Subir fotos</label>
                    <input class="form-control" type="file" name="fotos[]" id="fotos" accept="image/*"  multiple>
                </div>
            </div>
            <div class="col-lg-6">
                <label class="fw-bold mb-2" for="direccion">Dirección</label><br>
                @livewire('direccion-form')
                <div class="row">
                    <div class="col-8">
                        <label class="form-label" for="calle">Calle <span class="text-danger fw-bold">(*)</span></label>
                        <input class="form-control" type="text" name="calle" id="calle" value="{{ old('calle') }}" required>
                    </div>
                    <div class="col-4">
                        <label class="form-label" for="cod_postal">Código postal <span class="text-danger fw-bold">(*)</span></label>
                        <input class="form-control" type="number" name="cod_postal" id="cod_postal" value="{{ old('cod_postal') }}" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label class="form-label" for="numero">Número <span class="text-danger fw-bold">(*)</span></label>
                        <input class="form-control" type="number" name="numero" id="numero" value="{{ old('numero') }}" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="portal">Portal</label>
                        <input class="form-control" type="text" name="portal" id="portal" value="{{ old('portal') }}">
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-5">
                    <a class="btn btn-outline-primary me-3" href="{{ route('perfil.index') }}">
                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                            <use xlink:href="#bi-arrow-left"/>
                        </svg>&nbsp;Volver atrás
                    </a>
                    <button type="submit" class="btn btn-primary">Crear piso</button>
                </div>
                
            </div>
        </div>
    </form>
</div>

@endsection

