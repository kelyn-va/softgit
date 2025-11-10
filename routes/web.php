<?php

use App\Http\Controllers\AuditoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentasController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Ruta alternativa para home (AdminLTE a veces la busca)
Route::get('/home', function () {
    return redirect()->route('welcome');
})->name('home');

// -------------------- INVENTARIO --------------------
Route::get('/inventario/index', [InventarioController::class, 'index'])->name('inventario.index');
Route::get('/inventario/create', [InventarioController::class, 'create'])->name('inventario.create');
Route::post('/inventario/store', [InventarioController::class, 'store'])->name('inventario.store');
Route::post('/inventario/destroy/{id}', [InventarioController::class, 'destroy'])->name('inventario.destroy');
Route::get('/inventario/edit/{id}', [InventarioController::class, 'edit'])->name('inventario.edit');
Route::post('/inventario/update/{id}', [InventarioController::class, 'update'])->name('inventario.update');

// -------------------- TURNOS --------------------
Route::get('/turnos/index', [TurnoController::class, 'index'])->name('turnos.index');
Route::get('/turnos/create', [TurnoController::class, 'create'])->name('turnos.create');
Route::post('/turnos/store', [TurnoController::class, 'store'])->name('turnos.store');
Route::post('/turnos/destroy/{id}', [TurnoController::class, 'destroy'])->name('turnos.destroy');
Route::get('/turnos/edit/{id}', [TurnoController::class, 'edit'])->name('turnos.edit');
Route::post('/turnos/update/{id}', [TurnoController::class, 'update'])->name('turnos.update');

// -------------------- CLIENTES --------------------
Route::get('/clientes/index', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');
Route::post('/clientes/destroy/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::get('/clientes/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::post('/clientes/update/{id}', [ClienteController::class, 'update'])->name('clientes.update');

// -------------------- CATEGORÍAS --------------------
Route::get('/categorias/index', [CategoriasController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
Route::post('/categorias/destroy/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
Route::get('/categorias/edit/{id}', [CategoriasController::class, 'edit'])->name('categorias.edit');
Route::post('/categorias/update/{id}', [CategoriasController::class, 'update'])->name('categorias.update');

//rutas de proveedor

Route::get('/proveedor/index',[ProveedorController::class,'index'])->name('proveedor.index');
Route::get('/proveedor/create',[ProveedorController::class,'create'])->name('proveedor.create');
Route::post('/proveedor/store',[ProveedorController::class,'store'])->name('proveedor.store');
Route::post('/proveedor/destroy/{id}',[ProveedorController::class,'destroy'])->name('proveedor.destroy');
Route::get('/proveedor/edit/{id}',[ProveedorController::class,'edit'])->name('proveedor.edit');
Route::post('/proveedor/update/{id}',[ProveedorController::class,'update'])->name('proveedor.update');

//rutas de producto

Route::get('/producto/index',[ProductoController::class,'index'])->name('productos.index');
Route::get('/producto/create',[ProductoController::class,'create'])->name('productos.create');
Route::post('/producto/store',[ProductoController::class,'store'])->name('productos.store');
Route::post('/producto/destroy/{id}',[ProductoController::class,'destroy'])->name('productos.destroy');
Route::get('/producto/edit/{id}',[ProductoController::class,'edit'])->name('productos.edit');
Route::post('/producto/update/{id}',[ProductoController::class,'update'])->name('productos.update');

//rutas de empleado

Route::get('/empleado/index',[EmpleadoController::class,'index'])->name('empleados.index');
Route::get('/empleado/create',[EmpleadoController::class,'create'])->name('empleados.create');
Route::post('/empleado/store',[EmpleadoController::class,'store'])->name('empleados.store');
Route::post('/empleado/destroy/{id}',[EmpleadoController::class,'destroy'])->name('empleados.destroy');
Route::get('/empleado/edit/{id}',[EmpleadoController::class,'edit'])->name('empleados.edit');
Route::post('/empleado/update/{id}',[EmpleadoController::class,'update'])->name('empleados.update');

// -------------------- AUDITORÍAS --------------------
Route::get('/Auditoria/index',[AuditoriaController::class,'index'])->name('Auditoria.index');
Route::get('/Auditoria/create',[AuditoriaController::class,'create'])->name('Auditoria.create');
Route::post('/Auditoria/store',[AuditoriaController::class,'store'])->name('Auditoria.store');
Route::post('/Auditoria/destroy/{id}',[AuditoriaController::class,'destroy'])->name('Auditoria.destroy');
Route::get('/Auditoria/edit/{id}',[AuditoriaController::class,'edit'])->name('Auditoria.edit');
Route::post('/Auditoria/update/{id}',[AuditoriaController::class,'update'])->name('Auditoria.update');

// -------------------- MÉTODOS DE PAGO --------------------

Route::get('/metodoPago/index',[MetodoPagoController::class,'index'])->name('metodoPago.index');
Route::get('/metodoPago/create',[MetodoPagoController::class,'create'])->name('metodoPago.create');
Route::post('/metodoPago/store',[MetodoPagoController::class,'store'])->name('metodoPago.store');
Route::post('/metodoPago/destroy/{id}',[MetodoPagoController::class,'destroy'])->name('metodoPago.destroy');
Route::get('/metodoPago/edit/{id}',[MetodoPagoController::class,'edit'])->name('metodoPago.edit');
Route::post('/metodoPago/update/{id}',[MetodoPagoController::class,'update'])->name('metodoPago.update');

// -------------------- VENTAS --------------------
Route::get('/ventas/index',[VentasController::class,'index'])->name('ventas.index');
Route::get('/ventas/create',[VentasController::class,'create'])->name('ventas.create');
Route::post('/ventas/store',[VentasController::class,'store'])->name('ventas.store');
Route::post('/ventas/destroy/{id}',[VentasController::class,'destroy'])->name('ventas.destroy');
Route::get('/ventas/edit/{id}',[VentasController::class,'edit'])->name('ventas.edit');
Route::post('/ventas/update/{id}',[VentasController::class,'update'])->name('ventas.update');

