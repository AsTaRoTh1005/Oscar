<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    
    // Método para guardar un pedido
    public function store(Request $request)
    {
        // Validar la cantidad
        $request->validate([
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Obtener el producto
        $producto = Producto::findOrFail($request->id_producto);

        // Verificar si hay suficiente stock
        if ($producto->stock < $request->cantidad) {
            return response()->json([
                'success' => false,
                'message' => 'No hay suficiente stock para este producto.',
            ], 400);
        }

        // Crear el pedido
        $pedido = Pedido::create([
            'id_usuario' => Auth::id(), // Asignar el usuario autenticado
            'fecha_pedido' => now(),
            'total' => $producto->precio * $request->cantidad,
            'estado' => 'Pendiente',
        ]);
/* 
        // Crear el detalle del pedido
        DetallePedido::create([
            'id_pedido' => $pedido->id_pedido,
            'id_producto' => $producto->id_producto,
            'cantidad' => $request->cantidad,
            'subtotal' => $producto->precio * $request->cantidad,
        ]);
 */
        $producto->stock -= $request->cantidad;
        $producto->save();

        return response()->json([
            'success' => true,
            'message' => 'Pedido realizado con éxito.',
        ]);
    }
}