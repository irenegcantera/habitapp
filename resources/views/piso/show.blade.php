@extends('nav-foot')

@section('title','Piso')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cards.css') }}"/>
@endsection

@section('content')
<div class="me-4 ms-4 mt-2 mb-2">
    <div class="row d-flex justify-content-around">  
        <div class="col-12 col-sm-10 col-md-10 col-lg-8">
            <div class="card white-card mb-3">
                <div id="carousel" class="carousel carousel-dark slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="{{ asset('img/pisos/prueba_piso.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="{{ asset('img/pisos/prueba_piso.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" id="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" id="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-lg-7">
                            <a class="btn btn-outline-primary me-3 mb-3" href="{{ url()->previous() }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-arrow-left">
                                    <symbol id="bi-arrow-left" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                    </symbol>
                                    <use xlink:href="#bi-arrow-left"/>
                                </svg>&nbsp;Volver atrás
                            </a>
                            <h1 class="card-title mb-4">{{ $piso->titulo }}</h1>
                            <p class="card-text fs-4 fw-bold">Descripción</p>
                            <p class="card-text fs-6 mb-3">{{ $piso->descripcion }}</p>
                            <p class="card-text fs-4 fw-bold">Detalles del piso</p>
                            <div class="row justify-content-around text-center mb-3">
                                <div class="col">
                                    <img src="{{ asset('img/iconos/room.png') }}" alt="" width="40" height="40">
                                    <p class="card-text fs-6 text-muted">
                                    @if($piso->num_habitaciones == 1)
                                        {{ $piso->num_habitaciones }} habitacion 
                                    @else
                                        {{ $piso->num_habitaciones }} habitaciones
                                    @endif
                                    </p>
                                </div>
                                <div class="col">
                                    <img src="{{ asset('img/iconos/bath.png') }}" alt="" width="40" height="40">
                                    <p class="card-text fs-6 text-muted">
                                    @if($piso->num_aseos == 1)
                                        {{ $piso->num_aseos }} aseo 
                                    @else
                                        {{ $piso->num_aseos }} aseos 
                                    @endif
                                    </p>
                                </div>
                                <div class="col">
                                    <img src="{{ asset('img/iconos/tiles.png') }}" alt="" width="40" height="40">
                                    <p class="card-text fs-6 text-muted">
                                        {{ $piso->m2 }} m2
                                    </p>
                                </div>
                            </div>
                            <p class="card-text fs-4 fw-bold">Normas del piso</p>
                            <div class="row justify-content-around text-center mb-3">
                                <div class="col">
                                    @if($piso->sexo == "mujer")
                                        <img src="{{ asset('img/iconos/woman.png') }}" alt="" width="40" height="40">
                                        <p class="card-text fs-6 text-muted">Mujer</p>
                                    @elseif($piso->sexo == "hombre")
                                        <img src="{{ asset('img/iconos/man.png') }}" alt="" width="40" height="40">
                                        <p class="card-text fs-6 text-muted">Hombre</p>
                                    @else
                                        <img src="{{ asset('img/iconos/user.png') }}" alt="" width="40" height="40">
                                        <p class="card-text fs-6 text-muted">Mixto</p>
                                    @endif
                                </div>
                                <div class="col">
                                    @if($piso->fumadores == 1)
                                        <img src="{{ asset('img/iconos/cigarrete.png') }}" alt="" width="40" height="40">
                                        <p class="card-text fs-6 text-muted">Permitido fumar</p>
                                    @else
                                        <img src="{{ asset('img/iconos/no-smoking.png') }}" alt="" width="40" height="40">
                                        <p class="card-text fs-6 text-muted">NO fumar</p>
                                    @endif
                                </div>
                                <div class="col">
                                    @if($piso->animales == 1)
                                        <img src="{{ asset('img/iconos/paws.png') }}" alt="" width="40" height="40">
                                        <p class="card-text fs-6 text-muted">Permitido animales</p>
                                    @else
                                        <img src="{{ asset('img/iconos/no-animal.png') }}" alt="" width="40" height="40">
                                        <p class="card-text fs-6 text-muted">NO animales</p>
                                    @endif
                                </div>
                            </div>
                            <p class="card-text fs-4 fw-bold">Alquiler mensual</p>
                            <p class="card-text fs-5 fw-light">{{ $piso->precio }} €/mes</p>

                            <p class="card-text fs-4 fw-bold">Compañeros de piso</p>
                            <div>
                                @if(isset($inquilinos))
                                @foreach ($inquilinos as $inquilino)
                                    <a class="me-3" id="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $inquilino->username }}">
                                        <img src="{{ asset('logo/perfil.png') }}" width="50">
                                    </a>
                                    
                                @endforeach
                                @endif
                                @for($i = 0; $i < $habitaciones_libres; $i++)
                                    <a class="me-3" id="tooltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Libre">
                                        <svg class="bi flex-shrink-0 me-2" width="35" height="35" role="img" aria-label="Info:">
                                            {{-- ICONO LIBRE --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-plus-circle">
                                                <symbol id="plus-circle" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                </symbol>
                                            </svg>
                                            <use xlink:href="#plus-circle"/>
                                        </svg>
                                    </a>
                                @endfor
                            </div>
                            
                            
                            <p class="card-text fs-4 fw-bold mt-3">Ubicación</p>
                            <p class="card-text fs-6 text-muted">
                                {{ $direccion[0]->calle }},
                                {{ $direccion[0]->numero }},
                                @if(!empty($direccion[0]->portal))
                                    {{ $direccion[0]->portal }},
                                @endif
                                {{ $direccion[0]->cod_postal }},
                                @if(!empty($direccion[0]->municipio))
                                    {{ $direccion[0]->municipio }},
                                @endif
                                {{ $direccion[0]->provincia }},
                                {{ $direccion[0]->comunidad }}
                            </p>
                            <div class="mt-3 mb-5" id="map"></div>
                        </div>
                        <div class="col-lg-5 mt-5">
                            <div class="card white-card border-light mb-5" id="card-shadow">
                                <div class="card-header fs-4 fw-bold">Datos arrendatario</div>
                                <div class="card-body">
                                    <img src="{{ asset('logo/perfil.png') }}" class="card-img-contain" alt="...">
                                    <p class="card-text fs-3">{{ $arrendatario->nombre." ".$arrendatario->apellidos }}</p>
                                    <p class="card-text fs-4 fw-bold">Sobre mí</p>
                                    <p class="card-text fs-6">{{ $arrendatario->info }}</p>
                                    @if (auth()->check())
                                        <a href="https://api.whatsapp.com/send?phone=34{{ $arrendatario->telefono }}&text=Piso%20{{ $piso->id }}%20'{{ $piso->titulo }}':%20">
                                            <img class="me-3" src="{{ asset('img/iconos/whatsapp.png') }}"  width="35" height="35" alt="">Contactar vía WhatsApp
                                        </a>

                                    @endif
                                </div>
                                
                            </div>
                            <form action="{{ route('mensajes.store') }}" method="post" enctype="multipart/form-data">
                                @if (auth()->check())
                                    @csrf
                                    <h6 class="card-title fs-5 fw-bold mb-4">Enviar mensaje</h6>
                                    <label for="from_user" class="form-label">User</label>
                                    <input type="text" class="form-control" value="{{ auth()->user()->username }}" readonly>
                                    <label for="contenido" class="form-label mt-3">Mensaje</label>
                                    <textarea name="contenido" class="form-control" rows="5"></textarea>
                                    <button class="btn btn-primary mt-4" wire:click="enviarMensaje">Enviar</button>
                                    @if(session('informacion'))
                                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mt-4" role="alert" id="aviso">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                                                <symbol id="check-circle-fill">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                </symbol>
                                                <use xlink:href="#check-circle-fill"/>
                                            </svg>               
                                            {{ session('informacion') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                @else
                                    <div class="alert alert-warning mt-3" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                                            <use xlink:href="#info-fill"/>
                                        </svg>
                                        Para contactar con el propietario debe <a href="{{ route('login') }}" class="alert-link">iniciar sesión</a>
                                        o <a href="{{ route('registrar') }}" class="alert-link">registrarse</a>.
                                    </div>                                    
                                @endif
                                <input type="hidden" name="from_user" value="{{ auth()->check() == null ? null : auth()->user()->id }}">
                                <input type="hidden" name="to_user" value="{{ $arrendatario->id }}">
                                <input type="hidden" name="piso_id" value="{{ $piso->id }}">
                            </form>
                        </div>
                            
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
        $('#prev').click(function(){
          $('#carousel').carousel("prev");
        });
      
        // Cycles to the next item
        $('#next').click(function(){
          $('#carousel').carousel("next");
        });
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
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