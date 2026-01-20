<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Esdeveniment extends Model
{
    public function inscripcions()
    {
        return $this->hasMany(Inscripcio::class, 'id_esdeveniment');
    }
}
