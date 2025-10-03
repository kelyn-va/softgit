<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\TurnoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//rutas de inventario

Route::get('/inventario/index',[InventarioController::class,'index'])->name('inventario.index');
Route::get('/inventario/create',[InventarioController::class,'create'])->name('inventario.create');
Route::post('/inventario/store',[InventarioController::class,'store'])->name('inventario.store');
Route::post('/inventario/destroy/{id}',[InventarioController::class,'destroy'])->name('inventario.destroy');
Route::get('/inventario/edit/{id}',[InventarioController::class,'edit'])->name('inventario.edit');
Route::post('/inventario/update/{id}',[InventarioController::class,'update'])->name('inventario.update');


//rutas de turnos

Route::get('/turnos/index',[TurnoController::class,'index'])->name('turno.index');
Route::get('/turnos/create',[TurnoController::class,'create'])->name('turno.create');
Route::post('/turnos/store',[TurnoController::class,'store'])->name('turno.store');
Route::post('/turnos/destroy/{id}',[TurnoController::class,'destroy'])->name('turno.destroy');
Route::get('/turnos/edit/{id}',[TurnoController::class,'edit'])->name('turno.edit');
Route::post('/turnos/update/{id}',[TurnoController::class,'update'])->name('turno.update');


//rutas  de clientes

Route::get('/clientes/index',[ClienteController::class,'index'])->name('Cliente.index');
Route::get('/clientes/create',[ClienteController::class,'create'])->name('Cliente.create');
Route::post('/clientes/store',[ClienteController::class,'store'])->name('Cliente.store');
Route::post('/clientes/destroy/{id}',[ClienteController::class,'destroy'])->name('Cliente.destroy');
Route::get('/clientes/edit/{id}',[ClienteController::class,'edit'])->name('Cliente.edit');
Route::post('/clientes/update/{id}',[ClienteController::class,'update'])->name('Cliente.update');



// rutas categorias
Route::get('/categorias/index',[CategoriasController::class,'index'])->name('categorias.index');
Route::get('/categorias/create',[CategoriasController::class,'create'])->name('categorias.create');
Route::post('/categorias/store',[CategoriasController::class,'store'])->name('categorias.store');
Route::post('/categorias/destroy/{id}',[CategoriasController::class,'destroy'])->name('categorias.destroy');
Route::get('/categorias/edit/{id}',[CategoriasController::class,'edit'])->name('categorias.edit');
Route::post('/categorias/update/{id}',[CategoriasController::class,'update'])->name('categorias.update');

