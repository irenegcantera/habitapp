<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;
use OpenCage\Geocoder\Geocoder;

class GeocoderApiController extends Controller
{

    /**
     * Get geographical coordinates from an object.
     *
     * @param  App\Models\Direccion $direccion
     * @return Array $coordenadas
     */
    public static function getCoordenadas(Direccion $direccion) 
    {
        $geocoder = new Geocoder(env('GEOCODER_API_KEY'));
        
        $query = $direccion->toString();

        $resultado = $geocoder->geocode($query);

        if ($resultado && $resultado['total_results'] > 0) {
            $coordenadas = $resultado['results'][0];
            //print $coordenadas['geometry']['lng'] . ';' . $coordenadas['geometry']['lat'] . ';' . $resultado['formatted'] . "\n";
            # 4.360081;43.8316276;6 Rue Massillon, 30020 Nîmes, Frankreich
            return $coordenadas;
        }

        return null;
        
    }
}
