<?php
namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Piso;
use App\Models\User;
use App\Models\UserRentPiso;
use Illuminate\Http\Request;

// use OpenCage\Geocoder\Geocoder;

class PisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pisosPagina=Piso::paginate(8);
        $pisos=Piso::all();
        $fotos=Foto::all();

        // $geocoder = new Geocoder('469ef009f74d4177a741647ec1b41a1f');
        // $result = $geocoder->geocode('6 Rue Massillon, 30020 Nîmes', ['language' => 'fr', 'countrycode' => 'fr']);
        // if ($result && $result['total_results'] > 0) {
        //     $first = $result['results'][0];
        //     //print $first['geometry']['lng'] . ';' . $first['geometry']['lat'] . ';' . $first['formatted'] . "\n";
        //     # 4.360081;43.8316276;6 Rue Massillon, 30020 Nîmes, Frankreich
        // }

        return view('piso.index',compact('pisosPagina', 'pisos', 'fotos'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     $clientes = Cliente::all();
    //     return view('factura.create',compact('clientes'));
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $factura = new Factura();
    //     $cliente=Cliente::find($request->nombre);

    //     $factura->fecha = $request->fecha;
    //     $factura-> nombre = $cliente->nombre;
    //     $factura-> direccion = $request->direccion;
    //     $factura->cpostal = $request->cpostal;
    //     $factura->poblacion = $request->poblacion;
    //     $factura->provincia = $request->provincia;
    //     $factura->telefono = $request->telefono;
    //     $factura->cliente_id = $request->nombre;
    //     $factura->save();

    //     $productos=Producto::all();
    //     $clientes=Cliente::all();
    //     return redirect()->route('facturas.edit', compact('factura','productos','clientes'));
    // }

    /**
     * Display the specified resource.
     *
     * @param  Piso  $piso
     * @return \Illuminate\Http\Response
     */
    public function show(Piso $piso)
    {
        $inquilinos[] = [];
        $usersRentPiso[] = [];

        // BUSCAR EL USUARIO QUE ES PROPIETARIO
        $user_id = $piso->user_id;
        $arrendatario = User::find($user_id);
        
        // BUSCAR LOS USUARIOS INQUILINOS
        $piso_id = $piso->id;
        // $usersRentPiso = DB::table('user_rent_pisos')->select('user_id')->where('piso_id','=',$piso_id)->get();
        $usersRentPiso = UserRentPiso::where('piso_id','=',$piso_id)->get();
        
        foreach ($usersRentPiso as $rents){
            $inquilino_id = $rents->user_id;
            $inquilinos[] = User::find($inquilino_id);
        }

        // ENVIAR LA INFORMACIÓN A VIEW SHOW
        return view('piso.show',compact('piso','arrendatario','inquilinos'));
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($num)
    // {
    //     $factura=Factura::find($num);
    //     $productos=Producto::all();
    //     $clientes=Cliente::all();
    //     return view('factura.factura',['factura'=>$factura,'productos'=>$productos,'clientes'=>$clientes]);
    // }

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

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Factura $factura
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Factura $factura)
    // {
    //     $factura->delete();
    //     return redirect()->back();
    // }
}
