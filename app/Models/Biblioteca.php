<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biblioteca extends Model
{
    protected $fillable = ['name', 'address'];

    public function libros()
    {
        return $this->hasMany(Libro::class);
    }
}
