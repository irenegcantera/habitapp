<?php

namespace App\Http\Controllers;

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
        $pisos[] = [];
        $inquilinos[] = [];
        $arrendatarios[] = [];

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if(auth()->user()->rol == 'inquilino'){

            $user = User::find($user_id);
            $rents = UserRentPiso::where('user_id', '=', $user_id)->get();

            if(!$rents->isEmpty()){

                foreach($rents as $rent){
                    $pisos[] = Piso::where('piso_id', '=', $rent->piso_id)->get();
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
                $inquilinos[] = UserRentPiso::where('user_id', '=', $user_id)->get();
            }

            return view('usuario.perfil',compact('user','pisos','inquilinos'));
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
        return view('usuario.config',compact('user'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $num
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request,$numero)
    // {
    //     $factura = Factura::find($numero);
    //     $cliente = Cliente::find($request->id_cliente);

    //     $factura->fecha = $request->fecha;
    //     $factura-> nombre = $cliente->nombre;
    //     $factura-> direccion = $cliente->direccion;
    //     $factura->cpostal = $cliente->cod_postal;
    //     $factura->poblacion = $cliente->poblacion;
    //     $factura->provincia = $cliente->provincia;
    //     $factura->telefono = $cliente->telefono;
    //     $factura->cliente_id = $request->id_cliente;
        
    //     // var_dump($factura);
    //     $factura->update();

    //     $productos=Producto::all();
    //     $clientes=Cliente::all();
    //     return redirect()->route('facturas.edit', compact('factura','productos','clientes'));
    // }

}
