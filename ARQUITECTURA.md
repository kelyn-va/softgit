# 🏗️ Arquitectura del Sistema de Reportes

## Diagrama de Flujo

```
┌─────────────────────────────────────────────────────────────────┐
│                     NAVEGADOR DEL USUARIO                        │
└─────────────────────────────────────────────────────────────────┘
                              ↓
                        /reportes (GET)
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│                    LARAVEL ROUTER                               │
│  Route::get('/reportes', [ReportesController::class, 'index']) │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│          ReportesController::index()                            │
│  - Obtiene categorías, empleados, productos                    │
│  - Retorna vista con datos para los filtros                    │
└─────────────────────────────────────────────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│          Vista: resources/views/reportes/index.blade.php        │
│  - Muestra formulario de filtros                               │
│  - Muestra cards de resumen                                    │
│  - Carga gráficos (vacíos al inicio)                           │
│  - Carga tabla vacía                                           │
└─────────────────────────────────────────────────────────────────┘
                              ↓
                  ┌───────────────────┐
                  │ Usuario selecciona │
                  │ tipo de reporte y  │
                  │ aplica filtros     │
                  └───────────────────┘
                              ↓
                   JavaScript: aplicarFiltros()
                              ↓
                 Llamada AJAX a una de estas rutas:
                    ┌─────────────────────────┐
                    │ /api/reportes/inventario│ (GET)
                    │ /api/reportes/ventas    │ (GET)
                    │ /api/reportes/...      │ (GET)
                    └─────────────────────────┘
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│     ReportesController::(getInventarioData|getVentasData...)   │
│                                                                 │
│  1. Construir query con filtros                               │
│  2. Ejecutar consulta a BD                                    │
│  3. Retornar JSON con los datos                              │
└─────────────────────────────────────────────────────────────────┘
                              ↓
                    BASE DE DATOS
         (inventario, ventas, detalle_ventas, productos...)
                              ↓
                        Datos JSON
                              ↓
┌─────────────────────────────────────────────────────────────────┐
│              JavaScript recibe los datos                        │
│                                                                 │
│  - actualizarTabla()       → Llena tabla con datos            │
│  - crearGrafico*()         → Renderiza gráficos               │
│  - actualizarResumen()     → Actualiza cards de resumen       │
└─────────────────────────────────────────────────────────────────┘
                              ↓
                    Usuario ve el reporte
                    con gráficos y datos
```

---

## Componentes del Sistema

```
┌────────────────────────────────────────────────────────────────┐
│                     VISTA (Frontend)                           │
├────────────────────────────────────────────────────────────────┤
│                                                                │
│  ┌──────────────┐   ┌──────────────┐   ┌──────────────┐      │
│  │   Filtros    │   │   Cards      │   │  Gráficos    │      │
│  │              │   │  Resumen     │   │  (Chart.js)  │      │
│  │ - Categoría  │   │              │   │              │      │
│  │ - Producto   │   │ - Total      │   │ - Doughnut   │      │
│  │ - Fechas     │   │   Ventas     │   │ - Barras     │      │
│  │ - Empleado   │   │ - Stock      │   │ - Líneas     │      │
│  │ - Método Pago│   │ - Stock Bajo │   │              │      │
│  │              │   │              │   │              │      │
│  └──────────────┘   └──────────────┘   └──────────────┘      │
│                                                                │
│  ┌────────────────────────────────────┐                       │
│  │        Tabla de Datos              │                       │
│  │  Muestra todos los detalles        │                       │
│  └────────────────────────────────────┘                       │
│                                                                │
└────────────────────────────────────────────────────────────────┘
                           ↕ AJAX
┌────────────────────────────────────────────────────────────────┐
│              API ROUTES (Backend)                              │
├────────────────────────────────────────────────────────────────┤
│                                                                │
│  GET /api/reportes/inventario                                │
│  GET /api/reportes/ventas                                    │
│  GET /api/reportes/ventas-categoria                          │
│  GET /api/reportes/ventas-empleado                           │
│  GET /api/reportes/tendencia-ventas                          │
│  GET /api/reportes/stock-bajo                                │
│                                                                │
└────────────────────────────────────────────────────────────────┘
                           ↕
┌────────────────────────────────────────────────────────────────┐
│         ReportesController                                      │
├────────────────────────────────────────────────────────────────┤
│                                                                │
│  - getInventarioData()      → Consulta Inventario             │
│  - getVentasData()          → Consulta Ventas                 │
│  - getVentasPorCategoria()  → Group by Categoría             │
│  - getVentasPorEmpleado()   → Group by Empleado              │
│  - getTendenciaVentas()     → Group by Fecha                 │
│  - getInventarioBajoStock() → Where cantidad < mínima        │
│                                                                │
└────────────────────────────────────────────────────────────────┘
                           ↕
┌────────────────────────────────────────────────────────────────┐
│              Modelos (ORM Eloquent)                            │
├────────────────────────────────────────────────────────────────┤
│                                                                │
│  - Inventario                                                  │
│  - ventas                                                      │
│  - DetalleVenta                                                │
│  - Producto                                                    │
│  - Categorias                                                  │
│  - Empleado                                                    │
│                                                                │
└────────────────────────────────────────────────────────────────┘
                           ↕
┌────────────────────────────────────────────────────────────────┐
│              BASE DE DATOS                                     │
├────────────────────────────────────────────────────────────────┤
│                                                                │
│  - inventario                                                  │
│  - ventas                                                      │
│  - detalle_ventas                                              │
│  - productos                                                   │
│  - categorias                                                  │
│  - empleados                                                   │
│  - users                                                       │
│                                                                │
└────────────────────────────────────────────────────────────────┘
```

