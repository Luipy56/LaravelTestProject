<?php

namespace App\Http\Controllers;

use App\Models\Biblioteca;
use Illuminate\Http\Request;

class BibliotecasController extends Controller
{
    public function index()
    {
        $bibliotecas = Biblioteca::all();
        return view('bibliotecas.index', compact('bibliotecas'));
    }

    public function create()
    {
        return view('bibliotecas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        Biblioteca::create($request->all());
        return redirect()->route('bibliotecas.index')->with('success', 'Biblioteca creada exitosamente');
    }

    public function show(string $id)
    {
        $biblioteca = Biblioteca::with('libros')->findOrFail($id);
        return view('bibliotecas.show', compact('biblioteca'));
    }

    public function edit(string $id)
    {
        $biblioteca = Biblioteca::findOrFail($id);
        return view('bibliotecas.edit', compact('biblioteca'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $biblioteca = Biblioteca::findOrFail($id);
        $biblioteca->update($request->all());
        return redirect()->route('bibliotecas.index')->with('success', 'Biblioteca actualizada exitosamente');
    }

    public function destroy(string $id)
    {
        $biblioteca = Biblioteca::findOrFail($id);
        $biblioteca->delete();
        return redirect()->route('bibliotecas.index')->with('success', 'Biblioteca eliminada exitosamente');
    }
}
