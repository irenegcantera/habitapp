<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "direcciones";

    /**
     * Convert the model to its string representation.
     *
     * @return string
     */
    public function toString()
    {
        return $this->calle.", ".$this->numero.", ".$this->portal.", ".$this->cod_postal.", "
                .$this->municipio.", ".$this->provincia.", ".$this->comunidad;
    }


}


