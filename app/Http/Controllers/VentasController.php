<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Empleado;
use App\Models\ventas;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = ventas::all();
        return view('ventas.index', compact('ventas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Clientes::all();
        $empleados  = Empleado::all();
        return view('ventas.create', compact ('clientes','empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ventas::create(
            $request->all()
        );

        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');
    }

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
     $clientes = Clientes::all();
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
