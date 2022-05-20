<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use OpenCage\Geocoder\Geocoder;

// use OpenCage\Geocoder\Geocoder;

class GeoApiController extends Controller
{

    public function getNombreComunidad($CCOM)
    {
        $comunidades = Http::get(env('GEO_API_URL')."comunidades?",[
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        foreach($comunidades as $comunidad){
            if($comunidad['CCOM'] == $CCOM){
                return  $comunidad['COM'];
            }
        }
        
        return null;
    }

    public function getNombreProvincia($CCOM,$CPRO)
    {
        $provincias = Http::get(env('GEO_API_URL')."provincias?",[
            "CCOM" => $CCOM,
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        foreach($provincias as $provincia){
            if($provincia['CPRO'] == $CPRO){
                return  $provincia['PRO'];
            }
        }
        
        return null;
    }

    public function getNombreMunicipio($CPRO,$CMUM){
        $municipios = Http::get(env('GEO_API_URL')."municipios?",[
            "CPRO" => $CPRO,
            "type" => env('GEO_API_TYPE'),
            "key" => env('GEO_API_KEY')
            ])->json()['data'];

        foreach($municipios as $municipio){
            if($municipio['CMUM'] == $CMUM){
                return  $municipio['DMUN50'];
            }
        }
        
        return null;
    }

}