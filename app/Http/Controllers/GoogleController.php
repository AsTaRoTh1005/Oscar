<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('correo', $googleUser->getEmail())->first();

        if (!$user) {
            $fullName = explode(' ', $googleUser->getName(), 3);
            $nombre = $fullName[0] ?? '';
            $apellidoP = $fullName[1] ?? '';
            $apellidoM = $fullName[2] ?? '';

            // Crear nuevo usuario
            $user = User::create([
                'nombre'     => $nombre,
                'apellidoP'  => $apellidoP,
                'apellidoM'  => $apellidoM,
                'correo'     => $googleUser->getEmail(),
                'google_id'  => $googleUser->getId(),
                'avatar'     => $googleUser->getAvatar(),
                'password'   => Hash::make(uniqid()), 
                'rol'        => 'Cliente', 
            ]);
        }
        Auth::login($user, true);

        return redirect()->route('clienteHome');
    }
}
