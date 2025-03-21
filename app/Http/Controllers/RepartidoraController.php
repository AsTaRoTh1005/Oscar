<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class RepartidoraController extends Controller
{
    // Método para mostrar la lista de pedidos
    public function index()
    {
        // Obtener todos los pedidos con la relación de usuario
        $pedidos = Pedido::with('usuario')->get();

        // Pasar los pedidos a la vista repartidoraHome
        return view('repartidora.repartidoraHome', compact('pedidos'));
    }

    // Método para actualizar el estado de un pedido
    public function actualizarEstado(Request $request, $id)
    {
        // Validar el nuevo estado
        $request->validate([
            'estado' => 'required|in:Pendiente,Enviado,Entregado',
        ]);

        // Buscar el pedido por su ID
        $pedido = Pedido::findOrFail($id);

        // Actualizar el estado del pedido
        $pedido->estado = $request->estado;
        $pedido->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado con éxito.',
        ]);
    }
}