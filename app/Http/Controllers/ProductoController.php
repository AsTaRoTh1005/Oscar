<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'proveedor'])->get();
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('admin.productos', compact('productos', 'categorias', 'proveedores'));
    }

    public function store(Request $request): JsonResponse
{
    $request->validate([
        'nombre' => 'required|string|max:150',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación para la imagen
        'id_categoria' => 'required|exists:categorias,id_categoria',
        'id_proveedor' => 'required|exists:proveedores,id_proveedor',
    ]);

    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('productos', 'public'); 
    } else {
        $imagenPath = null; 
    }

    $producto = Producto::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'imagen' => $imagenPath, 
        'id_categoria' => $request->id_categoria,
        'id_proveedor' => $request->id_proveedor,
    ]);

    return response()->json($producto);
}

    public function show($id): JsonResponse
    {
        $producto = Producto::with(['categoria', 'proveedor'])->findOrFail($id);
        return response()->json($producto);
    }

    public function update(Request $request, $id): JsonResponse
{
    $request->validate([
        'nombre' => 'required|string|max:150',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        'id_categoria' => 'required|exists:categorias,id_categoria',
        'id_proveedor' => 'required|exists:proveedores,id_proveedor',
    ]);

    $producto = Producto::findOrFail($id);

    if ($request->hasFile('imagen')) {
        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $imagenPath = $request->file('imagen')->store('productos', 'public');
        $producto->imagen = $imagenPath;
    }

    $producto->nombre = $request->nombre;
    $producto->descripcion = $request->descripcion;
    $producto->precio = $request->precio;
    $producto->stock = $request->stock;
    $producto->id_categoria = $request->id_categoria;
    $producto->id_proveedor = $request->id_proveedor;

    $producto->save();

    return response()->json($producto);
}
    public function destroy($id): JsonResponse
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json(['success' => true]);
    }
}