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
    </div>
    <br>
    <div class="row mt-3">
      <div class="col-lg-2 card white-card h-100 d-none d-xxl-block">
        <div class="card-body filter-card" >
          <form action="{{ route('filter.index') }}" method="post"> 
            @csrf         
            
            <label class="form-label fw-bold" for="order">Ordenar por...</label>
            <select class="form-select mb-3" name="order">
                <option value=null @if(empty($order)) selected @endif> Seleccione...</option>
                <option value="1" @if(isset($filtros['order']) && $filtros['order'] == 1) selected @endif>Relevancia</option>
                <option value="2" @if(isset($filtros['order']) && $filtros['order'] == 2) selected @endif>Precio de menor a mayor</option>
                <option value="3" @if(isset($filtros['order']) && $filtros['order'] == 3) selected @endif>Precio de mayor a menor</option>
            </select>

            {{-- Livewire select dynamic zonas geográficas--}}
            <label class="form-label fw-bold" for="zona">Zona geográfica</label>
            @livewire('busqueda.autosearch')

            <label for="precio" class="form-label fw-bold">Precio</label>
            <p>Mín. <input type="number" class="form-control form-control-sm" name="precioMin" min="1" 
              @if(isset($filtros['precioMin'])) value={{$filtros['precioMin'];}} @endif></p>
            <p>Máx. <input type="number" class="form-control form-control-sm mt-1" name="precioMax" min="1"
               @if(isset($filtros['precioMax'])) value={{$filtros['precioMax'];}} @endif></p>

            <label for="num_habitaciones" class="form-label fw-bold mt-2  me-4">Nº de habitaciones</label>
            <span class="text-primary fw-bold" id="output_habitaciones"></span>
            <input type="range" class="form-range" min="0" max="6" step="1" name="num_habitaciones" id="num_habitaciones" 
            value=@if(isset($filtros['num_habitaciones'])) {{$filtros['num_habitaciones'];}} @else "0" @endif>

            <label for="num_aseos" class="form-label fw-bold me-4">Nº de aseos</label>
            <span class="text-primary fw-bold" id="output_aseos"></span>
            <input type="range" class="form-range" min="0" max="3" step="1" name="num_aseos" id="num_aseos" 
            value=@if(isset($filtros['num_aseos'])) {{$filtros['num_aseos'];}} @else "0" @endif>

            <label for="m2" class="form-label fw-bold mt-3">Superficie m2</label>
            <p>Mín. <input type="number" class="form-control form-control-sm" name="m2Min" min="1" 
              @if(isset($filtros['m2Min'])) value={{$filtros['m2Min'];}} @endif></p>
            <p>Máx. <input type="number" class="form-control form-control-sm mt-1" name="m2Max" min="1" 
              @if(isset($filtros['m2Max'])) value={{$filtros['m2Max'];}} @endif></p>
            
            <label for="fumadores" class="form-label fw-bold">Fumadores</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="fumadores" value="1" 
              @if(isset($filtros['fumadores']) && $filtros['fumadores'] == 1) checked @endif>
              <label class="form-check-label" for="fumadores">Sí</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="fumadores" value="0"
              @if(isset($filtros['fumadores']) && $filtros['fumadores'] == 0) checked @endif>
              <label class="form-check-label" for="fumadores">No</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="fumadores" value="2"
              @if(isset($filtros['fumadores']) && $filtros['fumadores'] == 2) checked @endif>
              <label class="form-check-label" for="fumadores">Todo</label>
            </div>

            <br><label for="animales" class="form-label fw-bold">Animales domésticos</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="animales" value="1"
              @if(isset($filtros['animales']) && $filtros['animales'] == 1) checked @endif>
              <label class="form-check-label" for="animales">Sí</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="animales" value="0"
              @if(isset($filtros['animales']) && $filtros['animales'] == 0) checked @endif>
              <label class="form-check-label" for="animales">No</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="animales" value="2"
              @if(isset($filtros['animales']) && $filtros['animales'] == 2) checked @endif>
              <label class="form-check-label" for="animales">Todo</label>
            </div>
            
            <br><label for="sexo" class="form-label fw-bold">Compañeros de piso</label><br>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="sexo" value="hombre" 
              @if(isset($filtros['sexo']) && $filtros['sexo'] == "hombre") checked @endif>
              <label class="form-check-label" for="sexo">Hombre</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="sexo" value="mujer" 
              @if(isset($filtros['sexo']) && $filtros['sexo'] == "mujer") checked @endif>
              <label class="form-check-label" for="sexo">Mujer</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="sexo" value="mixto" 
              @if(isset($filtros['sexo']) && $filtros['sexo'] == "mixto") checked @endif>
              <label class="form-check-label" for="sexo">Mixto</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">
              <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                <use xlink:href="#bi-search"/>
              </svg>Ver resultados
            </button>
            @if(isset($filtros))
            <a href="{{ route('pisos.index') }}" class="btn btn-primary mt-3">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img">
                <use xlink:href="#bi-x"/>
              </svg>Quitar filtros
            </a>
            @endif
          </form>
        </div>
      </div>
      <div class="col-sm-6 col-md-6 col-lg-5 d-none d-md-block">
        <div id="map2"></div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-5" id="global">

        @if(isset($pisosPagina))
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 g-4">

            @for($i = 0; $i < count($pisosPagina); $i++)
            {{-- @foreach($pisosPagina as $piso) --}}
              <div class="col-md-12 col-lg-12">
                <div class="card h-100">
                  <div id="{{ 'carousel'.$i }}" class="carousel carousel-dark slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="{{ '#carouselIndicators'.$i }}" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="{{ '#carouselIndicators'.$i }}" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="{{ asset('img/pisos/prueba_piso.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="{{ asset('img/pisos/prueba_piso.jpg') }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="{{ '#carouselIndicators'.$i }}" id="{{ 'prev'.$i }}">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="{{ '#carouselIndicators'.$i }}" id="{{ 'next'.$i }}">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title"><a id="titulo-piso-link" href="{{ route('pisos.show', $pisosPagina[$i]) }}">{{ $pisosPagina[$i]->titulo }}</a></h5>
                    <p class="card-text">
                      @if($pisosPagina[$i]->num_habitaciones == 1)
                        {{ $pisosPagina[$i]->num_habitaciones }} habitacion · 
                      @else
                        {{ $pisosPagina[$i]->num_habitaciones }} habitaciones · 
                      @endif
                      @if($pisosPagina[$i]->num_aseos == 1)
                        {{ $pisosPagina[$i]->num_aseos }} aseo 
                      @else
                        {{ $pisosPagina[$i]->num_aseos }} aseos 
                      @endif
                      · {{ $pisosPagina[$i]->m2 }} m2</p>
                    <p class="card-text">
                      <span class="fs-6 fw-light">PRECIO</span><br>
                      {{ $pisosPagina[$i]->precio }} €/mes</p>
                  </div>
                </div>
              </div>
            {{-- @endforeach --}}
            @endfor
        
          </div>
          <div class="d-flex justify-content-center mt-4">
            {{ $pisosPagina->links() }}
          </div>
        @else

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
          @else 
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
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
                No se han encontrado pisos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          @endif
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
            <input type="number" class="form-control form-control-sm" name="precioMin" max="1000">
            <input type="number" class="form-control form-control-sm mt-2" name="precioMax" max="1000">

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
    var output_aseos = document.getElementById("output_aseos");
    var output_habitaciones = document.getElementById("output_habitaciones");

    output_aseos.innerHTML = aseos.value; // Display the default slider value
    output_habitaciones.innerHTML = habitaciones.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    aseos.oninput = function() {
      output_aseos.innerHTML = this.value;
    }

    habitaciones.oninput = function() {
      output_habitaciones.innerHTML = this.value;
    }
  </script>
  <script>
    
    @if(isset($pisosPagina) )
      @for($i = 0; $i < count($pisosPagina); $i++)
        // Cycles to the previous item
        $('{{ '#prev'.$i }}').click(function(){
          $('{{ '#carousel'.$i }}').carousel("prev");
        });
      
        // Cycles to the next item
        $('{{ '#next'.$i }}').click(function(){
          $('{{ '#carousel'.$i }}').carousel("next");
        });
      @endfor
    @endif
  </script>
  <script>

  </script>
@endsection

<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-x">
  <symbol id="bi-x" fill="currentColor" viewBox="0 0 16 16">
    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
  </symbol>
</svg>