<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Empleado;
use App\Models\ventas;
use App\Models\Producto;
use Illuminate\Http\Request;


class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = ventas::with('empleado', 'producto')->get();
        return view('ventas.index', compact('ventas'));
    }

    // 🟦 Formulario de creación
    public function create()
    {
        $empleados = Empleado::all();
        $productos = Producto::all();

        return view('ventas.create', compact('empleados', 'productos'));
    }

    // 🟦 Guardar nueva venta
    public function store(Request $request)
    {
        $request->validate([
            'metodo_pago' => 'required',
            'idempleado' => 'required|exists:empleados,id',
            'idproducto' => 'required|exists:productos,id'
        ]);

        // Obtener precio del producto automáticamente
        $producto = Producto::findOrFail($request->idproducto);

        ventas::create([
            'total' => $producto->precio,
            'metodo_pago' => $request->metodo_pago,
            'idempleado' => $request->idempleado,
            'idproducto' => $request->idproducto
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');
    }
    /**
     * Show the form for creating a new resource.
     */
   
    /**
     * Display the specified resource.
     */
    public function show(ventas $ventas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
     
     $empleados = Empleado::all();
        
        $ventas= ventas::findorfail($id);
        return view('ventas.edit',compact('ventas', 'clientes', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ventas = ventas::findorfail($id);
        $ventas->update($request->all());

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $ventas= ventas::findorfail($id);
        $ventas->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}
