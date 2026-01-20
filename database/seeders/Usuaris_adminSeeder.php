<?php

namespace Database\Seeders;

use App\Models\Usuaris_admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Usuaris_adminSeeder extends Seeder
{
    public function run(): void
    {
        Usuaris_admin::create([
            'usuari' => 'Nombre1',
            'contraseña' => '1234',
        ]);
        Usuaris_admin::create([
            'usuari' => 'Nombre2',
            'contraseña' => '1234',
        ]);
        Usuaris_admin::create([
            'usuari' => 'admin',
            'contraseña' => 'admin',
        ]);
    }
}
