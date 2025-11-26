<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\ventas;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Categorias;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportesController extends Controller
{
    /**
     * Mostrar vista de reportes con filtros
     */
    public function index()
    {
        $categorias = Categorias::all();
        $empleados = Empleado::all();
        $productos = Producto::all();

        return view('reportes.index', compact('categorias', 'empleados', 'productos'));
    }

    /**
     * Obtener datos de inventario con filtros
     */
    public function getInventarioData(Request $request)
    {
        $query = Inventario::query();

        // Filtro por categoría
        if ($request->categoria_id) {
            $query->whereHas('producto', function ($q) {
                $q->where('idCategoria', request('categoria_id'));
            });
        }

        // Filtro por producto
        if ($request->producto_id) {
            $query->where('idProducto', $request->producto_id);
        }

        // Filtro de cantidad mínima
        if ($request->stock_bajo) {
            $query->whereRaw('cantidad < cantidad_minima');
        }

        $data = $query->with('producto')->get();

        return response()->json($data);
    }

    /**
     * Obtener datos de ventas con filtros
     */
    public function getVentasData(Request $request)
    {
        $query = ventas::query();

        // Filtro por rango de fechas
        if ($request->fecha_inicio) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        }
        if ($request->fecha_fin) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        // Filtro por empleado
        if ($request->empleado_id) {
            $query->where('idempleado', $request->empleado_id);
        }

        // Filtro por producto
        if ($request->producto_id) {
            $query->where('idproducto', $request->producto_id);
        }

        // Filtro por método de pago
        if ($request->metodo_pago) {
            $query->where('metodo_pago', $request->metodo_pago);
        }

        $data = $query->with(['empleado', 'producto', 'detalles'])->get();

        return response()->json($data);
    }

    /**
     * Obtener datos de ventas por categoría
     */
    public function getVentasPorCategoria(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio ?? now()->subDays(30)->format('Y-m-d');
        $fecha_fin = $request->fecha_fin ?? now()->format('Y-m-d');

        $data = DetalleVenta::query()
            ->whereHas('venta', function ($q) use ($fecha_inicio, $fecha_fin) {
                $q->whereDate('created_at', '>=', $fecha_inicio)
                  ->whereDate('created_at', '<=', $fecha_fin);
            })
            ->with('producto.categoria')
            ->get()
            ->groupBy('producto.categoria.nombre')
            ->map(function ($items) {
                return [
                    'cantidad' => $items->sum('cantidad'),
                    'total' => $items->sum('subtotal')
                ];
            });

        return response()->json($data);
    }

    /**
     * Obtener datos de inventario bajo stock
     */
    public function getInventarioBajoStock()
    {
        $data = Inventario::whereRaw('cantidad < cantidad_minima')
            ->with('producto')
            ->get()
            ->map(function ($item) {
                return [
                    'producto' => $item->producto->nombre,
                    'cantidad' => $item->cantidad,
                    'minima' => $item->cantidad_minima,
                    'diferencia' => $item->cantidad_minima - $item->cantidad
                ];
            });

        return response()->json($data);
    }

    /**
     * Obtener ventas por empleado
     */
    public function getVentasPorEmpleado(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio ?? now()->subDays(30)->format('Y-m-d');
        $fecha_fin = $request->fecha_fin ?? now()->format('Y-m-d');

        $data = ventas::query()
            ->whereDate('created_at', '>=', $fecha_inicio)
            ->whereDate('created_at', '<=', $fecha_fin)
            ->with('empleado')
            ->get()
            ->groupBy('empleado.nombre')
            ->map(function ($items) {
                return [
                    'cantidad' => $items->count(),
                    'total' => $items->sum('total')
                ];
            });

        return response()->json($data);
    }

    /**
     * Obtener tendencia de ventas por día
     */
    public function getTendenciaVentas(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio ?? now()->subDays(30)->format('Y-m-d');
        $fecha_fin = $request->fecha_fin ?? now()->format('Y-m-d');

        $data = ventas::query()
            ->whereDate('created_at', '>=', $fecha_inicio)
            ->whereDate('created_at', '<=', $fecha_fin)
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            })
            ->map(function ($items) {
                return $items->sum('total');
            });

        return response()->json($data);
    }

    /**
     * Generar reporte en PDF
     */
    public function exportarPDF(Request $request)
    {
        // Aquí puedes implementar la exportación a PDF
        return response()->json(['mensaje' => 'PDF generado']);
    }
}
