<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Piso;
use App\Models\User;
use App\Notifications\MensajeNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
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
        $mensaje->fecha_leido = null;
        $mensaje->leido = false;
        $mensaje->from_user = $request->from_user;
        $mensaje->to_user = $request->to_user;
        $mensaje->piso_id = $request->piso_id;
        
        $mensaje->save();

        // ENVIAR NOTIFICACIÓN
        $user = User::find($request->to_user);
        $user->notify(new MensajeNotification($request->piso_id, $request->from_user));

        return redirect()->back()->with('informacion','Se ha enviado correctamente.');
    }
}
