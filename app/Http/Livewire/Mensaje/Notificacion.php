<?php

namespace App\Http\Livewire\Mensaje;

use Livewire\Component;

class Notificacion extends Component
{
    public $notificacion;

    public function mount()
    {
        $this->notificacion = "";
    }
    
    public function render()
    {
        return view('livewire.mensaje.notificacion');
    }

    public function enviarMensaje()
    {
        $this->emit('mensajeEnviado');
        // $this->notificacion = "Mensaje enviado correctamente.";
    }
}
