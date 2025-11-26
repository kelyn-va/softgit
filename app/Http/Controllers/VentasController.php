<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Ventas;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\DetalleVenta;

class VentasController extends Controller
{
    public function index()
    {
        $ventas = Ventas::with(['empleado', 'detalles.producto'])->get();

        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        $productos = Producto::all();

        return view('ventas.create', compact('empleados', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'metodo_pago' => 'required',
            'idempleado' => 'required|exists:empleados,id',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1'
        ]);

        // Crear venta
        $venta = Ventas::create([
            'total' => 0,
            'metodo_pago' => $request->metodo_pago,
            'idempleado' => $request->idempleado,
            'idproducto' => null
        ]);

        $totalVenta = 0;

        foreach ($request->productos as $p) {
            $producto = Producto::findOrFail($p['id']);
            $cantidad = $p['cantidad'];
            $subtotal = $producto->precio * $cantidad;

            DetalleVenta::create([
                'idventa' => $venta->id,
                'idProducto' => $producto->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $producto->precio,
                'subtotal' => $subtotal
            ]);

            $totalVenta += $subtotal;
        }

        $venta->update(['total' => $totalVenta]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');
    }

    public function destroy($id)
    {
        $venta = Ventas::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }

    
}