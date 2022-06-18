<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Foto;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class FilterController extends Controller
{
    /**
     * Display a listing of the filtered resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fotos=Foto::all();
        $pisosTotales = Piso::all();        
        $pisosFiltrados = FilterController::filterByFeatures($request);
        $direcciones = FilterController::filterByGeography($request); // query con las direcciones
        
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
            // dd($direcciones);
            $direcciones = $direcciones[sizeof($direcciones) - 1]->get();
            // dd($direcciones);
            if($pisosFiltrados != null){
                // dd($pisosFiltrados);
                foreach ($pisosFiltrados as $pisoFiltrado){
                    foreach ($direcciones as $direccion){
                        if($pisoFiltrado->id == $direccion->piso_id)
                        {
                            $pisos[] = Piso::create($pisoFiltrado);
                        }
                    }        
                }
                
                if(isset($pisos)){
                    // echo "direcciones y filtros";
                    // $pisosPagina = $this->paginate($pisos);
                    return view('piso.index',compact('pisos', 'fotos', 'filtros'));
                }else{
                    return view('piso.index',compact('filtros'));
                }
    
            }else{
                foreach ($direcciones as $direccion){
                    $pisos[] = Piso::find($direccion->piso_id);
                }    
                
                // echo "solo direcciones";
                return view('piso.index',compact('pisos', 'fotos', 'filtros'));
            }

        }else{
            
            if(!empty($pisosFiltrados)){
                if(sizeof($pisosTotales) != sizeof($pisosFiltrados)){
                    foreach ($pisosFiltrados as $pisoFiltrado){
                        $pisos[] = Piso::create($pisoFiltrado);
                    }
                }
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
        $data = DB::table('pisos')->join('direcciones','pisos.id', '=', 'direcciones.piso_id')
                                    ->where('municipio', '=', $ciudad)->get();
        $fotos = Foto::all();
        
        if(sizeof($data) != 0){
            foreach($data as $key => $value){
                $atributos = [
                    "id" => $value->id,
                    "longitud" => $value->longitud,
                    "latitud" => $value->latitud,
                    "titulo" => $value->titulo,
                    "descripcion" => $value->descripcion,
                    "num_habitaciones" => $value->num_habitaciones,
                    "num_aseos" => $value->num_aseos,
                    "m2" => $value->m2,
                    "sexo"=> $value->sexo,
                    "fumadores" => $value->fumadores,
                    "animales" => $value->animales,
                    "precio"=> $value->precio,
                    "user_id" => $value->user_id
                ];

                $pisos[] = new Piso($atributos);
            }

            return view('piso.index',compact('pisos', 'fotos'));
        }

        $informacion = "No se han encontrado pisos.";
        return view('piso.index',compact('fotos','informacion'));  
        
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
            if($request->comunidades == 0){
                $informacion = "Debe seleccionar al menos la comunidad.";
            }else{
                $informacion = "No se han encontrado pisos.";
            }
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
        }

        if(isset($request->animales))
        {
            $pisosFiltrados = $pisosFiltrados->where('animales', '=', $request->animales);
        }

        if(!empty($request->sexo))
        {
            $pisosFiltrados = $pisosFiltrados->where('sexo', '=', $request->sexo);
        }
        
        if($request->order != 0){
            if($request->order == 1){
                $pisosFiltrados = $pisosFiltrados->orderBy('user_id','asc')->get();
            }elseif($request->order == 2){
                $pisosFiltrados = $pisosFiltrados->orderBy('precio','asc')->get();
            }elseif($request->order == 3){
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

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // public function paginate($items, $perPage = 5, $page = null, $options = [])
    // {
    //     $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    //     $items = $items instanceof Collection ? $items : Collection::make($items);
    //     return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    // }

}
