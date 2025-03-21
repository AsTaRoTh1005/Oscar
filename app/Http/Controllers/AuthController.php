<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller {
    public function showLoginForm() {
        return view('auth.login'); 
    }
    public function showRegisterForm() {
        return view('auth.register'); 
    }

    public function adminHome() {
        return view('admin.adminHome');
    }

    public function clienteHome() {
        return view('cliente.clienteHome'); 
    }
    
    public function repartidoraHome() {
        return view('repartidora.repartidoraHome'); 
    }

    public function login(Request $request) {
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required'
        ]);
    
        $user = User::where('correo', $request->correo)->first();
    
        if ($user && Hash::check($request->contraseña, $user->password)) {
            Auth::login($user);
    
            switch ($user->rol) {
                case 'Administrador':
                    return redirect()->route('adminHome');
                case 'Repartidora':
                    return redirect()->route('repartidora.pedidos');
                case 'Cliente':
                    return redirect()->route('clienteHome');
                default:
                    // En caso de que el rol no esté definido
                    return redirect()->route('home')->withErrors([
                        'rol' => 'Rol no válido.',
                    ]);
            }
        }
    
        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no son válidas.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect()->route('login');
    }

    public function register(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidoP' => 'required|string|max:255',
            'apellidoM' => 'required|string|max:255',
            'correo' => 'required|email|unique:users,correo',
            'contraseña' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'apellidoP' => $request->apellidoP,
            'apellidoM' => $request->apellidoM,
            'correo' => $request->correo,
            'password' => Hash::make($request->contraseña), 
            'rol' => 'Cliente', 
        ]);

        Auth::login($user);

        $redirectTo = ($user->rol === 'Administrador') ? 'adminHome' : 'clienteHome';
        return redirect()->route($redirectTo);
    }
}