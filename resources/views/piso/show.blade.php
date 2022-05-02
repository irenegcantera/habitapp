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
                    <div class="row">
                        <div class="col-lg-7">
                            <h5 class="card-title">{{ $piso->titulo }}</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">{{ $piso->num_dormitorios }} habitaciones · {{ $piso->num_aseos }} aseos · {{ $piso->m2 }} m2</small></p>
                            <p class="card-text">{{ $piso->precio }} €/mes</p>
                            <p>Inquilinos</p>
                            @foreach ($inquilinos as $inquilino)
                                <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="username"><img src="{{ asset('logo/perfil.png') }}" width="40"></a>
                            @endforeach

                            <div id="map"></div>
                        </div>
                        <div class="col-lg-5">
                            {{-- <img src="..." class="card-img-top" alt="..."> --}}
                            <h5 class="card-title">Datos arrendatario</h5>
                            <p class="card-text">{{ $arrendatario->nombre." ".$arrendatario->apellido1." ".$arrendatario->apellido2 }}</p>
                            <p class="card-text"><a href="">Ver más pisos</a></p>
                            <h6 class="card-title">Enviar mensaje</h6>
                            <form action="{{--{{ route('mensajes.create') }}--}}" method="post" enctype="multipart/form-data">
                                @if (auth()->check())
                                    <label for="from_user" class="form-label">User</label>
                                    <input type="text" name="from_user" class="form-control" value="Username" readonly>
                                    <label for="contenido" class="form-label">Mensaje</label>
                                    <textarea name="contenido" class="form-control"></textarea>
                                    <br><button class="btn btn-primary">Enviar</button>
                                @else
                                    <label for="from_user" class="form-label">User</label>
                                    <input type="text" name="from_user" class="form-control" value="Username" disabled>
                                    <label for="contenido" class="form-label">Mensaje</label>
                                    <textarea name="contenido" class="form-control" disabled></textarea>
                                    <br><button class="btn btn-primary" disabled>Enviar</button>
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
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
     <script>
        let map = L.map('map').setView([40.463667, -3.74922], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', 
        {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    
        var markerOptions = {
          riseOnHover: true
        }
    
        var marker = L.marker([{{ $piso->longitud }}, {{ $piso->latitud }}], markerOptions).addTo(map);
        
        map.addControl(new L.Control.Fullscreen());
      </script>
@endsection