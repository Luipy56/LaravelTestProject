<?php

namespace App\Http\Controllers;

use App\Models\Esdeveniment;
use Illuminate\Http\Request;

class EsdevenimentsController extends Controller
{
    public function publicIndex()
    {
        $eventos = Esdeveniment::all();
        return view('esdeveniments.public-index', compact('eventos'));
    }
}
