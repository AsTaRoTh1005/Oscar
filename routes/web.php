<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\RepartidoraController;
use App\Http\Controllers\ContactoController;
//Ruta Predeterminada
Route::get('/', function () {
    return view('auth.login');
});

//  Rutas de inicio de sesión
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// GOOGLE RUTAS
Route::get('login/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//Rutas protegidas

Route::middleware('auth')->group(function () {
    
    
//Rutas de Cliente
Route::middleware('role:Cliente')->group(function () {
    Route::get('/cliente/home', [AuthController::class, 'clienteHome'])->name('clienteHome');
    Route::get('/cliente/productos', [ClienteController::class, 'productos'])->name('productos');
    Route::get('/cliente/sobre-nosotros', [ClienteController::class, 'sobreNosotros'])->name('sobreNosotros');

    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

    Route::post('/enviar-consulta', [ContactoController::class, 'enviarConsulta'])->name('enviar.consulta');
Route::get('/enviar-correo', [CorreoController::class, 'enviarCorreo']);
});

Route::middleware('role:Repartidora')->group(function () {
    Route::get('/repartidora/pedidos', [RepartidoraController::class, 'index'])->name('repartidora.pedidos');
    Route::put('/repartidora/pedidos/{id}/actualizar-estado', [RepartidoraController::class, 'actualizarEstado'])->name('repartidora.pedidos.actualizar-estado');
});




//Rutas de Administrador
Route::middleware('role:Administrador')->group(function () {
    Route::get('/admin/home', [AuthController::class, 'adminHome'])->name('adminHome');

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::get('/categorias/{id}', [CategoriaController::class, 'show'])->name('categoria.show');
    Route::put('/categorias/update/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('/categorias/delete/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');
    
// Rutas para proveedores
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedor.index');
    Route::post('/proveedores/store', [ProveedorController::class, 'store'])->name('proveedor.store');
    Route::get('/proveedores/{id}', [ProveedorController::class, 'show'])->name('proveedor.show');
    Route::put('/proveedores/update/{id}', [ProveedorController::class, 'update'])->name('proveedor.update');
    Route::delete('/proveedores/delete/{id}', [ProveedorController::class, 'destroy'])->name('proveedor.destroy');


// Rutas para Productos
    Route::get('/productos', [ProductoController::class, 'index'])->name('producto.index');
    Route::post('/productos/store', [ProductoController::class, 'store'])->name('producto.store');
    Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('producto.show');
    Route::put('/productos/update/{id}', [ProductoController::class, 'update'])->name('producto.update');
    Route::delete('/productos/delete/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

    });

// Rutas para usuarios
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
Route::post('/usuarios/store', [UserController::class, 'store'])->name('usuario.store');
Route::get('/usuarios/{id}', [UserController::class, 'show'])->name('usuario.show');
Route::put('/usuarios/update/{id}', [UserController::class, 'update'])->name('usuario.update');
Route::delete('/usuarios/delete/{id}', [UserController::class, 'destroy'])->name('usuario.destroy');

});
