<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    /**
     * Muestra una lista de todos los detalles de pedido.
     */
    public function index()
    {
        $detalles = DetallePedido::with(['pedido', 'producto'])->get();
        return response()->json($detalles);
    }

    /**
     * Muestra los detalles de un pedido específico.
     */
    public function show($id)
    {
        $detalle = DetallePedido::with(['pedido', 'producto'])->findOrFail($id);
        return response()->json($detalle);
    }

    /**
     * Almacena un nuevo detalle de pedido.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pedido' => 'required|exists:pedidos,id_pedido',
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $detalle = DetallePedido::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Detalle de pedido creado con éxito.',
            'data' => $detalle,
        ], 201);
    }

    /**
     * Actualiza un detalle de pedido existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pedido' => 'sometimes|exists:pedidos,id_pedido',
            'id_producto' => 'sometimes|exists:productos,id_producto',
            'cantidad' => 'sometimes|integer|min:1',
            'subtotal' => 'sometimes|numeric|min:0',
        ]);

        $detalle = DetallePedido::findOrFail($id);
        $detalle->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Detalle de pedido actualizado con éxito.',
            'data' => $detalle,
        ]);
    }

    /**
     * Elimina un detalle de pedido.
     */
    public function destroy($id)
    {
        $detalle = DetallePedido::findOrFail($id);
        $detalle->delete();

        return response()->json([
            'success' => true,
            'message' => 'Detalle de pedido eliminado con éxito.',
        ]);
    }
}