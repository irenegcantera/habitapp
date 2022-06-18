<?php

namespace App\Http\Livewire\Busqueda;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Autosearch extends Component
{
    public $selectedComunidad = null;
    public $selectedProvincia = null;
    public $selectedMunicipio = null;

    public $comunidades = null;
    public $provincias = null;
    public $municipios = null;

    public $nombreComunidad = null;
    public $nombreProvincia = null;
    public $nombreMunicipio = null;

    public function mount()
    {
        $this->comunidades = Http::get(env('GEO_API_URL')."comunidades?",[
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        $this->provincias = collect();
        $this->municipios = collect();
    }

    public function updatedSelectedComunidad($CCOM)
    {
        $this->provincias = Http::get(env('GEO_API_URL')."provincias?",[
            "CCOM" => $CCOM,
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];
    }

    public function updatedSelectedProvincia($CPRO)
    {
        $this->municipios = Http::get(env('GEO_API_URL')."municipios?",[
            "CPRO" => $CPRO,
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];
    }

    public function render()
    {
        return view('livewire.busqueda.zonaSelect');
    }
    
}
