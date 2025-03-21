<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categorias', compact('categorias'));
    }
    public function store(Request $request): JsonResponse
    {
        $categoria = Categoria::create([
            'nombre_categoria' => $request->nombre_categoria,
        ]);

        return response()->json($categoria);
    }
    public function show($id): JsonResponse
    {
        $categoria = Categoria::findOrFail($id);
        return response()->json($categoria);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'nombre_categoria' => $request->nombre_categoria,
        ]);

        return response()->json($categoria);
    }

    public function destroy($id): JsonResponse
{
    $categoria = Categoria::findOrFail($id);

    if ($categoria->productos()->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'No se puede eliminar la categoría porque tiene productos asociados.',
        ], 422); 
    }

    $categoria->delete();

    return response()->json(['success' => true]);
}
}