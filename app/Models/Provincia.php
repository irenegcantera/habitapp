<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'provinciasid';

    public function comunidades(){
        return $this->belongsTo('App\Models\Comunidad');
    }

    public function municipios(){
        return $this->hasMany('App\Models\Municipio');
    }
}
