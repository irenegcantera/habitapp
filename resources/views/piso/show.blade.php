@extends('nav-foot')

@section('title','Piso')

@section('content')
<div class="me-4 ms-4 mt-2 mb-2">
    <div class="row d-flex justify-content-around">  
        <div class="col-8">
            <div class="card mb-3">
                <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="{{ asset('img/pisos/prueba_piso.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="{{ asset('img/pisos/prueba_piso.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-lg-7">
                            <h5 class="card-title fs-3">{{ $piso->titulo }}</h5>

                            <p class="card-text fs-5 fw-bold">Descripción</p>
                            <p class="card-text">{{ $piso->descripcion }}</p>

                            <p class="card-text fs-5 fw-bold">Detalles del piso</p>
                            <p class="card-text text-muted">{{ $piso->num_habitaciones }} habitaciones · {{ $piso->num_aseos }} aseos · {{ $piso->m2 }} m2</p>
                            <p class="card-text fs-5 fw-bold">Normas del piso</p>
                            <p class="card-text">{{ $piso->sexo }}</p>
                            @if($piso->fumadores)
                                <p class="card-text text-muted">Fumadores · 
                            @else
                                <p class="card-text text-muted">NO fumadores · 
                            @endif
                            @if($piso->animales)
                                Animales domésticos</p>
                            @else
                                NO animales domésticos</p>
                            @endif

                            <p class="card-text fs-5 fw-bold">Precio mensual</p>
                            <p class="card-text fs-6 fw-bold">{{ $piso->precio }} €/mes</p>

                            <p class="card-text fs-5 fw-bold">Compañeros de piso</p>
                            @if(!isset($inquilinos))
                                @foreach ($inquilinos as $inquilino)
                                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""><img src="{{ asset('logo/perfil.png') }}" width="40"></a>
                                @endforeach
                            @else
                                @for($i = 0; $i < $piso->num_habitaciones; $i++)
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                                        <use xlink:href="#plus-circle"/>
                                    </svg>
                                @endfor
                            @endif
                            
                            <p class="card-text fs-5 fw-bold mt-3">Ubicación</p>
                            <p class="card-text">{{ $piso->calle }}, {{ $piso->cod_postal }}</p>
                            <div class="mt-3 mb-5" id="map"></div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card border-light mb-3">
                                <div class="card-header fs-4 fw-bold">Datos arrendatario</div>
                                <div class="card-body">
                                    <br>
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ asset('logo/perfil.png') }}" alt="..." width="100">
                                        </div>
                                        <div class="col-8">
                                            <p class="card-text">{{ $arrendatario->nombre." ".$arrendatario->apellidos }}</p>
                                        </div>
                                        <p class="card-text fs-5 fw-bold">Sobre mí</p>
                                        <p class="card-text">{{ $arrendatario->info }}</p>
                                    </div>
                                {{-- <p class="card-text"><a href="{{ route('pisos.index') }}">Ver más pisos</a></p> --}}
                                </div>
                            </div>
                            <form action="{{ route('mensajes.create') }}" method="post" enctype="multipart/form-data">
                                @if (auth()->check())
                                    <h6 class="card-title">Enviar mensaje</h6>
                                    <label for="from_user" class="form-label">User</label>
                                    <input type="text" name="from_user" class="form-control" value="{{ auth()->user()->username }}" readonly>
                                    <label for="contenido" class="form-label">Mensaje</label>
                                    <textarea name="contenido" class="form-control" rows="7"></textarea>
                                    {{-- Div notificacion --}}
                                    @livewire('mensaje.notificacion')
                                @else
                                    <div class="alert alert-warning mt-3" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                                            <use xlink:href="#info-fill"/>
                                        </svg>
                                        Para contactar con el propietario debe <a href="{{ route('login') }}" class="alert-link">iniciar sesión</a>
                                        o <a href="{{ route('registrar') }}" class="alert-link">registrarse</a>.
                                    </div>                                    
                                @endif
                                <input type="hidden" name="to_user" value="{{ $arrendatario->username }}">
                                <input type="hidden" name="piso_id" value="{{ $piso->id }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        // var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        //     return new bootstrap.Tooltip(tooltipTriggerEl)
        // })
    </script>
     <script>
        let latlng = L.latLng([{{ $piso->longitud}}, {{ $piso->latitud}} ]);
        let map = L.map('map').setView(latlng, 6.5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', 
        {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    
        var markerOptions = { riseOnHover: true }
        var marker = L.marker([{{ $piso->longitud }}, {{ $piso->latitud }}], markerOptions).addTo(map);

        map.addControl(new L.Control.Fullscreen());

      </script>
@endsection

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-plus-circle">
    <symbol id="plus-circle" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
    </symbol>
</svg>