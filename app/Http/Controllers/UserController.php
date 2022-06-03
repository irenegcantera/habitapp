<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Piso;
use App\Models\User;
use App\Models\UserRentPiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if(auth()->user()->rol == 'inquilino'){

            $rents = UserRentPiso::where('user_id', '=', $user_id)->get();

            if(!$rents->isEmpty()){
                foreach($rents as $rent){
                    $pisos[] = DB::table('pisos')
                                    ->join('direcciones', 'direcciones.piso_id', '=', 'pisos.id')
                                    ->join('users', 'users.id', '=', 'pisos.user_id')
                                    ->where('pisos.id', '=', $rent->piso_id)
                                    ->get();
                    $pisosShow[] = Piso::find($rent->piso_id);
                }
                
                return view('usuario.perfil',compact('user','rents','pisos','pisosShow'));
            }

            return view('usuario.perfil',compact('user'));

        }elseif(auth()->user()->rol == 'arrendatario'){

            $pisos = Piso::where('user_id', '=', $user_id)->get();
            
            if(sizeof($pisos) != 0){
                foreach($pisos as $piso){
                    $direcciones[] = Direccion::where('piso_id', '=', $piso->id)->get();
                    $inquilinos[] = DB::table('users')
                                    ->join('user_rent_pisos', 'users.id', '=', 'user_rent_pisos.user_id')
                                    ->where('user_rent_pisos.piso_id', '=', $piso->id)
                                    ->get();
                    
                }
                // dd($inquilinos);
                return view('usuario.perfil',compact('user','pisos','direcciones','inquilinos'));
            }
            return view('usuario.perfil',compact('user','pisos'));
            
        }
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

}
