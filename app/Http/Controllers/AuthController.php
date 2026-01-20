<?php

namespace App\Http\Controllers;

use App\Models\Usuaris_admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'usuari' => $request->input('usuari'),
            'contraseña' => $request->input('contraseña'),
        ];

        $usuario = Usuaris_admin::where('usuari', $credentials['usuari'])->first();

        if ($usuario && $usuario->contraseña === $credentials['contraseña']) {
            $request->session()->regenerate();
            $request->session()->put('usuari_admin_id', $usuario->id);
            $request->session()->put('usuari_admin_nom', $usuario->usuari);
            return redirect()->route('inscripcions.index');
        }

        return back()->withErrors([
            'usuari' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('usuari');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('usuari_admin_id');
        $request->session()->forget('usuari_admin_nom');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
