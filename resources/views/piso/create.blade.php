@extends('nav-foot')

@section('title','Pisos App - Crear piso')

@section('content')

<div class="container mt-3 mb-3">
    <form action="{{ route('pisos.store') }}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label fw-bold" for="titulo">Título</label>
                    <input class="form-control" type="text" name="titulo" id="titulo">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold" for="descripcion">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3"></textarea>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label fw-bold" for="num_habitaciones">Número de habitaciones</label>
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
                        <label class="form-label fw-bold" for="num_aseos">Número de aseos</label>
                        <select class="form-select" name="num_aseos" id="num_aseos">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label fw-bold" for="m2">Superficie m2</label>
                        <input class="form-control" type="number" name="m2" id="m2">
                    </div>
                    <div class="col">
                        <label class="form-label fw-bold" for="precio">Precio €/mes</label>
                        <input class="form-control" type="number" name="precio" id="precio">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label fw-bold" for="fumadores">Fumadores</label>
                        <select class="form-select" name="fumadores" id="fumadores">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bold" for="animales">Animales domésticos</label>
                        <select class="form-select" name="animales" id="animales">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bold" for="sexo">Compañeros de piso</label>
                        <select class="form-select" name="sexo" id="sexo">
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                            <option value="mixto">Mixto</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold" for="fotos">Subir fotos</label>
                    <input class="form-control" type="file" id="fotos" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Crear piso</button>
            </div>
            {{-- Va dentro de un div --}}
            @livewire('direccion-form')
        </div>
        
    </form>
</div>

@endsection