@extends('nav-foot')

@section('title','HabitApp - Formulario contacto')

@section('content')

<div class="container mt-5">
    <h3>Formulario de consulta</h3>
    <h5 class="mt-4">Consúltanos y te contestaremos en la menor brevedad posible.</h5>
    <form class="mt-4">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono (opcional)</label>
                    <input type="text" class="form-control" name="telefono" id="telefono">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="consulta">Consulta</label>
                    <textarea class="form-control" name="consulta" id="consulta" cols="30" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar consulta</button>
            </div>
            <div class="col text-justify">
                <p class="fs-6">Información básica en protección de datos.- Conforme al RGPD y la LOPDGDD, <span class="fw-bold">HabitApp, S.L.</span> tratará 
                    los datos facilitados, con la finalidad de contestar las dudas y/o quejas planteadas a través del presente formulario y facilitar la 
                    información solicitada. Siempre que nos lo autorice previamente, enviaremos información relacionada con 
                    [la actividad/ los productos/ los servicios] ofrecidos por <span class="fw-bold">HabitApp, S.L.</span>.  Podrá ejercer, si lo desea, 
                    los derechos de acceso, rectificación, supresión, y demás reconocidos en la normativa mencionada. Para obtener más información acerca 
                    de cómo estamos tratando sus datos, acceda a nuestra política de privacidad.</p>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="acepto1" required>
                    <h6>ENTIENDO Y ACEPTO</h6> 
                </div>
                <p>El tratamiento de mis datos tal y como se describe anteriormente y se explica con mayor detalle en la 
                    <a href="{{ route('legal.privacidad') }}">Política de Privacidad</a>. 
                    (Su negativa a facilitarnos la autorización implicará la imposibilidad de tratar sus datos con la finalidad indicada).</p>
                    
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="acepto2" required>
                    <h6>ENTIENDO Y ACEPTO</h6> 
                </div>
                <p>Recibir información en los términos arriba indicados sobre la [actividad/productos/servicios] de <span class="fw-bold">HabitApp, S.L.</span>. 
                    (Su negativa a facilitarnos la autorización implicará la imposibilidad de enviarle información comercial por parte de la entidad).</p>
            </div>
    </div>
</form>
</div>


@endsection