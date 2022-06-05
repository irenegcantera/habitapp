@extends('nav-foot')

@section('title','Pisos')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/cards.css') }}"/>
@endsection

@section('content')

<div class="me-4 ms-4 mt-3 mb-2">
    
    <div class="row d-flex justify-content-between align-items-center">
      <div class="col-2 d-block d-xxl-none">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
          Filtrar
        </button>
      </div>
      <div class="col-8 d-none d-xxl-block">

      </div>
      <div class="col-2 d-flex justify-content-end">Ordenar por</div>
      <div class="col-2">
        <select class="form-select" aria-label="Default select example">
          <option selected>Relevancia</a></option>
          <option value="1">Precio de menor a mayor</option>
          <option value="2">Precio de mayor a menor</option>
        </select>
    {{-- @if(!empty($filtros))
        @foreach($filtros as $filtro => $value)
          @foreach($value as $f =>$v)
            <div class="col-2">
              <div class="border border-info rounded-pill p-2 text-center bg-light">{{ $f }}: {{ $v }}</div>
            </div>
          @endforeach
        @endforeach
    @endif --}}
  </div>
    <br>
    <div class="row mt-3">
      <div class="col-lg-2 card white-card h-100 d-none d-xxl-block">
        <div class="card-body filter-card" >
          {{-- <form action="{{ route('filter.ciudad') }}" method="get">       --}}
            <input type="hidden" name="ciudad" value=""> 
            @livewire('busqueda.autosearch')   
            <label for="precio" class="form-label fw-bold">Precio</label>
            <input type="number" class="form-control form-control-sm" name="precioMin" min="150" max="999">
            <input type="number" class="form-control form-control-sm mt-2" name="precioMax" min="151" max="1000">

            <label for="num_habitaciones" class="form-label fw-bold mt-2">Nº de habitaciones</label>
            <input type="range" class="form-range" data-popup-enabled="true" data-show-value="true" min="0" max="6" step="1" name="num_habitaciones" id="num_habitaciones" value="0">
            <span id="output"></span>
  
            <label for="num_aseos" class="form-label fw-bold">Nº de aseos</label>
            <input type="range" class="form-range" data-popup-enabled="true" data-show-value="true" min="0" max="3" step="1" name="num_aseos" id="num_aseos" value="0">
            <span id="output"></span>

            <label for="fumadores" class="form-label fw-bold">Fumadores</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="fumadores" value="1">
              <label class="form-check-label" for="fumadores">Sí</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="fumadores" value="0">
              <label class="form-check-label" for="fumadores">No</label>
            </div>

            <br><label for="animales" class="form-label fw-bold">Animales domésticos</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="animales" value="1">
              <label class="form-check-label" for="animales">Sí</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="animales" value="0">
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
      <div class="col-sm-6 col-md-6 col-lg-5 d-none d-md-block">
        <div id="map2"></div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-5" id="global">
          @if(!empty($pisos))
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 g-4">
              @foreach($pisos as $piso)
                <div class="col">
                  <div class="card h-100">
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade carousel-dark">
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
                      <h5 class="card-title"><a id="titulo-piso-link" href="{{ route('pisos.show', $piso) }}"> {{ $piso->titulo }}</a></h5> 
                      <p class="card-text">
                        @if($piso->num_habitaciones == 1)
                          {{ $piso->num_habitaciones }} habitacion · 
                        @else
                          {{ $piso->num_habitaciones }} habitaciones · 
                        @endif
                        @if($piso->num_aseos == 1)
                          {{ $piso->num_aseos }} aseo 
                        @else
                          {{ $piso->num_aseos }} aseos 
                        @endif
                        · {{ $piso->m2 }} m2</p>
                      <p class="card-text">
                        <span class="fs-6 fw-light">PRECIO</span><br>
                        {{ $piso->precio }} €/mes</p>
                    </div>
                  </div>
                </div>
              @endforeach
            
            </div>
          @elseif(isset($informacion))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" id="aviso">
              <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img" aria-label="Danger:">
                {{-- ICONO EXCLAMACIÓN --}}
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </symbol>
                </svg>
                <use xlink:href="#exclamation-triangle-fill"/>
              </svg>
              <div>
                {{ $informacion }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          @endif
          {{-- <div class="d-flex justify-content-center mt-4">
            {{ $pisos->links() }}
          </div> --}}
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
            @livewire('busqueda.autosearch')      
            <label for="precio" class="form-label fw-bold">Precio</label>
            <input type="number" class="form-control form-control-sm" name="precioMin" min="150" max="999">
            <input type="number" class="form-control form-control-sm mt-2" name="precioMax" min="151" max="1000">

            <label for="num_habitaciones" class="form-label fw-bold mt-2">Número de habitaciones</label>
            <input type="range" class="form-range" min="0" max="6" step="1" name="num_habitaciones">
            <p id="output1"></p>

            <label for="num_aseos" class="form-label fw-bold">Número de aseos</label>
            <input type="range" class="form-range" min="0" max="3" step="1" name="num_aseos" id="num_aseos">

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

    @if(!empty($pisos))
      @foreach($pisos as $piso)
        @if($loop)
          var marker = L.marker([{{ $piso->longitud }}, {{ $piso->latitud }}], markerOptions).addTo(map);
        @endif
      @endforeach
    @endif
    
    map.addControl(new L.Control.Fullscreen());
  </script>
  <script>
    var aseos = document.getElementById("num_aseos");
    var habitaciones = document.getElementById("num_habitaciones");
    var output = document.getElementById("output");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    aseos.oninput = function() {
      output.innerHTML = this.value;
    }

    habitaciones.oninput = function() {
      output.innerHTML = this.value;
    }
  </script>
@endsection

<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-x">
  <symbol id="bi-x" fill="currentColor" viewBox="0 0 16 16">
    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
  </symbol>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>