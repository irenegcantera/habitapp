<?php

namespace App\Http\Livewire;

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
        return view('livewire.chat-form');
    }
}
