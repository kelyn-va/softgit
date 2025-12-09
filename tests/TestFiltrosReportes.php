<?php

/**
 * Script de Prueba - Verificación de Filtros de Reportes
 * 
 * Este script te ayuda a diagnosticar problemas con los filtros
 * Ejecuta desde la consola: php artisan tinker < tests/TestFiltrosReportes.php
 * O copia y pega comandos individualmente
 */

use App\Models\ventas;
use App\Models\Inventario;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Categorias;
use Carbon\Carbon;

echo "=== VERIFICACIÓN DE DATOS PARA FILTROS ===\n\n";

// 1. Verificar existencia de datos
echo "1️⃣  CONTEO DE DATOS EN BASES DE DATOS\n";
echo "   Empleados: " . Empleado::count() . "\n";
echo "   Productos: " . Producto::count() . "\n";
echo "   Categorías: " . Categorias::count() . "\n";
echo "   Ventas: " . ventas::count() . "\n";
echo "   Inventario: " . Inventario::count() . "\n\n";

// 2. Verificar estructura de ventas
echo "2️⃣  VERIFICAR COLUMNAS EN TABLA VENTAS\n";
$venta_muestra = ventas::first();
if ($venta_muestra) {
    echo "   Campos disponibles en ventas:\n";
    foreach (array_keys($venta_muestra->getAttributes()) as $field) {
        echo "   ✓ $field\n";
    }
} else {
    echo "   ❌ No hay ventas en la BD\n";
}
echo "\n";

// 3. Probar filtro de Inventario por categoría
echo "3️⃣  PRUEBA: Filtro de Inventario por Categoría\n";
$categoria_muestra = Categorias::first();
if ($categoria_muestra) {
    $inventario = Inventario::whereHas('producto', function ($q) use ($categoria_muestra) {
        $q->where('idCategoria', $categoria_muestra->id);
    })->count();
    echo "   Inventario de categoría '{$categoria_muestra->nombre}': $inventario items\n";
} else {
    echo "   ❌ No hay categorías\n";
}
echo "\n";

// 4. Probar filtro de ventas por empleado
echo "4️⃣  PRUEBA: Filtro de Ventas por Empleado\n";
$empleado_muestra = Empleado::first();
if ($empleado_muestra) {
    $ventas_empleado = ventas::where('idempleado', $empleado_muestra->id)->count();
    echo "   Ventas del empleado '{$empleado_muestra->nombre}': $ventas_empleado\n";
} else {
    echo "   ❌ No hay empleados\n";
}
echo "\n";

// 5. Probar filtro de ventas por rango de fechas
echo "5️⃣  PRUEBA: Filtro de Ventas por Rango de Fechas\n";
$fecha_inicio = Carbon::now()->subDays(30);
$fecha_fin = Carbon::now();
$ventas_rango = ventas::whereDate('created_at', '>=', $fecha_inicio)
    ->whereDate('created_at', '<=', $fecha_fin)
    ->count();
echo "   Ventas últimos 30 días: $ventas_rango\n\n";

// 6. Probar filtro de método de pago
echo "6️⃣  PRUEBA: Filtro de Ventas por Método de Pago\n";
$metodos = ventas::select('metodo_pago')->distinct()->get();
if ($metodos->count() > 0) {
    foreach ($metodos as $item) {
        $count = ventas::where('metodo_pago', $item->metodo_pago)->count();
        echo "   Método '{$item->metodo_pago}': $count ventas\n";
    }
} else {
    echo "   ⚠️  No hay métodos de pago registrados\n";
}
echo "\n";

// 7. Probar relaciones
echo "7️⃣  VERIFICAR RELACIONES\n";
$venta_con_empleado = ventas::with('empleado')->first();
if ($venta_con_empleado && $venta_con_empleado->empleado) {
    echo "   ✓ Relación ventas->empleado funciona\n";
} else {
    echo "   ❌ La relación empleado puede no estar correcta\n";
}

$venta_con_producto = ventas::with('producto')->first();
if ($venta_con_producto && $venta_con_producto->producto) {
    echo "   ✓ Relación ventas->producto funciona\n";
} else {
    echo "   ❌ La relación producto puede no estar correcta\n";
}

$venta_con_detalles = ventas::with('detalles')->first();
if ($venta_con_detalles && $venta_con_detalles->detalles->count() > 0) {
    echo "   ✓ Relación ventas->detalles funciona\n";
} else {
    echo "   ❌ La relación detalles puede no estar correcta o vacía\n";
}
echo "\n";

// 8. Probar Stock Bajo
echo "8️⃣  PRUEBA: Filtro de Stock Bajo\n";
$stock_bajo = Inventario::whereRaw('cantidad < cantidad_minima')->count();
echo "   Productos con stock bajo: $stock_bajo\n\n";

echo "=== FIN DE LA VERIFICACIÓN ===\n";
