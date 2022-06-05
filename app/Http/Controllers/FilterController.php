<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Foto;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
            $filtros[] = ['Precio', '>=' , $request->precioMin];
        }

        if(!empty($request->precioMax))
        {
            $pisosFiltrados = $pisosFiltrados->where('precio', '<=' , $request->precioMax);
            $filtros[] = ['Precio', '<=' , $request->precioMax];
        }

        if(!empty($request->num_habitaciones) || $request->num_habitaciones != 0)
        {
            $pisosFiltrados = $pisosFiltrados->where('num_habitaciones', '=' , $request->num_habitaciones);
            $filtros[] = ['Nº habitaciones' => $request->num_habitaciones];
        }

        if(!empty($request->num_aseos) || $request->num_aseos != 0)
        {
            $pisosFiltrados = $pisosFiltrados->where('num_aseos', '=' , $request->num_aseos);
            $filtros[] = ['Nº aseos' => $request->num_aseos];
        }

        if(isset($request->fumadores))
        {
            if($request->fumadores == 1){
                $pisosFiltrados = $pisosFiltrados->where('fumadores', $request->fumadores);
                $filtros[] = ['Fumadores' => 'Permitido'];
            }else{
                $pisosFiltrados = $pisosFiltrados->where('fumadores', $request->fumadores);
                $filtros[] = ['Fumadores' => 'No permitido'];
            }
        }

        if(isset($request->animales))
        {
            if($request->animales == 1){
                $pisosFiltrados = $pisosFiltrados->where('animales', $request->animales);
                $filtros[] = ['Animales' => 'Permitidos'];
            }else{
                $pisosFiltrados = $pisosFiltrados->where('animales', $request->animales); 
                $filtros[] = ['Animales' => 'No permitidos'];  
            }
        }

        if(!empty($request->sexoHombre))
        {
            $pisosFiltrados = $pisosFiltrados->where('sexo', $request->sexoHombre);
            $filtros[] = ['Compañeros' => 'Hombre'];
        }

        if(!empty($request->sexoMujer))
        {
            $pisosFiltrados = $pisosFiltrados->where('sexo', $request->sexoMujer);
            $filtros[] = ['Compañeros' => 'Mujer'];            
        }

        if(!empty($request->sexoMixto))
        {
            $pisosFiltrados = $pisosFiltrados->where('sexo', $request->sexoMixto);
            $filtros[] = ['Compañeros' => 'Mixto'];
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
        $data[] = DB::table('pisos')->join('direcciones','pisos.id', '=', 'direcciones.piso_id')
                                    ->where('municipio', '=', $ciudad)->get();
        $fotos = Foto::all();

        if($data){
            foreach($data as $key => $value){
                foreach($value as $k => $v){
                    $atributos = [
                        "id" => $v->id,
                        "longitud" => $v->longitud,
                        "latitud" => $v->latitud,
                        "titulo" => $v->titulo,
                        "descripcion" => $v->descripcion,
                        "num_habitaciones" => $v->num_habitaciones,
                        "num_aseos" => $v->num_aseos,
                        "m2" => $v->m2,
                        "sexo"=> $v->sexo,
                        "fumadores" => $v->fumadores,
                        "animales" => $v->animales,
                        "precio"=> $v->precio,
                        "user_id" => $v->user_id
                    ];
    
                    $pisos[] = new Piso($atributos);
    
                    $atributos = [
                        'calle' => $v->calle,
                        'numero' => $v->numero,
                        'portal' => $v->portal,
                        'cod_postal' => $v->cod_postal,
                        'municipio' => $v->municipio,
                        'provincia' => $v->provincia,
                        'comunidad' => $v->comunidad,
                        'piso_id' => $v->piso_id,
                    ];
    
                    $direcciones[] = new Direccion($atributos);

                    if(Cache::has('comunidad')){
                        Cache::pull('comunidad');
                        Cache::put('comunidad',$v->comunidad, now()->addMinutes(10));
                    }else{
                        Cache::put('comunidad',$v->comunidad, now()->addMinutes(10));
                    }
        
                    if(Cache::has('provincia')){
                        Cache::pull('provincia');
                        Cache::put('provincia',$v->provincia, now()->addMinutes(10));
                    }else{
                        Cache::put('provincia',$v->provincia, now()->addMinutes(10));
                    }
        
                    if(Cache::has('municipio')){
                        Cache::pull('municipio');
                        Cache::put('municipio',$v->municipio, now()->addMinutes(10));
                    }else{
                        Cache::put('municipio',$v->municipio, now()->addMinutes(10));
                    }
                }
            }

            return view('ciudades.index',compact('pisos', 'direcciones', 'fotos'));
        }

        $informacion = "No se han encontrado pisos.";
        return view('ciudades.index',compact('fotos','informacion'));  
        
    }

    /**
     * Display the specified search resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $pisosFiltrados = FilterController::filterByGeography($request);
        if(!empty($pisosFiltrados)){
            for($i = 0; $i < sizeof($pisosFiltrados) - 1; $i++){
                $pisos[] = $pisosFiltrados[$i];
            } 

            if(Cache::has('comunidad')){
                Cache::pull('comunidad');
            }

            if(Cache::has('provincia')){
                Cache::pull('provincia');
            }

            if(Cache::has('municipio')){
                Cache::pull('municipio');
            }

            Cache::put('comunidad',$request->comunidades, now()->addMinutes(10));
            Cache::put('provincia',$request->provincias, now()->addMinutes(10));
            Cache::put('municipio',$request->municipios, now()->addMinutes(10));

            return view('piso.index',compact('pisos'));
        }else{
            $informacion = "No se han encontrado pisos.";
            return view('index',compact('informacion'));
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
        $pisosBuscados = DB::table('direcciones')->where('id', '>', 0); // recoge identificador del piso
        
        if($request->comunidades != 0)
        {
            $nombreComunidad = GeoApiController::getNombreComunidad($request->comunidades);
            $pisosBuscados = $pisosBuscados->where('comunidad', '=' , $nombreComunidad);
        }

        if($request->provincias != 0)
        {
            $nombreProvincia = GeoApiController::getNombreProvincia($request->comunidades, $request->provincias);
            $pisosBuscados = $pisosBuscados->where('provincia', '=' , $nombreProvincia);
        }

        if($request->municipios != 0)
        {
            $nombreMunicipio = GeoApiController::getNombreMunicipio($request->provincias, $request->municipios);
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

    /**
     * Devuelve pisos filtrados por características.
     *
     * @param  \Illuminate\Http\Request $request
     * @return  Array $pisos -> pisos y query
     */
    public function filterByFeatures(Request $request)
    {
        $pisosBuscados = DB::table('direcciones')->where('id', '>', 0); // recoge identificador del piso
        
        if($request->comunidades != "null")
        {
            $nombreComunidad = GeoApiController::getNombreComunidad($request->comunidades);
            $pisosBuscados = $pisosBuscados->where('comunidad', '=' , $nombreComunidad);
        }

        if($request->provincias != "null")
        {
            $nombreProvincia = GeoApiController::getNombreProvincia($request->comunidades, $request->provincias);
            $pisosBuscados = $pisosBuscados->where('provincia', '=' , $nombreProvincia);
        }

        if($request->municipios != "null")
        {
            $nombreMunicipio = GeoApiController::getNombreMunicipio($request->provincias, $request->municipios);
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
