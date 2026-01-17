<?php

namespace Database\Seeders;

use App\Models\Biblioteca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BibliotecasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Biblioteca::create([
            'name' => 'Biblioteca Central',
            'address' => 'Calle Principal 123',
        ]);

        Biblioteca::create([
            'name' => 'Biblioteca del Norte',
            'address' => 'Avenida Norte 456',
        ]);

        Biblioteca::create([
            'name' => 'Biblioteca del Sur',
            'address' => 'Boulevard Sur 789',
        ]);
    }
}
