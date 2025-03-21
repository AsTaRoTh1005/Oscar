<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function clienteHome()
    {
        return view('cliente.clienteHome');
    }

    public function productos()
    {
        $productos = Producto::all();
        return view('cliente.productos', compact('productos'));
    }

    public function sobreNosotros()
    {
        return view('cliente.sobre-nosotros');
    }
}