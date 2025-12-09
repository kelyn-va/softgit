# 📊 Guía de Uso - Reportes e Informes Visuales

## ✅ Instalación Completada

Se ha creado exitosamente un sistema completo de reportes con filtros y gráficos visuales para tu aplicación Laravel.

## 📁 Archivos Creados

1. **Controlador**: `app/Http/Controllers/ReportesController.php`
   - Maneja toda la lógica de filtrado y generación de datos
   - Métodos disponibles:
     - `getInventarioData()` - Datos de inventario filtrados
     - `getVentasData()` - Datos de ventas filtrados
     - `getVentasPorCategoria()` - Ventas agrupadas por categoría
     - `getVentasPorEmpleado()` - Ventas agrupadas por empleado
     - `getTendenciaVentas()` - Tendencia diaria de ventas
     - `getInventarioBajoStock()` - Productos con stock bajo

2. **Vista**: `resources/views/reportes/index.blade.php`
   - Interfaz completa con filtros interactivos
   - Gráficos usando Chart.js (Doughnut, Bar, Line)
   - Tabla de datos detallados
   - Cards de resumen

3. **Rutas**: Agregadas a `routes/web.php`
   - `/reportes` - Vista principal
   - `/api/reportes/*` - Endpoints API para obtener datos

## 🚀 Cómo Acceder

1. En tu navegador, ve a: `http://tu-app/reportes`

2. O agrega un enlace en tu menú de navegación:
```html
<a href="{{ route('reportes.index') }}" class="nav-link">
    <i class="fas fa-chart-bar"></i> Reportes
</a>
```

## 📊 Tipos de Reportes Disponibles

### 1. **Inventario**
   - Filtrar por categoría
   - Filtrar por producto
   - Ver cantidad y stock mínimo
   - Gráficos de distribución

### 2. **Ventas**
   - Filtrar por rango de fechas
   - Filtrar por empleado
   - Filtrar por producto
   - Filtrar por método de pago
   - Ver total y cantidad de transacciones

### 3. **Ventas por Categoría**
   - Visualizar en gráfico Doughnut
   - Mostrar totales por categoría
   - Rango de fechas personalizable

### 4. **Ventas por Empleado**
   - Gráfico de barras horizontales
   - Comparación de desempeño
   - Rango de fechas personalizable

### 5. **Tendencia de Ventas**
   - Gráfico de línea con tendencia
   - Visualizar ventas diarias
   - Identificar patrones de ventas

### 6. **Stock Bajo**
   - Ver productos con inventario bajo
   - Productos que están bajo el mínimo
   - Cantidad faltante para alcanzar mínimo

## 🎨 Características

✨ **Filtros Dinámicos**: Los filtros se muestran/ocultan según el tipo de reporte seleccionado

📈 **Gráficos Interactivos**: 
   - Gráficos Doughnut (pastel)
   - Gráficos de Barras
   - Gráficos de Líneas

📋 **Tabla de Datos**: Visualiza todos los datos en formato tabla ordenado

📊 **Cards de Resumen**: 
   - Total de ventas
   - Productos en stock
   - Stock bajo
   - Transacciones totales

## 🔧 Personalización

### Cambiar Colores de Gráficos
En `resources/views/reportes/index.blade.php`, modifica la función `crearGraficoCategoria()`:
```javascript
backgroundColor: [
    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
    '#FF9F40', '#FF6384', '#C9CBCF'
]
```

### Agregar Más Filtros
Agrega en el formulario de filtros:
```html
<div class="col-md-3">
    <label for="nuevo_filtro" class="form-label">Nuevo Filtro</label>
    <select class="form-select" id="nuevo_filtro">
        <!-- opciones -->
    </select>
</div>
```

### Modificar Rangos de Fechas
Por defecto muestra últimos 30 días. Para cambiar, edita en la vista:
```javascript
const startDate = new Date(today.getTime() - 30 * 24 * 60 * 60 * 1000); // Cambiar 30
```

## 🎯 Próximas Mejoras Sugeridas

1. **Exportar a PDF**: Implementar en `exportarPDF()`
2. **Exportar a Excel**: Agregar librería PhpSpreadsheet
3. **Programar Reportes**: Enviar reportes por email automáticamente
4. **Más Gráficos**: Agregar gráficos de dispersión, radiales, etc.
5. **Comparativas**: Comparar períodos diferentes

## ⚙️ Requisitos

- Laravel 8+
- Chart.js (ya incluido vía CDN)
- Font Awesome (para iconos)
- Bootstrap 5+ (para estilos)

## 📞 Soporte

Si necesitas agregar más reportes o filtros, modifica:
1. El controlador `ReportesController` para agregar métodos
2. La vista para agregar nuevos formularios
3. Las rutas en `web.php`

## 🔐 Notas de Seguridad

- Asegúrate de agregar middleware de autenticación si es necesario
- Valida los filtros en el controlador
- Usa transacciones de base de datos para reportes grandes
