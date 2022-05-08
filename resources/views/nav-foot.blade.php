<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximumscale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title')</title>
  {{-- Boostrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
  {{-- JQuery --}}
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/jquery-ui-1.13.1/jquery-ui.min.css') }}"/>
  {{-- Propia hoja de estilos --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"/>
  {{-- Leaflet --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
  <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
  {{-- Livewire --}}
  @livewireStyles
  @livewireScripts
</head>

<body class="d-flex flex-column h-100 bg-light">
  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('index') }}">
        <img src="{{ asset('logo/logo.png') }}" alt="" width="30" height="24" class="d-inline-block align-text-top">PISOS APP
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link btn btn-outline-light" href="{{ route('pisos.index') }}">Localizar pisos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-light" href="">Más información</a>
          </li>
          @if (auth()->check())
            <div class="row">
              <div class="col">
                <span class="navbar-text">
                  Bienvenido/a, <span class="fw-bold">{{ auth()->user()->username }}</span>
              </span>
              </div>
            </div>
          @endif
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('logo/perfil.png') }}" alt="" width="40">
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              @if (auth()->check())
                <li><a class="dropdown-item" href="{{ route('perfil.index') }}">Ver perfil</a></li>
                <li><a class="dropdown-item" href="{{ route('mensajes.index') }}">Mensajes</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('login.destroy') }}">Cerrar sesión</a></li>
              @else
                <li><a class="dropdown-item" href="{{ route('login') }}">Iniciar sesión</a></li>
                <li><a class="dropdown-item" href="{{ route('registrar') }}">Registrar</a></li>
              @endif
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <footer class="footer mt-auto py-3 bg-white border-top">

    <div class="container">
      <div class="row">
        <div class="col-sm">
          <h5>Sobre PISOS APP</h5>
        </div>
        <div class="col-sm">
          <h5>Contacto</h5>
        </div>
        <div class="col-sm">
          <div class="row">
            Iconos redes sociales
          </div>
          <div class="row">
            Iconos descarga app móvil
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
              <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
          </a>
          <span class="text-muted">&copy; 2021 Company, Inc</span>
      </div>
      </div>
    </div>
  </footer>

  @yield('scripts')

  {{-- Livewire --}}
  @livewireScripts
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>
