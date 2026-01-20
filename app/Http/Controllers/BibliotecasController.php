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

    public function show(Request $request, string $id)
    {
        $biblioteca = Biblioteca::findOrFail($id);
        $search = $request->query('search');
        
        $libros = $biblioteca->libros()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('author', 'like', "%{$search}%");
            })
            ->get();
        
        $biblioteca->setRelation('libros', $libros);
        
        return view('bibliotecas.show', compact('biblioteca', 'search'));
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

    public function exportLibros(Request $request, string $id)
    {
        $biblioteca = Biblioteca::findOrFail($id);
        $search = $request->query('search');
        
        $libros = $biblioteca->libros()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('author', 'like', "%{$search}%");
            })
            ->get();
        
        $filename = 'libros_' . $biblioteca->name . '_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($libros) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Título', 'Autor', 'Archivo']);
            
            foreach ($libros as $libro) {
                fputcsv($file, [
                    $libro->id,
                    $libro->title,
                    $libro->author,
                    $libro->file_path ? 'Sí' : 'No'
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function publicIndex()
    {
        $bibliotecas = Biblioteca::all();
        return view('bibliotecas.public-index', compact('bibliotecas'));
    }

    public function publicShow(Request $request, string $id)
    {
        $biblioteca = Biblioteca::findOrFail($id);
        $search = $request->query('search');
        
        $libros = $biblioteca->libros()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('author', 'like', "%{$search}%");
            })
            ->get();
        
        $biblioteca->setRelation('libros', $libros);
        
        return view('bibliotecas.public-show', compact('biblioteca', 'search'));
    }
}
