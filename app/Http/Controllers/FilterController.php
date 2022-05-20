<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenCage\Geocoder\Geocoder;

class FilterController extends Controller
{
    /**
     * Display a listing of the filtered resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pisosFiltrados = DB::table('pisos')->where('id', '>', 0);

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

        if(isset($request->fumadoresSI))
        {
            $pisosFiltrados = $pisosFiltrados->where('fumadores', $request->fumadoresSI);
        }

        if(isset($request->fumadoresNO))
        {
            $pisosFiltrados = $pisosFiltrados->where('fumadores', $request->fumadoresNO);
        }

        if(!empty($request->animalesSI))
        {
            $pisosFiltrados = $pisosFiltrados->where('animales', $request->animalesSI);
        }

        if(!empty($request->animalesNO))
        {
            $pisosFiltrados = $pisosFiltrados->where('animales', $request->animalesNO);
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

        if(sizeof($pisosFiltrados) != 0){

            foreach ($pisosFiltrados as $pisoFiltrado){
                
                $piso = new Piso();
    
                $piso->id = $pisoFiltrado->id;
                $piso->longitud = $pisoFiltrado->longitud;
                $piso->latitud = $pisoFiltrado->latitud;
                $piso->titulo = $pisoFiltrado->titulo;
                $piso->calle = $pisoFiltrado->calle;
                $piso->cod_postal = $pisoFiltrado->cod_postal;
    
                $piso->descripcion = $pisoFiltrado->descripcion;
                $piso->num_habitaciones = $pisoFiltrado->num_habitaciones;
                $piso->num_aseos = $pisoFiltrado->num_aseos;
                $piso->m2 = $pisoFiltrado->m2;
                $piso->sexo = $pisoFiltrado->sexo;
                $piso->fumadores = $pisoFiltrado->fumadores;
    
                $piso->animales = $pisoFiltrado->animales;
                $piso->precio = $pisoFiltrado->precio;
                $piso->created_at = $pisoFiltrado->created_at;
                $piso->updated_at = $pisoFiltrado->updated_at;
                $piso->user_id = $pisoFiltrado->user_id;
    
                $pisos[] = $piso;
            }

            return view('piso.index',compact('pisos', 'fotos'));

        }else{

            $pisos = Piso::all();
            $pisosPagina=Piso::paginate(8);
            return view('piso.index',compact('pisos', 'pisosPagina', 'fotos'));

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function searchedCities($ciudad)
    {
        $geocoder = new Geocoder('469ef009f74d4177a741647ec1b41a1f');
        $result = $geocoder->geocode($ciudad);
        if ($result && $result['total_results'] > 0) {
            $first = $result['results'][0];
            //print $first['geometry']['lng'] . ';' . $first['geometry']['lat'] . ';' . $first['formatted'] . "\n";
            # 4.360081;43.8316276;6 Rue Massillon, 30020 Nîmes, Frankreich
            $pisos = Piso::whereBetween('longitud', [$first['geometry']['lat'] - 0.10, $first['geometry']['lat'] + 0.10])
                    ->whereBetween('latitud', [$first['geometry']['lng'] - 0.10, $first['geometry']['lng'] + 0.10])
                    ->get();
        }else{
            $pisos = Piso::all();
        }

        $pisosPagina = $pisos->paginate(8);
        $fotos=Foto::all();

        return view('piso.index',compact('pisosPagina', 'pisos', 'fotos'));
    }
}
