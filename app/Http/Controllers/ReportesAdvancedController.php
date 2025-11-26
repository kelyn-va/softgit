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
use DB;

/**
 * Extensiones Opcionales para ReportesController
 * 
 * Este archivo contiene métodos adicionales que puedes agregar
 * al ReportesController para funcionalidades avanzadas
 */

class ReportesAdvancedController extends Controller
{
    /**
     * Análisis de productos más vendidos
     */
    public function getProductosMasVendidos(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio ?? now()->subDays(30)->format('Y-m-d');
        $fecha_fin = $request->fecha_fin ?? now()->format('Y-m-d');

        $data = DetalleVenta::query()
            ->whereHas('venta', function ($q) use ($fecha_inicio, $fecha_fin) {
                $q->whereDate('created_at', '>=', $fecha_inicio)
                  ->whereDate('created_at', '<=', $fecha_fin);
            })
            ->with('producto')
            ->get()
            ->groupBy('producto.nombre')
            ->map(function ($items) {
                return [
                    'cantidad' => $items->sum('cantidad'),
                    'total' => $items->sum('subtotal'),
                    'promedio' => $items->avg('precio_unitario')
                ];
            })
            ->sortByDesc('total')
            ->take(10);

        return response()->json($data);
    }

    /**
     * Análisis de margen de ganancia
     */
    public function getMargenGanancia(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio ?? now()->subDays(30)->format('Y-m-d');
        $fecha_fin = $request->fecha_fin ?? now()->format('Y-m-d');

        $ventas = ventas::whereDate('created_at', '>=', $fecha_inicio)
            ->whereDate('created_at', '<=', $fecha_fin)
            ->sum('total');

        $data = [
            'total_ventas' => $ventas,
            'periodo' => "$fecha_inicio a $fecha_fin"
        ];

        return response()->json($data);
    }

    /**
     * Comparativa de períodos
     */
    public function getComparativaPeriodos(Request $request)
    {
        $dias = $request->dias ?? 30;
        
        $fecha_actual_inicio = now()->subDays($dias)->format('Y-m-d');
        $fecha_actual_fin = now()->format('Y-m-d');
        
        $fecha_anterior_inicio = now()->subDays($dias * 2)->format('Y-m-d');
        $fecha_anterior_fin = now()->subDays($dias)->format('Y-m-d');

        $ventas_actual = ventas::whereDate('created_at', '>=', $fecha_actual_inicio)
            ->whereDate('created_at', '<=', $fecha_actual_fin)
            ->sum('total');

        $ventas_anterior = ventas::whereDate('created_at', '>=', $fecha_anterior_inicio)
            ->whereDate('created_at', '<=', $fecha_anterior_fin)
            ->sum('total');

        $porcentaje_cambio = $ventas_anterior > 0 
            ? (($ventas_actual - $ventas_anterior) / $ventas_anterior) * 100 
            : 0;

        return response()->json([
            'periodo_actual' => $ventas_actual,
            'periodo_anterior' => $ventas_anterior,
            'cambio' => $ventas_actual - $ventas_anterior,
            'porcentaje_cambio' => round($porcentaje_cambio, 2)
        ]);
    }

    /**
     * Horas pico de ventas
     */
    public function getHorasPico(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio ?? now()->subDays(7)->format('Y-m-d');
        $fecha_fin = $request->fecha_fin ?? now()->format('Y-m-d');

        $data = ventas::whereDate('created_at', '>=', $fecha_inicio)
            ->whereDate('created_at', '<=', $fecha_fin)
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('H:00');
            })
            ->map(function ($items) {
                return $items->count();
            });

        return response()->json($data);
    }

    /**
     * Cliente/Categoría más rentable
     */
    public function getAnalisisRentabilidad(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio ?? now()->subDays(30)->format('Y-m-d');
        $fecha_fin = $request->fecha_fin ?? now()->format('Y-m-d');

        $categorias = Categorias::with(['productos.detalleVentas' => function ($query) use ($fecha_inicio, $fecha_fin) {
            $query->whereHas('venta', function ($q) use ($fecha_inicio, $fecha_fin) {
                $q->whereDate('created_at', '>=', $fecha_inicio)
                  ->whereDate('created_at', '<=', $fecha_fin);
            });
        }])
        ->get()
        ->map(function ($cat) {
            $total = $cat->productos->sum(function ($prod) {
                return $prod->detalleVentas->sum('subtotal');
            });
            return [
                'categoria' => $cat->nombre,
                'total' => $total,
                'productos' => $cat->productos->count()
            ];
        })
        ->sortByDesc('total');

        return response()->json($categorias);
    }

    /**
     * Reporte de devoluciones
     */
    public function getAnalisisDevoluciones(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio ?? now()->subDays(30)->format('Y-m-d');
        $fecha_fin = $request->fecha_fin ?? now()->format('Y-m-d');

        // Asumiendo que tienes tabla de devoluciones
        $data = [
            'total_devoluciones' => 0,
            'monto_devuelto' => 0,
            'porcentaje_devolucion' => 0
        ];

        return response()->json($data);
    }

    /**
     * Eficiencia de empleados
     */
    public function getEficienciaEmpleados(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio ?? now()->subDays(30)->format('Y-m-d');
        $fecha_fin = $request->fecha_fin ?? now()->format('Y-m-d');

        $data = Empleado::with(['ventas' => function ($q) use ($fecha_inicio, $fecha_fin) {
            $q->whereDate('created_at', '>=', $fecha_inicio)
              ->whereDate('created_at', '<=', $fecha_fin);
        }])
        ->get()
        ->map(function ($emp) {
            $ventas = $emp->ventas;
            return [
                'empleado' => $emp->nombre,
                'cantidad_ventas' => $ventas->count(),
                'total_vendido' => $ventas->sum('total'),
                'promedio_venta' => $ventas->count() > 0 ? $ventas->sum('total') / $ventas->count() : 0
            ];
        })
        ->sortByDesc('total_vendido');

        return response()->json($data);
    }

    /**
     * Predicción de demanda (básica)
     */
    public function getPrediccionDemanda(Request $request)
    {
        $producto_id = $request->producto_id;
        
        $historial = DetalleVenta::where('idProducto', $producto_id)
            ->with('venta')
            ->get()
            ->groupBy(function ($item) {
                return $item->venta->created_at->format('W');
            })
            ->map(function ($items) {
                return $items->sum('cantidad');
            });

        // Cálculo simple de promedio
        $promedio = $historial->avg();
        $proxima_semana = round($promedio);

        return response()->json([
            'promedio_semanal' => $promedio,
            'prediccion_proxima_semana' => $proxima_semana,
            'historial' => $historial
        ]);
    }
}
