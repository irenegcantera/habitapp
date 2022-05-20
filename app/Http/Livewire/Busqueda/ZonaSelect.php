<?php

namespace App\Http\Livewire\Busqueda;

use App\Models\Comunidad;
use App\Models\Municipio;
use App\Models\Provincia;

use Livewire\Component;

class ZonaSelect extends Component
{
    public $selectedComunidad = null;
    public $selectedProvincia = null;
    public $selectedMunicipio = null;

    public $provincias = null;
    public $municipios = null;

    // public function mount()
    // {
    //     $this->comunidades = Comunidad::all();
    // }

    public function render()
    {
        return view('livewire.busqueda.zonaSelect',[
            'comunidades' => Comunidad::all()
        ]);
    }

    public function updatedSelectedComunidad($comunidadid)
    {
        $this->provincias = Provincia::where('comunidadid', $comunidadid)->get();
    }

    public function updatedSelectedProvincia($provinciasid)
    {
        if(!is_null($provinciasid)){
            $this->municipios = Municipio::select('poblacio')->where('provinciasid', $provinciasid)->groupBy('poblacio')->get();
        }
    }

    // public function updatedSelectedMunicipio($provinciasid)
    // {
    //     $this->municipios = Municipio::select('poblacio')->where('provinciasid', $provinciasid)->groupBy('poblacio')->get();
    // }
}
