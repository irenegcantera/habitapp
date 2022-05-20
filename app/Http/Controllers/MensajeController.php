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

        // $mensajesPisosRef = Mensaje::select('piso_id')->where('from_user',auth()->user()->id)
        //                             ->orWhere('to_user',auth()->user()->id)
        //                             ->orderBy('fecha_enviado','desc')
        //                             ->get();
                                    
        // $mensajes = Mensaje::where('from_user',auth()->user()->id)
        //                     ->orWhere('to_user',auth()->user()->id)
        //                     ->orderBy('fecha_enviado','desc')
        //                     ->get();

        // foreach($mensajes as $mensaje){
        //     $to_user = User::find($mensaje->to_user);
        //     $piso_id = $mensaje->piso_id;

        //     $informacion[]= ['contenido' => $mensaje->contenido, 
        //                     'fecha_recibido' => $mensaje->fecha_recibido,
        //                     'to_user' => $to_user->nombre." ".$to_user->apellidos, 
        //                     // 'inquilino' => User::find($mensaje->from_user), 
        //                     'piso' => Piso::find($piso_id)
        //                     ];
        // }
        
        // return view('mensaje.index',compact('informacion'));
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

        return redirect()->back();
    }
}
