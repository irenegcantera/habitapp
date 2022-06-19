<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function show(Direccion $direccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $direccion = Direccion::find($id);
        return view('direccion.edit',compact('direccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (strlen(trim($request->calle)) == 0){
            return redirect()
                    ->back()
                    ->withInput($request->input())
                    ->withErrors(['Los campos no pueden tener solo espacios en blanco.', 'error']);
        } 

        $direccion = Direccion::find($request->id);

        $direccion->comunidad = $request->comunidades;
        $direccion->provincia = $request->provincias;
        $direccion->municipio = $request->municipios;
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
        
        $direccion->update();

        $piso = Piso::find($direccion->piso_id);

        $coordenadas = GeocoderApiController::getCoordenadas($direccion);

        $piso->latitud = $coordenadas['geometry']['lng'];
        $piso->longitud = $coordenadas['geometry']['lat'];

        $piso->update();

        return redirect()->route('perfil.index')->with('informacion','Se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Direccion $direccion)
    {
        //
    }
}