---

## Flujo de Datos - Ejemplo Práctico

### Caso: Ver Ventas por Categoría

```
1. Usuario abre /reportes
   ↓
2. Se carga la vista con:
   - Dropdown de tipos de reporte
   - Campos de filtro (ocultos)
   - Cards vacíos
   - Gráficos vacíos
   ↓
3. Usuario selecciona "Ventas por Categoría"
   ↓
4. JavaScript ejecuta cambiarReporte()
   - Muestra filtros de fecha
   - Oculta otros filtros
   ↓
5. Usuario selecciona:
   - Fecha Inicio: 2025-01-01
   - Fecha Fin: 2025-01-31
   ↓
6. Usuario hace clic en "Aplicar Filtros"
   ↓
7. JavaScript ejecuta cargarVentasPorCategoria()
   ↓
8. Solicitud AJAX GET /api/reportes/ventas-categoria?fecha_inicio=2025-01-01&fecha_fin=2025-01-31
   ↓
9. Controlador recibe solicitud
   ↓
10. ReportesController::getVentasPorCategoria() ejecuta:
    - Query a DetalleVenta
    - Filtra por fechas
    - Agrupa por categoría
    - Mapea cantidad y total
    - Retorna JSON
   ↓
11. Respuesta JSON:
    {
        "Electrónica": {"cantidad": 150, "total": 5000},
        "Ropa": {"cantidad": 200, "total": 3000}
    }
   ↓
12. JavaScript recibe datos y ejecuta:
    - crearGraficoCategoria(data)
    - Chart.js renderiza Doughnut Chart
    - El gráfico muestra las categorías con sus totales
   ↓
13. Usuario ve el gráfico actualizado
```

---

## Relaciones entre Modelos

```
                    Categorias
                        |
                        | hasMany
                        ↓
    ┌───────────────────────────────────────┐
    │          Producto                      │
    │  - idCategoria (FK)                   │
    │  - idProveedor (FK)                   │
    └───────────────────────────────────────┘
         ↑            ↑                      ↑
         |            |                      |
    belongsTo     hasMany                hasMany
         |            |                      |
         |            ↓                      ↓
    Categorias   DetalleVenta           Inventario
                      ↑
                      |
                  belongsTo
                      |
                      ↓
                   ventas (Venta)
                      |
                   belongsTo
                      ↓
                  Empleado
```

---

## Stack Tecnológico

```
┌─────────────────────────────────────┐
│         SERVIDOR (Backend)          │
├─────────────────────────────────────┤
│ Language: PHP 7.4+                  │
│ Framework: Laravel 8+               │
│ Database: MySQL/PostgreSQL          │
│ ORM: Eloquent                       │
└─────────────────────────────────────┘
           ↓ API REST
┌─────────────────────────────────────┐
│         CLIENTE (Frontend)          │
├─────────────────────────────────────┤
│ HTML5 / Bootstrap 5                 │
│ JavaScript Vanilla                  │
│ Chart.js v3 (Gráficos)             │
│ Font Awesome (Iconos)              │
│ AJAX (XMLHttpRequest/Fetch)        │
└─────────────────────────────────────┘
```

---

## Ciclo de Vida de una Solicitud

```
1. SOLICITUD
   ├─ Método: GET
   ├─ URL: /api/reportes/ventas
   ├─ Parámetros: ?fecha_inicio=2025-01-01&empleado_id=1
   └─ Header: Content-Type: application/json

2. RUTA
   ├─ Encuentra: Route::get('/api/reportes/ventas', ...)
   └─ Llama: ReportesController@getVentasData

3. CONTROLADOR
   ├─ Valida parámetros
   ├─ Construye Query:
   │  └─ ventas::query()
   │     ->where('created_at >= fecha_inicio')
   │     ->where('idempleado = empleado_id')
   │     ->with(['empleado', 'producto', 'detalles'])
   └─ Ejecuta Query

4. BASE DE DATOS
   ├─ Ejecuta SQL
   └─ Retorna Resultados

5. TRANSFORMACIÓN
   ├─ Eloquent convierte a Array
   └─ JSON Encode

6. RESPUESTA
   ├─ Status: 200 OK
   ├─ Content-Type: application/json
   └─ Body: [...datos...]

7. JAVASCRIPT
   ├─ Recibe JSON
   ├─ Actualiza DOM
   └─ Renderiza visualización
```

---

## Cache y Optimización

```
Usuario hace solicitud
        ↓
¿Está en cache?
    ├─ SÍ → Retorna de cache (rápido)
    └─ NO ↓
         Consulta BD
            ↓
         Guarda en cache
            ↓
         Retorna resultado
```

---

## Seguridad

```
REQUEST
   ↓
┌──────────────────────┐
│ 1. Middleware Auth   │ ¿Usuario autenticado?
└──────────────────────┘
   ↓
┌──────────────────────┐
│ 2. Middleware Role   │ ¿Tiene permisos?
└──────────────────────┘
   ↓
┌──────────────────────┐
│ 3. Validación Input  │ ¿Parámetros válidos?
└──────────────────────┘
   ↓
┌──────────────────────┐
│ 4. Rate Limiting     │ ¿Límite de solicitudes?
└──────────────────────┘
   ↓
PROCESAMIENTO SEGURO
```

---

Este diagrama te ayuda a entender cómo todo está conectado. 

¡Listo para empezar! 🚀
