@extends('nav-foot')

@section('title','PISOSAPP')

@section('content')
<section class="d-flex justify-content-center align-items-center search">
    <h2 class="text-white">Busca tu próximo piso</h2><br><br>
    <form action="#" method="get">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="place" id="place" placeholder="CP, localidad, provincia" aria-describedby="button-addon2">
            <button type="submit" class="btn btn-secondary" type="button" id="button-addon2" value="Search">Button</button>
        </div>
    </form>
</section>

<section class = "container">
    <h3>INFORMACIÓN WEB</h3>
</section>

<section class = "container">
    <h3>INFORMACIÓN ARRENDATARIOS</h3>
</section>

<section class = "container">
    <h3>INFORMACIÓN INQUILINOS</h3>
</section>

<section>
    <div class="container">
        <h3>Enlaces a ciudades más buscadas</h3>
        <ul>
            <li>Barcelona</li>
            <li>Madrid</li>
            <li>Valencia</li>
            <li>Bilbao</li>
            <li>Sevilla</li>
        </ul>
    </div>
</section>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/jquery-ui-1.13.1/jquery-ui.min.js') }}"></script>
    <script>
        $('#place').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('search.places') }}"",
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data){
                        response(data);
                    }
                });
            }
        });
    </script>
    <script>
        let map = L.map('map').setView([40.463667, -3.74922], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        map.addControl(new L.Control.Fullscreen());
    </script>
@endsection