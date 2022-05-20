<?php

namespace App\Http\Livewire\Mensajeria;

use Livewire\Component;

class ChatForm extends Component
{
    public $contenido;

    // constructor
    public function mount()
    {
        $this->contenido = "";
    }
    
    public function render()
    {
        return view('livewire.mensajeria.chat-form');
    }

    public function enviarMensaje(){
        $this->emit("mensajeEnviado");
    }
}
