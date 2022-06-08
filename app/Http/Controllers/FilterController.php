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
        // dd($request);
        $fotos=Foto::all();
        $pisosFiltrados = FilterController::filterByFeatures($request);
        $direcciones = FilterController::filterByGeography($request); // query con las direcciones
        // dd($pisosFiltrados);
        $filtros = [
            'order' => $request->order,
            'precioMin' => $request->precioMin,
            'precioMax' => $request->precioMax,
            'num_habitaciones' => $request->num_habitaciones,
            'num_aseos' => $request->num_aseos,
            'm2Min' => $request->m2Min,
            'm2Max' => $request->m2Max,
            'fumadores' => $request->fumadores,
            'animales' => $request->animales,
            'sexo' => $request->sexo,
            'comunidad' => $request->comunidad,
            'provincia' => $request->provincia,
            'municipio' => $request->municipio,
        ];

        if(!empty($direcciones))
        {
            $direcciones = $direcciones[sizeof($direcciones) - 1]->get();

            if($pisosFiltrados != null){
                
                foreach ($pisosFiltrados as $pisoFiltrado){
                    foreach ($direcciones as $direccion){
                        if($pisoFiltrado->id == $direccion->piso_id)
                        {
                            $pisos[] = Piso::create($pisoFiltrado);
                        }
                    }        
                }
                // echo "direcciones y filtros";
                return view('piso.index',compact('pisos', 'fotos', 'filtros'));
    
            }else{
                foreach ($direcciones as $direccion){
                    $pisos[] = Piso::find($direccion->piso_id);
                }    
                // echo "solo direcciones";
                return view('piso.index',compact('pisos', 'fotos', 'filtros'));
            }

        }else{
            
            if(!empty($pisosFiltrados)){
                foreach ($pisosFiltrados as $pisoFiltrado){
                    $pisos[] = Piso::create($pisoFiltrado);
                }
                // echo "solo filtros";
                return view('piso.index',compact('pisos', 'fotos', 'filtros'));
            }

            return view('piso.index',compact('filtros'));
        }
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
        if($request->comunidades != 0)
        {
            $pisosBuscados = DB::table('direcciones')->where('id', '>', 0); // recoge identificador del piso
            $nombreComunidad = GeoApiController::getNombreComunidad($request->comunidades);
            $pisosBuscados = $pisosBuscados->where('comunidad', '=' , $nombreComunidad);
            
            if($request->provincias != 0)
            {
                $nombreProvincia = GeoApiController::getNombreProvincia($request->comunidades, $request->provincias);
                $pisosBuscados = $pisosBuscados->where('provincia', '=' , $nombreProvincia);
                
                if($request->municipios != 0)
                {
                    $nombreMunicipio = GeoApiController::getNombreMunicipio($request->provincias, $request->municipios);
                    $pisosBuscados = $pisosBuscados->where('municipio', '=' , $nombreMunicipio);
                }
            }

            $query = $pisosBuscados->orderBy('piso_id','asc');
            $pisosBuscados = $pisosBuscados->orderBy('piso_id','asc')->get();
            // dd($pisosBuscados);
        }
        
        if(isset($pisosBuscados) && sizeof($pisosBuscados) != 0){
            
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

        if(!empty($request->m2Min))
        {
            $pisosFiltrados = $pisosFiltrados->where('m2', '>=' , $request->m2Min);
        }

        if(!empty($request->m2Max))
        {
            $pisosFiltrados = $pisosFiltrados->where('m2', '<=' , $request->m2Max);
        }
        
        
        if(isset($request->fumadores))
        {
           
            $pisosFiltrados = $pisosFiltrados->where('fumadores', '=', $request->fumadores);
            // dd($pisosFiltrados->get());
        }

        if(isset($request->animales))
        {
            $pisosFiltrados = $pisosFiltrados->where('animales', '=', $request->animales);
        }

        if(!empty($request->sexo))
        {
            $pisosFiltrados = $pisosFiltrados->where('sexo', '=', $request->sexo);
        }
        
        if(!empty($request->order)){
            if($request->order == 1){
                $pisosFiltrados = $pisosFiltrados->orderBy('user_id','asc')->get();
            }elseif($request->order == 2){
                $pisosFiltrados = $pisosFiltrados->orderBy('precio','asc')->get();
            }else{
                $pisosFiltrados = $pisosFiltrados->orderBy('precio','desc')->get();
            }
        }else{
            $pisosFiltrados = $pisosFiltrados->orderBy('id','asc')->get();
        }

        if(sizeof($pisosFiltrados) != 0){
            return $pisosFiltrados;
        }

        return null; 
    }

}
