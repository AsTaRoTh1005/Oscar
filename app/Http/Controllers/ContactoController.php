<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConsultaMail;

class ContactoController extends Controller
{
    public function enviarConsulta(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'mensaje' => 'required|string',
        ]);

        // Datos del formulario
        $data = [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'mensaje' => $request->mensaje,
        ];

        // Enviar el correo
        Mail::to('22610201@gmail.com')->send(new ConsultaMail($data));

        // Redireccionar con un mensaje de éxito
        return redirect()->back()->with('success', 'Tu mensaje ha sido enviado correctamente.');
    }
}
