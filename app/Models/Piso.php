<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "id", "longitud", "latitud",
        "titulo", "descripcion", "num_habitaciones",
        "num_aseos", "m2", "sexo", "fumadores", 
        "animales", "precio", "user_id"
    ];


    public static function create($collection)
    {
        $piso = new Piso();
        
        $piso->id = $collection->id;
        $piso->longitud = $collection->longitud;
        $piso->latitud = $collection->latitud;
        $piso->titulo = $collection->titulo;

        $piso->descripcion = $collection->descripcion;
        $piso->num_habitaciones = $collection->num_habitaciones;
        $piso->num_aseos = $collection->num_aseos;
        $piso->m2 = $collection->m2;
        $piso->sexo = $collection->sexo;
        $piso->fumadores = $collection->fumadores;

        $piso->animales = $collection->animales;
        $piso->precio = $collection->precio;
        $piso->created_at = $collection->created_at;
        $piso->updated_at = $collection->updated_at;
        $piso->user_id = $collection->user_id;

        return $piso;
    }



    public function users(){
        return $this->belongsTo('App\Models\User');
    }

    public function fotos(){
        return $this->hasMany('App\Models\Foto');
    }

    public function usersRent()
    {
        return $this->belongsToMany('App\Models\User','user_rent_pisos','user_id','piso_id');
    }
}
