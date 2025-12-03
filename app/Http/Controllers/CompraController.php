<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use PhpParser\Node\ComplexType;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::all();
        $proveedores = Proveedor::all();
        return view('compras.index', compact('compras', 'proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $compras = Compra::all();
        
        $proveedores = Proveedor::all();
        return view('compras.create', compact('compras', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Compra::create(
                $request->all());
                return redirect()->route('compras.index')->with('success', 'compra creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $id)
    {
        $compra = Compra::findorFail($id);
        $proveedores = Proveedor::all();
        return view('compras.edit', compact('compra' , 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $compra = Compra::findorFail($id);
        $compra->update($request->all());
        return redirect()->route('compras.index');
    }
    /**
     * Remove the specified resource from storage.
     */ 
     public function destroy( $id)
    {
        $compras = Compra::findorFail($id);
        $compras->delete();
        return redirect()->route('compras.index')->with('success', 'compra  Eliminada correctamente');
    }
    }

    
   

     