
<div>
    <br>
    <button class="btn btn-primary" wire:click="enviarMensaje">Enviar</button>
    <!-- Mensaje de notificacion -->
    <div class="alert alert-success collapse mt-3" role="alert" id="avisoSuccess">
        {{-- <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg> --}}
        Mensaje enviado correctamente.
    </div>
</div>

<script>
    // Esto lo recibimos en JS cuando lo emite el componente
    // El evento "mensajeEnviado"
    window.livewire.on('mensajeEnviado', function(){
        // Mostramos el aviso
        $("#avisoSuccess").fadeIn("slow");
        // Ocultamos el aviso a los 8 segundos
        setTimeout (function(){ $("#avisoSuccess").fadeOut ("slow"); }, 8000);
    });
</script>

{{-- <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
</svg> --}}