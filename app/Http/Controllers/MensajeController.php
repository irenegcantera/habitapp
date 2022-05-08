<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Piso;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrendatarios[] = [];
        $inquilinos[] = [];
        $pisos[] = [];

        $mensajes=Mensaje::all();

        foreach($mensajes as $mensaje){
            $to_user = $mensaje->to_user;
            $from_user = $mensaje->from_user;
            $piso_id = $mensaje->piso_id;

            $arrendatarios[]=User::find($to_user);
            $inquilinos[]=User::find($from_user);
            $pisos[]=Piso::find($piso_id);
        }
        
        return view('mensaje.index',compact('mensajes','arrendatarios','inquilinos','pisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $mensajes = Mensaje::all();
    //     return view('mensaje.create',compact('mensajes'));
    // }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensaje = new Mensaje();

        $mensaje->contenido = $request->contenido;
        $mensaje->fecha_enviado = Carbon::now();
        $mensaje->fecha_recibido = Carbon::now();
        $mensaje->from_user = $request->from_user;
        $mensaje->to_user = $request->to_user;
        $mensaje->piso_id = $request->piso_id;
        
        $mensaje->save();

        return  redirect()->back();
    }
}
