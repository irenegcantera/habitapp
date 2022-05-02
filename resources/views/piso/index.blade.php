@extends('nav-foot')

@section('title','Pisos')

@section('content')

<div class="me-4 ms-4 mt-3 mb-2">
    <div class="d-block d-lg-block d-xl-none">
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        Filtrar
      </button>
    </div>
    <div class="row">
      <div class="col-lg-3 card h-100 d-none d-xl-block">
        <div class="card-body">
          <form action="#" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="place" id="place" placeholder="CP, localidad, provincia" aria-describedby="button-addon2">
                <button type="submit" class="btn btn-secondary" type="button" id="button-addon2" value="Search">Buscar</button>
            </div>
          </form>
          <h1>{{ $first['geometry']['lng'] . ';' . $first['geometry']['lat'] }}</h1>
          <h5 class="card-title"><a href="">Primer piso</a></h5>
          <p class="card-text"><small class="text-muted">m2</small></p>
          <p class="card-text"> €/mes</p>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-block">
        <div id="map2"></div>
      </div>
      <div class="col-lg-5">
        <div class="row row-cols-lg-2 row-cols-xl-2 g-4">

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
                  <h5 class="card-title"><a href="{{ route('pisos.show', $piso) }}">{{ $piso->titulo }}</a></h5>
                  <p class="card-text"><small class="text-muted">{{ $piso->num_habitaciones }} habitaciones · {{ $piso->num_aseos }} aseos · {{ $piso->m2 }} m2</small></p>
                  <p class="card-text">{{ $piso->precio }} €/mes</p>
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>

    {{-- Barra lateral filtrado --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Búsqueda de pisos</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="card-body">
          <form action="#" method="get">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="place" id="place" placeholder="CP, localidad, provincia" aria-describedby="button-addon2">
                <button type="submit" class="btn btn-secondary" type="button" id="button-addon2" value="Search">Buscar</button>
            </div>
          </form>
          <h1>{{ $first['geometry']['lng'] . ';' . $first['geometry']['lat'] }}</h1>
          <h5 class="card-title"><a href="">Primer piso</a></h5>
          <p class="card-text"><small class="text-muted">m2</small></p>
          <p class="card-text"> €/mes</p>
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
      var marker = L.marker([{{ $piso->longitud }}, {{ $piso->latitud }}], markerOptions).addTo(map);
    @endforeach
    
    map.addControl(new L.Control.Fullscreen());
  </script>
@endsection