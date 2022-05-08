<?php

namespace App\Http\Controllers;

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
        $where[] = [];
        $pisos = null;

        if(!empty($request->precioMin))
        {
            // $pisos = DB::table('pisos')->where('precio', '>=' , $request->precioMin);
            // $where[] = ['precio', '>=' , $request->precioMin];
        }

        if(!empty($request->precioMax))
        {
        //     $pisos = $pisos->where('precio', '<=' , $request->precioMax);
            // $where[] = ['precio', '<=' , $request->precioMax];
        }

        if(!empty($request->num_habitaciones) || $request->num_habitaciones != 0)
        {
            // $pisos = $pisos->where('num_habitaciones', '<=' , $request->precioMax);
            // $where[] = ['num_habitaciones', '=' , $request->num_habitaciones];
        }

        if(!empty($request->num_aseos) || $request->num_aseos != 0)
        {
            // $pisos = $pisos->where('num_aseos', '=' , $request->num_aseos);
            // $where[] = ['num_aseos', '=' , $request->num_aseos];
        }

        if(isset($request->fumadoresSI))
        {
            // $pisos = DB::table('pisos')->where('fumadores', $request->fumadoresSI);
            $where[] = ['fumadores', '=', $request->fumadoresSI];
        }

        if(isset($request->fumadoresNO))
        {
            // $pisos = $pisos->where('fumadores', $request->fumadoresNO);
            // $where[] = ['fumadores', '=' , $request->fumadoresNO];
        }

        if(!empty($request->animalesSI))
        {
            // $pisos = $pisos->where('animales', $request->animalesSI);
            $where[] = ['animales', '=', $request->animalesSI];
        }

        if(!empty($request->animalesNO))
        {
            // $pisos = $pisos->where('animales', $request->animalesNO);
            // $where[] = ['animales', '=' , $request->animalesNO];
        }

        if(!empty($request->sexoHombre))
        {
            // $pisos = $pisos->where('sexo', $request->sexoHombre);
            // $where[] = ['sexo', '=' , $request->sexoHombre];
        }

        if(!empty($request->sexoMujer))
        {
            // $pisos = $pisos->where('sexo', $request->sexoMujer);
            // $where[] = ['sexo', '=' , $request->sexoMujer];
        }

        if(!empty($request->sexoMixto))
        {
            // $pisos = $pisos->where('sexo', $request->sexoMixto);
            // $where[] = ['sexo', '=' , $request->sexoMixto];
        }

        $pisos = DB::table('pisos')->where($where)->get();
        $pisosPagina = Piso::all();
        $fotos=Foto::all();

        return view('piso.index',compact('pisosPagina', 'pisos', 'fotos'));
    }
}
