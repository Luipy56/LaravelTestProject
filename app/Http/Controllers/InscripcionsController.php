<?php

namespace App\Http\Controllers;

use App\Models\Esdeveniment;
use App\Models\Inscripcio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InscripcionsController extends Controller
{
    public function index(Request $request)
    {
        $nombreEvento = $request->get('nom_esdeveniment');
        $fecha = $request->get('data');
        
        $query = Inscripcio::with('esdeveniment');
        
        if ($nombreEvento || $fecha) {
            $eventosQuery = Esdeveniment::query();
            
            if ($nombreEvento) {
                $eventosQuery->where('nom', 'like', '%' . $nombreEvento . '%');
            }
            
            if ($fecha) {
                $eventosQuery->where('data', $fecha);
            }
            
            $eventosIds = $eventosQuery->pluck('id');
            $query->whereIn('id_esdeveniment', $eventosIds);
        }
        
        $inscripciones = $query->get();
        
        return view('inscripcions.index', compact('inscripciones', 'nombreEvento', 'fecha'));
    }
    
    public function create(Request $request)
    {
        $eventos = Esdeveniment::all();
        $eventoSeleccionadoId = $request->get('esdeveniment');
        
        if ($eventoSeleccionadoId) {
            $eventoSeleccionado = Esdeveniment::find($eventoSeleccionadoId);
        }
        
        return view('inscripcions.create', compact('eventos', 'eventoSeleccionado'));
    }
    
    public function store(Request $request)
    {
        $nombre = $request->input('nom');
        $email = $request->input('email');
        $id_esdeveniment = $request->input('id_esdeveniment');
        $archivo = $request->file('fitxer');
        
        $inscripcionExistente = Inscripcio::where('email', $email)
            ->where('id_esdeveniment', $id_esdeveniment)
            ->first();
        
        if ($inscripcionExistente) {
            return back()->withErrors([
                'email' => 'Ya existe una inscripción con este email para este evento.',
            ])->withInput();
        }
        
        $evento = Esdeveniment::findOrFail($id_esdeveniment);
        $extension = $archivo->getClientOriginalExtension();
        $nombreArchivo = $email . '.' . $id_esdeveniment . '.' . $extension;
        
        $archivo->storeAs('public/inscripcions', $nombreArchivo);
        
        Inscripcio::create([
            'nom' => $nombre,
            'email' => $email,
            'id_esdeveniment' => $id_esdeveniment,
            'fitxer' => $nombreArchivo,
        ]);
        
        return redirect()->route('esdeveniments.index');
    }
    
    public function download($id)
    {
        $inscripcion = Inscripcio::findOrFail($id);
        $rutaArchivo = 'public/inscripcions/' . $inscripcion->fitxer;
        
        if (!Storage::exists($rutaArchivo)) {
            abort(404, 'Archivo no encontrado');
        }
        
        return Storage::download($rutaArchivo, $inscripcion->fitxer);
    }
}
