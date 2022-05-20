<?php

namespace App\Http\Livewire\Busqueda;

// use App\Models\Comunidad;
// use App\Models\Municipio;
// use App\Models\Provincia;
use App\Http\Controllers\GeoApiController;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use OpenCage\Geocoder\Geocoder;

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

        $this->selectedProvincia = $this->provincias[0]['CPRO'] ?? null;
    }

    public function updatedSelectedProvincia($CPRO)
    {
        $this->municipios = Http::get(env('GEO_API_URL')."municipios?",[
            "CPRO" => $CPRO,
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        $this->selectedMunicipio = $this->municipios[0]['CMUM'] ?? null;
    }

    public function render()
    {
        return view('livewire.busqueda.zonaSelect');
    }

    public function search()
    {
        $geoApi = new GeoApiController();

        $this->nombreComunidad = $geoApi->getNombreComunidad($this->selectedComunidad);
        $this->nombreProvincia = $geoApi->getNombreProvincia($this->selectedComunidad, $this->selectedProvincia);
        $this->nombreMunicipio = $geoApi->getNombreMunicipio($this->selectedProvincia, $this->selectedMunicipio);

        $geocoder = new Geocoder('469ef009f74d4177a741647ec1b41a1f');
        $result = $geocoder->geocode($this->nombreComunidad);

        if ($result && $result['total_results'] > 0) {
            $coordenadas = $result['results'][0];
            //print $coordenadas['geometry']['lng'] . ';' . $coordenadas['geometry']['lat'] . ';' . $first['formatted'] . "\n";
            # 4.360081;43.8316276;6 Rue Massillon, 30020 Nîmes, Frankreich
        }
        
        return view('index');
    }
    
}
