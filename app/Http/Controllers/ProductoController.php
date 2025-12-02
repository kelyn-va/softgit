<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Categorias;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $productos = Producto::all();

   
    $categorias = Categorias::all();
    $proveedores = Proveedor::all();

    return view('Producto.index', compact('productos', 'categorias', 'proveedores'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $categorias = Categorias::all();
        $proveedores = Proveedor::all();
       
        return view('Producto.create', compact('productos','categorias', 'proveedores', ));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(ProductoRequest $request)
{
   Producto::create($request->all());
    return redirect()->route('productos.index')->with('success', 'producto creado correctamente.');
}

    

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $productos = Producto::findOrFail($id);
    $categorias = Categorias::all();
    $proveedores = Proveedor::all();

    return view('Producto.edit', compact('productos', 'categorias', 'proveedores'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, $id)
{
    $producto = Producto::findOrFail($id);

    $producto->update($request->all());

    return redirect()->route('productos.index')
        ->with('success', 'Producto actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy ($id)
    {
        
        $productos = Producto::findOrFail($id);
        $productos->delete();
        return redirect()->route('productos.index')->with('success', 'producto Eliminado correctamente');
    }
}