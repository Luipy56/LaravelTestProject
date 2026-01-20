<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Biblioteca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'file' => 'nullable|file|max:10240', // Max 10MB
        ]);

        $data = $request->all();
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('libros', $fileName, 'public');
            $data['file_path'] = $filePath;
        }

        Libro::create($data);
        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente');
    }

    public function show(string $id)
    {
        $libro = Libro::with('biblioteca')->findOrFail($id);
        return view('libros.show', compact('libro'));
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
            'file' => 'nullable|file|max:10240',
        ]);

        $libro = Libro::findOrFail($id);
        $data = $request->all();
        
        if ($request->hasFile('file')) {
            if ($libro->file_path && Storage::disk('public')->exists($libro->file_path)) {
                Storage::disk('public')->delete($libro->file_path);
            }
            
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('libros', $fileName, 'public');
            $data['file_path'] = $filePath;
        }

        $libro->update($data);
        return redirect()->route('libros.index')->with('success', 'Libro actualizado exitosamente');
    }

    public function destroy(string $id)
    {
        $libro = Libro::findOrFail($id);
        
        // Delete associated file if exists
        if ($libro->file_path && Storage::disk('public')->exists($libro->file_path)) {
            Storage::disk('public')->delete($libro->file_path);
        }
        
        $libro->delete();
        return redirect()->route('libros.index')->with('success', 'Libro eliminado exitosamente');
    }

    public function download(string $id)
    {
        $libro = Libro::findOrFail($id);
        
        if (!$libro->file_path || !Storage::disk('public')->exists($libro->file_path)) {
            return redirect()->route('libros.show', $id)->with('error', 'El archivo no existe');
        }
        
        return Storage::disk('public')->download($libro->file_path);
    }
}
