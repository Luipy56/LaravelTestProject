<?php

namespace App\Http\Controllers;

use App\Models\Esdeveniment;
use App\Models\Inscripcio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EsdevenimentsController extends Controller
{
    public function publicIndex()
    {
        $esdeveniments = Esdeveniment::all();
        return view('esdeveniments.public-index', compact('esdeveniments'));
    }

    public function inscripcions(Request $request)
    {
        $query = Inscripcio::with('esdeveniment');
        
        $nomEsdeveniment = $request->get('nom_esdeveniment');
        $data = $request->get('data');
        
        if ($nomEsdeveniment && $data) {
            $query->whereHas('esdeveniment', function($q) use ($nomEsdeveniment, $data) {
                $q->where('nom', 'like', '%' . $nomEsdeveniment . '%')
                  ->where('data', $data);
            });
        } elseif ($nomEsdeveniment) {
            $query->whereHas('esdeveniment', function($q) use ($nomEsdeveniment) {
                $q->where('nom', 'like', '%' . $nomEsdeveniment . '%');
            });
        } elseif ($data) {
            $query->whereHas('esdeveniment', function($q) use ($data) {
                $q->where('data', $data);
            });
        }
        
        $inscripcions = $query->get();
        
        return view('inscripcions.index', compact('inscripcions', 'nomEsdeveniment', 'data'));
    }
    
    public function createInscripcio(Request $request)
    {
        $esdeveniments = Esdeveniment::all();
        $selectedEsdevenimentId = $request->get('esdeveniment');
        $selectedEsdeveniment = null;
        
        if ($selectedEsdevenimentId) {
            $selectedEsdeveniment = Esdeveniment::find($selectedEsdevenimentId);
        }
        
        return view('inscripcions.create', compact('esdeveniments', 'selectedEsdeveniment'));
    }
    
    public function storeInscripcio(Request $request)
    {
        $nom = $request->input('nom');
        $email = $request->input('email');
        $id_esdeveniment = $request->input('id_esdeveniment');
        $file = $request->file('fitxer');
        
        $existingInscripcio = Inscripcio::where('email', $email)
            ->where('id_esdeveniment', $id_esdeveniment)
            ->first();
        
        if ($existingInscripcio) {
            return back()->withErrors([
                'email' => 'Ya existe una inscripción con este email para este evento.',
            ])->withInput();
        }
        
        $esdeveniment = Esdeveniment::findOrFail($id_esdeveniment);
        $extension = $file->getClientOriginalExtension();
        $fileName = $email . '.' . $id_esdeveniment . '.' . $extension;
        
        $file->storeAs('public/inscripcions', $fileName);
        
        Inscripcio::create([
            'nom' => $nom,
            'email' => $email,
            'id_esdeveniment' => $id_esdeveniment,
            'fitxer' => $fileName,
        ]);
        
        return redirect()->route('esdeveniments.index')->with('success', 'Inscripción realizada con éxito');
    }
    
    public function downloadFitxer($id)
    {
        $inscripcio = Inscripcio::findOrFail($id);
        $filePath = 'public/inscripcions/' . $inscripcio->fitxer;
        
        if (!Storage::exists($filePath)) {
            abort(404, 'Archivo no encontrado');
        }
        
        return Storage::download($filePath, $inscripcio->fitxer);
    }
}
