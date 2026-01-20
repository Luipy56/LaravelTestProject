<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = ['title', 'author', 'biblioteca_id', 'file_path'];

    public function biblioteca()
    {
        return $this->belongsTo(Biblioteca::class);
    }
}
