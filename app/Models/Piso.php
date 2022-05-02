<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo('App\Models\User');
    }

    public function fotos(){
        return $this->hasMany('App\Models\Foto');
    }

    public function user_rent_pisos(){
        return $this->hasMany('App\Models\UserRentPiso');
    }
}
