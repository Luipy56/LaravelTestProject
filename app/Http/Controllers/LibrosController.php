<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Biblioteca;
use Illuminate\Http\Request;

class LibrosController extends Controller
{
    public function index()
    {
        $libros = Libro::with('biblioteca')->get();
        return view('libros.index', compact('libros'));
    }

    public function create()
    {
        $bibliotecas = Biblioteca::all();
        return view('libros.create', compact('bibliotecas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'biblioteca_id' => 'required|exists:bibliotecas,id',
        ]);

        Libro::create($request->all());
        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente');
    }

    public function show(string $id)
    {
        $biblioteca = Biblioteca::with('libros')->findOrFail($id);
        return view('libros.show', compact('biblioteca'));
    }

    public function edit(string $id)
    {
        $libro = Libro::findOrFail($id);
        $bibliotecas = Biblioteca::all();
        return view('libros.edit', compact('libro', 'bibliotecas'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'biblioteca_id' => 'required|exists:bibliotecas,id',
        ]);

        $libro = Libro::findOrFail($id);
        $libro->update($request->all());
        return redirect()->route('libros.index')->with('success', 'Libro actualizado exitosamente');
    }

    public function destroy(string $id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();
        return redirect()->route('libros.index')->with('success', 'Libro eliminado exitosamente');
    }
}
