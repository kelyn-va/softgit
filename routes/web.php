<?php

use App\Http\Controllers\AuditoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Auth;




//RUTA PRINCIPAL
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


//rutas para login
Route::get('/login',[usersController::class,'verlogin'])->name('login');
Route::post('/loginsubmit',[usersController::class,'login'])->name('login.submit');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

//RUTAS REGISTRO
Route::get('/registro', [usersController::class, 'verRegistro'])->name('registro');
Route::post('/registro-submit', [usersController::class, 'registro'])->name('registro.submit');



// -------------------- INVENTARIO --------------------
Route::get('/inventario/index', [InventarioController::class, 'index'])->name('inventario.index');
Route::get('/inventario/create', [InventarioController::class, 'create'])->name('inventario.create');
Route::post('/inventario/store', [InventarioController::class, 'store'])->name('inventario.store');
Route::post('/inventario/destroy/{id}', [InventarioController::class, 'destroy'])->name('inventario.destroy');
Route::get('/inventario/edit/{id}', [InventarioController::class, 'edit'])->name('inventario.edit');
Route::post('/inventario/update/{id}', [InventarioController::class, 'update'])->name('inventario.update');




// -------------------- CATEGORÍAS --------------------
Route::get('/categorias/index', [CategoriasController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
Route::post('/categorias/destroy/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
Route::get('/categorias/edit/{id}', [CategoriasController::class, 'edit'])->name('categorias.edit');
Route::post('/categorias/update/{id}', [CategoriasController::class, 'update'])->name('categorias.update');

// -------------------- PROVEEDORES --------------------

Route::get('/proveedor/index',[ProveedorController::class,'index'])->name('proveedor.index');
Route::get('/proveedor/create',[ProveedorController::class,'create'])->name('proveedor.create');
Route::post('/proveedor/store',[ProveedorController::class,'store'])->name('proveedor.store');
Route::post('/proveedor/destroy/{id}',[ProveedorController::class,'destroy'])->name('proveedor.destroy');
Route::get('/proveedor/edit/{id}',[ProveedorController::class,'edit'])->name('proveedor.edit');
Route::post('/proveedor/update/{id}',[ProveedorController::class,'update'])->name('proveedor.update');

// -------------------- PRODUCTOS --------------------

Route::get('/producto/index',[ProductoController::class,'index'])->name('productos.index');
Route::get('/producto/create',[ProductoController::class,'create'])->name('productos.create');
Route::post('/producto/store',[ProductoController::class,'store'])->name('productos.store');
Route::post('/producto/destroy/{id}',[ProductoController::class,'destroy'])->name('productos.destroy');
Route::get('/producto/edit/{id}',[ProductoController::class,'edit'])->name('productos.edit');
Route::post('/producto/update/{id}',[ProductoController::class,'update'])->name('productos.update');

// -------------------- VENTAS --------------------
Route::get('/ventas/index',[VentasController::class,'index'])->name('ventas.index');
Route::get('/ventas/create',[VentasController::class,'create'])->name('ventas.create');
Route::post('/ventas/store',[VentasController::class,'store'])->name('ventas.store');
Route::post('/ventas/destroy/{id}',[VentasController::class,'destroy'])->name('ventas.destroy');
Route::get('/ventas/edit/{id}',[VentasController::class,'edit'])->name('ventas.edit');
Route::post('/ventas/update/{id}',[VentasController::class,'update'])->name('ventas.update');
Route::resource('ventas', VentasController::class);

// -------------------- DETALLE VENTAS --------------------
Route::get('/DetalleVenta/index',[DetalleVentaController::class,'index'])->name('DetalleVenta.index');
Route::get('/DetalleVenta/create',[DetalleVentaController::class,'create'])->name('DetalleVenta.create');
Route::post('/DetalleVenta/store',[DetalleVentaController::class,'store'])->name('DetalleVenta.store');
Route::post('/DetalleVenta/destroy/{id}',[DetalleVentaController::class,'destroy'])->name('DetalleVenta.destroy');
Route::get('/DetalleVenta/edit/{id}',[DetalleVentaController::class,'edit'])->name('DetalleVenta.edit');
Route::post('/DetalleVenta/update/{id}',[DetalleVentaController::class,'update'])->name('DetalleVenta.update');


// -------------------- EMPLEADOS --------------------

Route::get('/empleados/index',[EmpleadoController::class,'index'])->name('empleados.index');
Route::get('/empleados/create',[EmpleadoController::class,'create'])->name('empleados.create');
Route::post('/empleados/store',[EmpleadoController::class,'store'])->name('empleados.store');
Route::post('/empleados/destroy/{id}',[EmpleadoController::class,'destroy'])->name('empleados.destroy');
Route::get('/empleados/edit/{id}',[EmpleadoController::class,'edit'])->name('empleados.edit');
Route::post('/empleados/update/{id}',[EmpleadoController::class,'update'])->name('empleados.update');


