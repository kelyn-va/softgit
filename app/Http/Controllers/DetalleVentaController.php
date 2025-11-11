<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\ventas;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalleVenta = DetalleVenta::all();
        return view('DetalleVenta.index', compact('detalleVenta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ventas = ventas::all();        
        $productos = Producto::all();
        return view('DetalleVenta.create', compact('ventas', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DetalleVenta::create(
            $request->all()
        );
        return redirect()->route('DetalleVenta.index')->with('success', 'Detalle de Venta creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $detalleVenta = DetalleVenta::findorfail($id);
        $productos = Producto::all();

            $ventas= ventas::all();
        return view('DetalleVenta.edit', compact('detalleVenta','ventas','productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $detalleVenta = DetalleVenta::findorfail($id);
        $detalleVenta->update($request->all());
        return redirect()->route('DetalleVenta.index')->with('success', 'Detalle de Venta Actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detalleVenta = DetalleVenta::findorfail($id);
        $detalleVenta->delete();
        return redirect()->route('DetalleVenta.index')->with('success', 'Venta eliminada correctamente.');
    }
        
    }
