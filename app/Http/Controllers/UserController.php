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

            $user = User::find($user_id);
            $rents = UserRentPiso::where('user_id', '=', $user_id)->get();

            if(!$rents->isEmpty()){

                foreach($rents as $rent){
                    $pisos[] = Piso::find($rent->piso_id);
                    // $pisos[] = DB::table('pisos')->where('pisos.id', '=', $rent->piso_id)
                    //                 ->join('direcciones', 'pisos.id', '=', 'direcciones.piso_id')
                    //                 ->get();
                }
                // dd($pisos);
                foreach ($pisos as $piso){
                    // dd($piso);
                    $propietarios[] = User::find($piso->user_id);
                    // $propietarios[] = DB::table('users')->where('id', '=', $piso->user_id);
                }
                // dd($direcciones);
                return view('usuario.perfil',compact('user','rents','pisos','propietarios'));

            }

            return view('usuario.perfil',compact('user'));

        }elseif(auth()->user()->rol == 'arrendatario'){

            $pisos = Piso::where('user_id', '=', $user_id)->get();
            
            if(sizeof($pisos) != 0){
                foreach($pisos as $piso){
                    $direcciones[] = Direccion::where('piso_id', '=', $piso->id)->get();
                    // FALTA PASAR INQUILINOS
                }
                return view('usuario.perfil',compact('user','pisos','direcciones'));
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
        $user=User::find($id);
        return view('usuario.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        dump($user);
        // if (!$request->hasFile('avatar')) {
            $user->nombre = $request->nombre;
            $user->apellidos = $request->apellidos;
            $user->info = $request->info;
            $user->username = $request->username;
            $user->password = $request->password;
            $user->email = $request->email;
        // }else {
        //     $user->avatar = $request->avatar;
        // }

        $user->update();

        return view('usuario.perfil',compact('user'));
    }

}
