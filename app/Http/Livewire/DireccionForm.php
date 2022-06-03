<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Busqueda\Autosearch;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DireccionForm extends Component
{
    public $selectedComunidad = null;
    public $selectedProvincia = null;
    public $selectedMunicipio = null;
    public $selectedPoblacion = null;
    public $selectedNucleo = null;
    public $selectedCodPostal = null;
    public $selectedCalle = null;

    public $comunidades = null;
    public $provincias = null;
    public $municipios = null;
    public $poblaciones = null;
    public $nucleos = null;
    public $codPostales;
    public $calles;

    public function mount()
    {
        $this->comunidades = Http::get(env('GEO_API_URL')."comunidades?",[
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        $this->provincias = collect();
        $this->municipios = collect();
        $this->poblaciones = collect();
        $this->nucleos = collect();
        $this->codPostales = collect();
        $this->calles = collect();
    }

    public function render()
    {
        return view('livewire.direccion-form');
    }

    public function updatedSelectedComunidad($CCOM)
    {
        $this->provincias = Http::get(env('GEO_API_URL')."provincias?",[
            "CCOM" => $CCOM,
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        // $this->selectedProvincia = $this->provincias[0]['CPRO'] ?? null;
    }

    public function updatedSelectedProvincia($CPRO)
    {
        $this->municipios = Http::get(env('GEO_API_URL')."municipios?",[
            "CPRO" => $CPRO,
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        // $this->selectedMunicipio = $this->municipios[0]['CMUM'] ?? null;
    }

    public function updatedSelectedMunicipio($CMUM)
    {
        $this->poblaciones = Http::get(env('GEO_API_URL')."poblaciones?",[
            "CPRO" => $this->selectedProvincia,
            "CMUM" => $CMUM,
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        // dump($this->poblaciones);

        // $this->selectedPoblacion = $this->poblaciones[0]['NENTSI50'] ?? null;
    }

    public function updatedSelectedPoblacion($NENTSI50)
    {
        $this->nucleos = Http::get(env('GEO_API_URL')."nucleos?",[
            "CPRO" => $this->selectedProvincia,
            "CMUM" => $this->selectedPoblacion,
            "NENTSI50" => rawurlencode(utf8_encode($NENTSI50)),
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        // dump($this->nucleos);

        // $this->selectedNucleo = $this->nucleos[0]['CUN'] ?? null;
    }

    public function updatedSelectedNucleo($CUN)
    {
        $this->codPostales = Http::get(env('GEO_API_URL')."cps?",[
            "CPRO" => $this->selectedProvincia,
            "CMUM" => $this->selectedPoblacion,
            "CUN" => $CUN,
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        // dump($this->codPostales);

        // $this->selectedCodPostal = $this->codPostales[0]['CPOS'] ?? null;
    }

    public function updatedSelectedCodPostal($CPOS)
    {
        $this->calles = Http::get(env('GEO_API_URL')."calles?",[
            "CPRO" => $this->selectedProvincia,
            "CMUM" => $this->selectedPoblacion,
            "CUN" => $this->selectedNucleo,
            "CPOS" => $CPOS,
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        // dump($this->calles);

        // $this->selectedCalle = $this->calles[0]['CUN'] ?? null;
    }

}
