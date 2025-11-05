<?php

namespace App\Http\Controllers;

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
        return view('productos.index', compact('productos'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $productos = Categorias::all();
        $productos = Proveedor::all();
        $productos = Inventario::all();
        return view('productos.create', compact('productos','categoria', 'proveedor', 'nventario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    {
        Producto::create(
            $request->all()
        );
        return redirect()->route('productos.index')->with('success', 'producto creado correctamente');;
    }

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
    public function edit( $id)
    {
        $productos = Producto::findorFail($id);
        $categorias = Categorias::all();
        $proveedores = Proveedor::all();
        $inventario = Inventario::all();
        return view('productos.edit', compact('productos' , 'categorias','proveedores','inventario'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $productos = Producto::findorFail($id);
        $productos->update($request->all());
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy ($id)
    {
        
        $productos = Producto::findorFail($id);
        $productos->delete();
        return redirect()->route('productos.index')->with('success', 'producto Eliminado correctamente');
    }
}