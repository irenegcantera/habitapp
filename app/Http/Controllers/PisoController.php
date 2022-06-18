<?php
namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Foto;
use App\Models\Piso;
use App\Models\User;
use App\Models\UserRentPiso;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pisosPagina=Piso::paginate(6);
        $pisos=Piso::all();
        $fotos=Foto::all();

        return view('piso.index',compact('pisosPagina', 'pisos', 'fotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('piso.create');
    }

    /**
     * Store a newly created resource (piso y direccion) in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (strlen(trim($request->calle)) == 0 || strlen(trim($request->titulo)) == 0 || strlen(trim($request->descripcion)) == 0){
            return redirect()
                    ->back()
                    ->withInput($request->input())
                    ->withErrors(['Los campos no pueden tener solo espacios en blanco.', 'error']);
        }

        // Guardando dirección
        $direccion = new Direccion();

        $direccion->calle = $request->calle;
        $direccion->numero = $request->numero;
        $direccion->portal = $request->portal;
        $direccion->cod_postal = $request->cod_postal;
        
        if($request->comunidades != 0 && $request->provincias != 0){
            $direccion->comunidad = GeoApiController::getNombreComunidad($request->comunidades);
            $direccion->provincia = GeoApiController::getNombreProvincia($request->comunidades, $request->provincias);
            ($request->municipios != 0) ? $direccion->municipio = GeoApiController::getNombreMunicipio($request->provincias, $request->municipios) : null;
        }else{
            return redirect()
                    ->back()
                    ->withInput($request->input())
                    ->withErrors(['Debe seleccionar la comunidad y la provincia como mínimo.', 'error']);
        }

        $direccion->save();

        $coordenadas = GeocoderApiController::getCoordenadas($direccion);

        // Guardando piso
        $piso = new Piso();

        $piso->titulo = $request->titulo;

        if($coordenadas != null){
            $piso->longitud = $coordenadas['geometry']['lat'];
            $piso->latitud = $coordenadas['geometry']['lng'];
        }
        
        $piso->descripcion = $request->descripcion;
        $piso->num_habitaciones = $request->num_habitaciones;
        $piso->num_aseos = $request->num_aseos;
        $piso->m2 = $request->m2;
        $piso->sexo = $request->sexo;
        $piso->fumadores = $request->fumadores;
        $piso->animales = $request->animales;
        $piso->precio = $request->precio;
        $piso->user_id = $request->user_id;

        if($piso->save()){
            $direccion->piso_id = $piso->id;
            $direccion->update();
    
            // Guardando fotos multiples
            if($request->has('fotos')){
                $i = 0;
                foreach($request->file('fotos') as $file)
                {
                    $nombre = time().'_'.$i.'.'.$file->extension();
                    $file->storeAs('public/img/pisos', $nombre);
                    
                    $foto = new Foto();
                    $foto->nombre = $nombre;
                    $foto->piso_id = $piso->id;
                    $foto->save();
    
                    $i++;
                }
            }
            
            return redirect()->route('perfil.index')->with('informacion','Se ha creado correctamente.');
        }else{
            return redirect()->route('perfil.index')->with('error','No se ha podido dar de alta el piso.');
        }
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  Piso  $piso
     * @return \Illuminate\Http\Response
     */
    public function show(Piso $piso)
    {
        // BUSCAR EL USUARIO QUE ES PROPIETARIO
        $user_id = $piso->user_id;
        $arrendatario = User::find($user_id);
        
        // DIRECCIÓN
        $direccion = Direccion::where('piso_id', $piso->id)->get();
        
        // BUSCAR LOS USUARIOS INQUILINOS
        $inquilinos = DB::table('users')
                        ->join('user_rent_pisos','users.id', '=', 'user_rent_pisos.user_id')
                        ->where('user_rent_pisos.piso_id', '=', $piso->id)
                        ->get();
        $habitaciones_libres = $piso->num_habitaciones - sizeof($inquilinos);

        // ENVIAR LA INFORMACIÓN A VIEW SHOW
        return view('piso.show',compact('piso', 'direccion', 'arrendatario', 'inquilinos', 'habitaciones_libres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Piso  $piso
     * @return \Illuminate\Http\Response
     */
    public function edit(Piso $piso)
    {
        return view('piso.edit',compact('piso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $piso = Piso::find($request->id);

        $piso->titulo = $request->titulo;
        $piso->descripcion = $request->descripcion;
        $piso->num_habitaciones = $request->num_habitaciones;
        $piso->num_aseos = $request->num_aseos;
        $piso->m2 = $request->m2;
        $piso->precio = $request->precio;
        $piso->fumadores = $request->fumadores;
        $piso->animales = $request->animales;
        $piso->sexo = $request->sexo;
        
        $piso->update();

        return redirect()->route('perfil.index')->with('informacion','Se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Piso $piso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Piso $piso)
    {
        $direccion = Direccion::where('piso_id', '=', $piso->id);
        $piso->delete();
        $direccion->delete();
        return redirect()->route('perfil.index')->with('informacion','Se ha eliminado correctamente.');
    }
}
