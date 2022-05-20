<div>
    <div class="form-group">
        <input type="text" class="form-control" id="contenido" placeholder="Say hi!" wire:model="contenido">
        {{-- <small>{{ $contenido }}</small> --}}
        <button class="btn btn-primary" wire:click="enviarMensaje">Enviar</button>
    </div>
</div>

