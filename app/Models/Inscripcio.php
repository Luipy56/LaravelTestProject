<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcio extends Model
{
    protected $table = 'inscripcions';
    
    public $timestamps = false;
    
    protected $fillable = [
        'nom',
        'email',
        'fitxer',
        'id_esdeveniment',
    ];
    
    public function esdeveniment()
    {
        return $this->belongsTo(Esdeveniment::class, 'id_esdeveniment');
    }
}
