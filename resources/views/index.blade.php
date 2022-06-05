@extends('nav-foot')

@section('title','PISOSAPP')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/cards.css') }}"/>
@endsection

@section('content')
<section class="d-flex justify-content-center align-items-center img-search">
  <div id="buscador-sm">
      <div class="white-card" id="card-shadow">
          <div class="card-body m-4">
            <form action="{{ route('filter.search') }}" method="get">
              @if(isset($informacion))
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
              <h5 class="card-title mt-2 mb-3">Buscador de pisos</h5>
              @livewire('busqueda.autosearch')
              <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-primary mb-2" id="buscar">
                  <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img">
                    <use xlink:href="#bi-search"/>
                  </svg>Buscar
                </button>
              </div>
              
            </form>
          </div>
      </div>
    </div>
</section>

<section>
  <div id="bg-white" class="container mt-5 mb-5 p-5 h-75">
    <h3>¿Quieres publicar tu piso o buscar tu próximo alquiler?</h3><br>
    @if (!auth()->check())
      <a class="btn btn-lg btn-primary" id="inicio-registro-btn" href="{{ route('registrar') }}">¡Registrate ahora!</a>
    @endif
  </div>
</section>

<section class="mb-4">
  <div class="row ms-5 me-5 d-flex justify-content-center ">
    <div class="col-12 col-xl-5">
      <div id="bg-white" class="mt-5 mb-5 p-5 h-75 rounded piso-card">
        <h3>Administra tus pisos y <br> contacta con tus inquilinos.</h3><br>
        @if (!auth()->check())
          <a class="btn btn-lg btn-primary" id="inicio-registro-btn" href="{{ route('login') }}">¡Inicia sesión!</a>
        @endif
      </div>
    </div>
    <div class="col-12 col-xl-5">
      <div id="bg-white" class="mt-5 mb-5 p-5 h-75 rounded room-card">
        <h3>Busca tu próximo piso y contacta con el propietario de forma rápida y sencilla.</h3><br>
        @if (!auth()->check())
          <a class="btn btn-lg btn-primary" id="inicio-registro-btn" href="{{ route('login') }}">¡Inicia sesión!</a>
        @endif
      </div>
    </div>
  </div>
</section>
<br>
<section>
    <div class="container mt-3 mb-3">
        <h3>Enlaces a ciudades más buscadas</h3>
        <br>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
              <a id="link-style" href="{{ route('filter.searched','barcelona') }}">
                <div class="cards" id="card-shadow">
                  <img src="{{ asset('img/barcelona.jpg') }}" class="card-img-cover" alt="...">
                  <div class="card-body">
                    <p class="text-center fw-light fs-4">Barcelona</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col">
              <a id="link-style" href="{{ route('filter.searched','madrid') }}">
                <div class="cards" id="card-shadow">
                  <img src="{{ asset('img/madrid.jpg') }}" class="card-img-cover" alt="...">
                  <div class="card-body">
                    <p class="text-center fw-light fs-4">Madrid</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col">
              <a id="link-style" href="{{ route('filter.searched','Valencia') }}">
                <div class="cards" id="card-shadow">
                  <img src="{{ asset('img/valencia.jpg') }}" class="card-img-cover" alt="...">
                  <div class="card-body">
                    <p class="text-center fw-light fs-4">Valencia</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col">
              <a id="link-style" href="{{ route('filter.searched','Bilbao') }}">
                <div class="cards" id="card-shadow">
                  <img src="{{ asset('img/bilbao.jpg') }}" class="card-img-cover" alt="...">
                  <div class="card-body">
                    <p class="text-center fw-light fs-4">Bilbao</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col">
              <a id="link-style" href="{{ route('filter.searched','Sevilla') }}">
                <div class="cards" id="card-shadow">
                  <img src="{{ asset('img/sevilla.jpg') }}" class="card-img-cover" alt="...">
                  <div class="card-body">
                    <p class="text-center fw-light fs-4">Sevilla</p>
                  </div>
                </div>
              </a>
            </div>
        </div>
    </div>
</section>

@endsection