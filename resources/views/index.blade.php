@extends('nav-foot')

@section('title','PISOSAPP')

@section('content')
<section class="d-flex justify-content-center align-items-center search">
    <div class="container w-75">
        <div class="card">
            <div class="card-body">
              <form action="{{ route('pisos.index') }}" method="get">
                <h5 class="card-title">Buscador de pisos</h5>
                @livewire('busqueda.autosearch')
                <button type="submit" class="btn btn-primary">Buscar</button>
              </form>
          </div>
    </div>
</section>

<section id="bg-white" class="container m-5 p-5 h-75">
    <h3>¿Quieres publicar tu piso o buscar tu próximo alquiler?</h3>
    <a class="btn btn-lg btn-primary" href="{{ route('registrar') }}">¡Registrate ahora!</a>
</section>

<section id="bg-white" class="container m-5 p-5 h-75">
    <div class="row d-flex justify-content-end">
      <h3>Administra tus pisos y contacta con tus inquilinos.</h3><br>
    </div>
    <a class="btn btn-lg btn-primary" href="{{ route('login') }}">¡Inicia sesión!</a>
</section>

<section id="bg-white" class="container m-5 p-5 h-75">
    <h3>Busca tu próximo piso y contacta con el propietario de forma rápida y sencilla.</h3>
    <a class="btn btn-lg btn-primary" href="{{ route('login') }}">¡Inicia sesión!</a>
</section>

<section>
    <div class="container mb-3">
        <h3>Enlaces a ciudades más buscadas</h3>
        <br>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <div class="card">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                  <a href="{{ route('pisos.searched','Barcelona') }}">Barcelona</a>
                  {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    <a href="{{ route('pisos.searched','Madrid') }}">Madrid</a>
                  {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    <a href="{{ route('pisos.searched','Valencia') }}">Valencia</a>
                  {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p> --}}
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    <a href="{{ route('pisos.searched','Bilbao') }}">Bilbao</a>
                  {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                </div>
              </div>
            </div>
            <div class="col">
                <div class="card">
                  {{-- <img src="..." class="card-img-top" alt="..."> --}}
                  <div class="card-body">
                    <a href="{{ route('pisos.searched','Sevilla') }}">Sevilla</a>
                    {{-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
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