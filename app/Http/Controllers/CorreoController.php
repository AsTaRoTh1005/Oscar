<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class CorreoController extends Controller
{
    public function enviarCorreo()
    {
        $data = [
            'titulo' => 'Bienvenido a nuestra aplicación',
            'mensaje' => 'Gracias por registrarte en nuestro sitio.'
        ];

        Mail::to('destinatario@example.com')->send(new EnviarCorreo($data));

        return "Correo enviado correctamente";
    }
}
