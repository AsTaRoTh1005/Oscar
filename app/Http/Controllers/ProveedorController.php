<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedores', compact('proveedores'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre_proveedor' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'nullable|email|max:100',
        ]);

        Proveedor::create($request->all());

        return redirect()->route('proveedor.index')->with('success', 'Proveedor creado exitosamente.');
    }

    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return response()->json($proveedor);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_proveedor' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'nullable|email|max:100',
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());

        return response()->json($proveedor);
    }

    public function destroy($id)
{
    // Buscar el proveedor por su ID
    $proveedor = Proveedor::findOrFail($id);

    // Verificar si el proveedor tiene productos asociados
    if ($proveedor->productos()->exists()) {
        // Si hay productos asociados, retornar un error
        return response()->json([
            'success' => false,
            'message' => 'No se puede eliminar el proveedor porque tiene productos asociados.',
        ], 422); // Código HTTP 422: Unprocessable Entity
    }

    // Si no hay productos asociados, eliminar el proveedor
    $proveedor->delete();

    return response()->json(['success' => true]);
}
}