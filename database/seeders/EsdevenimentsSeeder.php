<?php

namespace Database\Seeders;

use App\Models\Esdeveniment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EsdevenimentsSeeder extends Seeder
{
    public function run(): void
    {
        Esdeveniment::create([
            'nom' => 'Nombre 1',
            'descripcio' => 'Desc 1',
            'data' => '2026-1-10',
        ]);
        Esdeveniment::create([
            'nom' => 'Nombre 2',
            'descripcio' => 'Desc 2',
            'data' => '2026-1-12',
        ]);
        Esdeveniment::create([
            'nom' => 'Nombre 3',
            'descripcio' => 'Desc 3',
            'data' => '2026-1-11',
        ]);
    }
}
