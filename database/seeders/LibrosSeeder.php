<?php

namespace Database\Seeders;

use App\Models\Libro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Libro::create([
            'title' => 'El Quijote',
            'author' => 'Miguel de Cervantes',
            'biblioteca_id' => 1,
        ]);

        Libro::create([
            'title' => 'Cien años de soledad',
            'author' => 'Gabriel García Márquez',
            'biblioteca_id' => 1,
        ]);

        Libro::create([
            'title' => '1984',
            'author' => 'George Orwell',
            'biblioteca_id' => 2,
        ]);

        Libro::create([
            'title' => 'El Principito',
            'author' => 'Antoine de Saint-Exupéry',
            'biblioteca_id' => 2,
        ]);

        Libro::create([
            'title' => 'Don Juan Tenorio',
            'author' => 'José Zorrilla',
            'biblioteca_id' => 3,
        ]);
    }
}
