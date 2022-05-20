@extends('nav-foot')

@section('title','PISOSAPP')

@section('content')
<section class="d-flex justify-content-center align-items-center search">
  <div class="container w-50">
      <div class="card" id="card-shadow">
          <div class="card-body">
            <form action="{{ route('filter.search') }}" method="get">
              <h5 class="card-title">Buscador de pisos</h5>
              @livewire('busqueda.autosearch')
              <button type="submit" class="btn btn-primary">
                <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                  <use xlink:href="#bi-search"/>
                </svg>Buscar</button>
            </form>
          </div>
      </div>
    </div>
</section>

<section>
  <div id="bg-white" class="container mt-5 mb-5 p-5 h-75">
    <h3>¿Quieres publicar tu piso o buscar tu próximo alquiler?</h3><br>
    <a class="btn btn-lg btn-primary" id="inicio-registro-btn" href="{{ route('registrar') }}">¡Registrate ahora!</a>
  </div>
</section>

<section class="mb-4">
  <div class="row ms-5 me-5 d-flex justify-content-center ">
    <div class="col-12 col-xl-5">
      <div id="bg-white" class="mt-5 mb-5 p-5 h-75 rounded piso-card">
        <h3>Administra tus pisos y <br> contacta con tus inquilinos.</h3><br>
        <a class="btn btn-lg btn-primary" id="inicio-registro-btn" href="{{ route('login') }}">¡Inicia sesión!</a>
      </div>
    </div>
    <div class="col-12 col-xl-5">
      <div id="bg-white" class="mt-5 mb-5 p-5 h-75 rounded room-card">
        <h3>Busca tu próximo piso y contacta con el propietario de forma rápida y sencilla.</h3><br>
        <a class="btn btn-lg btn-primary" id="inicio-registro-btn" href="{{ route('login') }}">¡Inicia sesión!</a>
      </div>
    </div>
  </div>
</section>
<br>
<section>
    <div class="container mt-3 mb-3">
        <h3>Enlaces a ciudades más buscadas</h3>
        <br>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <div class="card" id="card-shadow">
                <img src="{{ asset('img/barcelona.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <p class="text-center fw-light fs-4"><a id="ciudad-link" href="{{ route('filter.searched','barcelona') }}">Barcelona</a></p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card" id="card-shadow">
                <img src="{{ asset('img/madrid.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <p class="text-center fw-light fs-4"><a id="ciudad-link" href="{{ route('filter.searched','madrid') }}">Madrid</a></p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card" id="card-shadow">
                <img src="{{ asset('img/valencia.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <p class="text-center fw-light fs-4"><a id="ciudad-link" href="{{ route('filter.searched','Valencia') }}">Valencia</a></p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card" id="card-shadow">
                <img src="{{ asset('img/bilbao.jpg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                  <p class="text-center fw-light fs-4"><a id="no-style" href="{{ route('filter.searched','Bilbao') }}">Bilbao</a></p>
                </div>
              </div>
            </div>
            <div class="col">
                <div class="card" id="card-shadow">
                  <img src="{{ asset('img/sevilla.jpg') }}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="text-center fw-light fs-4"><a id="no-style" href="{{ route('filter.searched','Sevilla') }}">Sevilla</a></p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
    <script>
        let map = L.map('map').setView([40.463667, -3.74922], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        map.addControl(new L.Control.Fullscreen());
    </script>
@endsection