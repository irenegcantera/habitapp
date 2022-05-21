<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Foto;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    /**
     * Display a listing of the filtered resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $pisosFiltrados = DB::table('pisos');

        if(!empty($request->precioMin))
        {
            $pisosFiltrados = $pisosFiltrados->where('precio', '>=' , $request->precioMin);
        }

        if(!empty($request->precioMax))
        {
            $pisosFiltrados = $pisosFiltrados->where('precio', '<=' , $request->precioMax);
        }

        if(!empty($request->num_habitaciones) || $request->num_habitaciones != 0)
        {
            $pisosFiltrados = $pisosFiltrados->where('num_habitaciones', '=' , $request->num_habitaciones);
        }

        if(!empty($request->num_aseos) || $request->num_aseos != 0)
        {
            $pisosFiltrados = $pisosFiltrados->where('num_aseos', '=' , $request->num_aseos);
        }

        if(isset($request->fumadores))
        {
            if($request->fumadores == 1){
                $pisosFiltrados = $pisosFiltrados->where('fumadores', $request->fumadores);
            }else{
                $pisosFiltrados = $pisosFiltrados->where('fumadores', $request->fumadores);
            }
        }

        if(isset($request->animales))
        {
            if($request->fumadores == 1){
                $pisosFiltrados = $pisosFiltrados->where('animales', $request->animales);
            }else{
                $pisosFiltrados = $pisosFiltrados->where('animales', $request->animales);
            }
        }

        if(!empty($request->sexoHombre))
        {
            $pisosFiltrados = $pisosFiltrados->where('sexo', $request->sexoHombre);
        }

        if(!empty($request->sexoMujer))
        {
            $pisosFiltrados = $pisosFiltrados->where('sexo', $request->sexoMujer);
        }

        if(!empty($request->sexoMixto))
        {
            $pisosFiltrados = $pisosFiltrados->where('sexo', $request->sexoMixto);
        }
        
        $pisosFiltrados = $pisosFiltrados->orderBy('precio','asc')->get();
        
        $fotos=Foto::all();

        $direcciones = FilterController::filterByGeography($request); // query con las direcciones
        
        if(!empty($direcciones))
        {
            
            $direcciones = $direcciones[sizeof($direcciones) - 1]->get();
            
            if(sizeof($pisosFiltrados) != 0){
                
                foreach ($pisosFiltrados as $pisoFiltrado){
                    foreach ($direcciones as $direccion){
                        if($pisoFiltrado->id == $direccion->piso_id)
                        {
                            $pisos[] = Piso::create($pisoFiltrado);
                        }
    
                    }        
                    
                }
                // echo "direcciones y filtros";
                return view('piso.index',compact('pisos', 'fotos'));
    
            }else{
                foreach ($direcciones as $direccion){
                    $pisos[] = Piso::find($direccion->piso_id);
                }    

                // echo "solo direcciones";
                return view('piso.index',compact('pisos', 'fotos'));
            }

        }else{
            
            if(sizeof($pisosFiltrados) != 0){
                foreach ($pisosFiltrados as $pisoFiltrado){
                    $pisos[] = Piso::create($pisoFiltrado);
                }

                // echo "solo filtros";
                return view('piso.index',compact('pisos', 'fotos'));
            }

        }

        // echo "ni direcciones ni filtros";
        $pisos = Piso::all();
        $pisosPagina=Piso::paginate(8);
        return view('piso.index',compact('pisos', 'pisosPagina', 'fotos'));
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function searchedCities(String $ciudad)
    {
        $pisos_id = DB::table('direcciones')->select('piso_id')->where('municipio', $ciudad)->get(); // recoge direccion->id pisos
        
        foreach($pisos_id as $piso_id){
            $pisos[] = Piso::find($piso_id);
        }
        
        $fotos = Foto::all();

        return view('piso.index',compact('pisos', 'fotos'));
    }

    /**
     * Display the specified search resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $direcciones = FilterController::filterByGeography($request);
        $direcciones = $direcciones[sizeof($direcciones) - 1]->get();
        $fotos=Foto::all();

        if(!empty($direcciones)){

            foreach ($direcciones as $direccion){
                $pisos[] = Piso::find($direccion->piso_id);
            }   
            return view('piso.index',compact('pisos', 'fotos'));

        }else{

            $pisos = Piso::all();
            $pisosPagina=Piso::paginate(8);
            return view('piso.index',compact('pisos', 'pisosPagina', 'fotos'));

        }
    }

    /**
     * Devuelve pisos filtrados por zona geográfica.
     *
     * @param  \Illuminate\Http\Request $request
     * @return  Array $pisos -> pisos y query
     */
    public function filterByGeography(Request $request)
    {
        $geoApi = new GeoApiController();
        
        $pisosBuscados = DB::table('direcciones')->where('id', '>', 0); // recoge identificador del piso
        
        if($request->comunidades != "null")
        {
            $nombreComunidad = $geoApi->getNombreComunidad($request->comunidades);
            $pisosBuscados = $pisosBuscados->where('comunidad', '=' , $nombreComunidad);
            
        }

        if($request->provincias != "null")
        {
            $nombreProvincia = $geoApi->getNombreProvincia($request->comunidades, $request->provincias);
            $pisosBuscados = $pisosBuscados->where('provincia', '=' , $nombreProvincia);
            
        }

        if($request->municipios != "null")
        {
            echo "ENTRANDO";
            $nombreMunicipio = $geoApi->getNombreMunicipio($request->provincias, $request->municipios);
            $pisosBuscados = $pisosBuscados->where('municipio', '=' , $nombreMunicipio);
           
        }

        $query = $pisosBuscados->orderBy('piso_id','asc');
        $pisosBuscados = $pisosBuscados->orderBy('piso_id','asc')->get();
        
        if(sizeof($pisosBuscados) != 0){
            
            foreach ($pisosBuscados as $pisoBuscado){
                $pisos[] = Piso::find($pisoBuscado->piso_id);
                
            }
            
            $pisos[] = $query; // añadimos la query builder para seguir filtrando
            
            return $pisos;

        }

        return null; 
       
    }

}
