@extends('nav-foot')

@section('title','Pisos')

@section('content')
{{-- <h1>{{ $first['geometry']['lat'] . ';' . $first['geometry']['lng']  }}</h1> --}}
<div class="me-4 ms-4 mt-3 mb-2">
    <div class="d-block d-lg-block d-xxl-none">
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        Filtrar
      </button>
      <button class="btn btn-primary ms-3" type="button">
        Ver mapa
      </button>
    </div>
    <br>
    <div class="row">
      <div class="col-lg-2 card h-100 d-none d-xxl-block">
        <div class="card-body filter-card" >
          <form action="{{ route('filter.index') }}" method="get">          
            {{-- Livewire select dynamic zonas geográficas--}}
            @livewire('busqueda.autosearch')
            {{-- <h1>{{ $first['geometry']['lng'] . ';' . $first['geometry']['lat'] }}</h1> --}}
            <label for="precio" class="form-label fw-bold">Precio</label>
            <input type="number" class="form-control form-control-sm" name="precioMin" min="150" max="999">
            <input type="number" class="form-control form-control-sm mt-2" name="precioMax" min="151" max="1000">

            <label for="num_habitaciones" class="form-label fw-bold mt-2">Número de habitaciones</label>
            <input type="range" class="form-range" min="0" max="6" step="1" name="num_habitaciones" value="0">

            <label for="num_aseos" class="form-label fw-bold">Número de aseos</label>
            <input type="range" class="form-range" min="0" max="3" step="1" name="num_aseos" value="0">

            <label for="fumadores" class="form-label fw-bold">Fumadores</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="fumadores" value="1">
              <label class="form-check-label" for="fumadores">Sí</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="fumadores" value="0">
              <label class="form-check-label" for="fumadores">No</label>
            </div>

            <br><label for="animales" class="form-label fw-bold">Animales domésticos</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="animales" value="1">
              <label class="form-check-label" for="animales">Sí</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="animales" value="0">
              <label class="form-check-label" for="animales">No</label>
            </div>

            <br><label for="sexo" class="form-label fw-bold">Compañeros de piso</label><br>
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
            <br><button type="submit" class="btn btn-primary">
              <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                <use xlink:href="#bi-search"/>
              </svg>Ver resultados</button>
            <br><a href="{{ route('pisos.index') }}" class="btn btn-primary mt-3">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img">
                <use xlink:href="#bi-x"/>
              </svg>Quitar filtros
            </a>
          </form>
        </div>
      </div>
      <div class="col-lg-5 d-none d-xxl-block">
        <div id="map2"></div>
      </div>
      <div class="col-lg-5" id="global">

        @if(isset($pisosPagina))
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 g-4">

            @foreach($pisosPagina as $piso)
              <div class="col">
                <div class="card h-100">
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
                    <h5 class="card-title"><a id="titulo-piso-link" href="{{ route('pisos.show', $piso) }}">{{ $piso->titulo }}</a></h5>
                    <p class="card-text"><small class="text-muted">{{ $piso->num_habitaciones }} habitaciones · {{ $piso->num_aseos }} aseos · {{ $piso->m2 }} m2</small></p>
                    <p class="card-text">{{ $piso->precio }} €/mes</p>
                  </div>
                </div>
              </div>
            @endforeach
        
          </div>
          <div class="d-flex justify-content-center mt-4">
            {{ $pisosPagina->links() }}
          </div>
        @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 g-4">

            @foreach($pisos as $piso)
              <div class="col">
                <div class="card h-100">
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
                    <h5 class="card-title"><a href="{{ route('pisos.show', $piso) }}"> {{ $piso->titulo }}</a></h5> 
                    <p class="card-text"><small class="text-muted">{{ $piso->num_habitaciones }} habitaciones · {{ $piso->num_aseos }} aseos · {{ $piso->m2 }} m2</small></p>
                    <p class="card-text">{{ $piso->precio }} €/mes</p>
                  </div>
                </div>
              </div>
            @endforeach
            
          </div>
          {{-- <div class="d-flex justify-content-center mt-4">
            {{ $pisos->links() }}
          </div> --}}
        @endif
      </div>
    </div>

    {{-- Barra lateral filtrado responsive --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Búsqueda de pisos</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="card-body">
          <form action="{{ route('filter.index') }}" method="get">          
            {{-- Livewire select dynamic zonas geográficas--}}
            @livewire('busqueda.autosearch')
            {{-- <h1>{{ $first['geometry']['lng'] . ';' . $first['geometry']['lat'] }}</h1> --}}
            <label for="precio" class="form-label fw-bold">Precio</label>
            <input type="number" class="form-control form-control-sm" name="precioMin" min="150" max="999">
            <input type="number" class="form-control form-control-sm mt-2" name="precioMax" min="151" max="1000">

            <label for="num_habitaciones" class="form-label fw-bold mt-2">Número de habitaciones</label>
            <input type="range" class="form-range" min="0" max="6" step="1" name="num_habitaciones">

            <label for="num_aseos" class="form-label fw-bold">Número de aseos</label>
            <input type="range" class="form-range" min="0" max="3" step="1" name="num_aseos">

            <label for="fumadores" class="form-label fw-bold">Fumadores</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="fumadores" value="1">
              <label class="form-check-label" for="fumadores">Sí</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="fumadores" value="0">
              <label class="form-check-label" for="fumadores">No</label>
            </div>

            <br><label for="animales" class="form-label fw-bold">Animales domésticos</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="animales" value="1">
              <label class="form-check-label" for="animales">Sí</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="animales" value="0">
              <label class="form-check-label" for="animales">No</label>
            </div>

            <br><label for="sexo" class="form-label fw-bold">Compañeros de piso</label><br>
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
            <br><button type="submit" class="btn btn-primary">
              <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                <use xlink:href="#bi-search"/>
              </svg>Ver resultados</button>
            <br><a href="{{ route('pisos.index') }}" class="btn btn-primary mt-3">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img">
                <use xlink:href="#bi-x"/>
              </svg>Quitar filtros
            </a>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script>
    let map = L.map('map2').setView([40.463667, -3.74922], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', 
    {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var markerOptions = {
      riseOnHover: true
    }

    @foreach($pisos as $piso)
      @if($loop)
        var marker = L.marker([{{ $piso->longitud }}, {{ $piso->latitud }}], markerOptions).addTo(map);
      @endif
    @endforeach
    
    map.addControl(new L.Control.Fullscreen());
  </script>
@endsection

<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-x">
  <symbol id="bi-x" fill="currentColor" viewBox="0 0 16 16">
    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
  </symbol>
</svg>