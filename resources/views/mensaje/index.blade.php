@extends('nav-foot')

@section('title','Pisos App - Mensajes')

@section('content')
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col">
            @foreach($informacion as $info)
                <div class="card" style="max-width: 380px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('logo/perfil.png') }}" class="img-fluid rounded-start" alt="..." width="100">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-title">{{ $info['to_user'] }}</p>
                                <p class="card-text">{{ $info['contenido'] }}</p>
                                <p class="card-text"><small class="text-muted">{{ $info['fecha_recibido'] }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="row">

                </div>
                <div class="row">
                    {{-- @livewire('mensajeria.chat-form') --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 

