<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Piso;
use App\Models\User;
use App\Models\UserRentPiso;
use Illuminate\Http\Request;

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
                }
                
                foreach ($pisos as $piso){
                    $arrendatarios[] = User::find($piso->user_id);
                }

                return view('usuario.perfil',compact('user','rents','pisos','arrendatarios'));

            }

            return view('usuario.perfil',compact('user'));

        }elseif(auth()->user()->rol == 'arrendatario'){

            $pisos = Piso::where('user_id', '=', $user_id)->get();
            
            foreach($pisos as $piso){
                // $rent = UserRentPiso::where('piso_id', '=', $piso->id)->get();
                $direcciones[] = Direccion::where('piso_id', '=', $piso->id)->get();
                
                // $inquilinos[] = User::find($rent->user_id);
            }
            // dd($direcciones);
            // if(!empty($inquilinos)){
            //     return view('usuario.perfil',compact('user','pisos','inquilinos'));
            // }

            return view('usuario.perfil',compact('user','pisos','direcciones'));
            
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
