# 🧪 Cómo Ejecutar las Pruebas de Filtros

## Opción 1: Usando Tinker (Recomendado - Interactivo)

Ejecuta este comando en la terminal:

```bash
php artisan tinker
```

Luego, copia y pega cada comando por separado:

```php
// Comando 1: Ver conteo de datos
use App\Models\ventas;
use App\Models\Inventario;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Categorias;
use Carbon\Carbon;

echo "Empleados: " . Empleado::count() . "\n";
echo "Productos: " . Producto::count() . "\n";
echo "Categorías: " . Categorias::count() . "\n";
echo "Ventas: " . ventas::count() . "\n";
echo "Inventario: " . Inventario::count() . "\n";

// Comando 2: Ver estructura de una venta
$venta = ventas::first();
$venta;

// Comando 3: Verificar si hay datos con metodo_pago
ventas::select('metodo_pago')->distinct()->get();

// Comando 4: Contar ventas por metodo_pago
ventas::where('metodo_pago', 'efectivo')->count();

// Comando 5: Verificar relaciones
$venta->empleado;
$venta->detalles;

// Comando 6: Verificar stock bajo
Inventario::whereRaw('cantidad < cantidad_minima')->with('producto')->get();

exit
```

---

## Opción 2: Ejecutar el Script Completo

```bash
php artisan tinker < tests/TestFiltrosReportes.php
```

---

## Opción 3: Pruebas Directas en el Navegador

1. Abre tu navegador en la URL: `http://localhost:8000/reportes`

2. **Prueba Filtro 1 - Inventario:**
   - Selecciona "Inventario" en el dropdown
   - Selecciona una categoría
   - Haz clic en "Aplicar Filtros"
   - Abre consola (F12) → Network → Busca `/api/reportes/inventario`
   - Verifica que el status sea 200 y retorne datos

3. **Prueba Filtro 2 - Ventas:**
   - Selecciona "Ventas"
   - Establece fechas (últimos 30 días)
   - Selecciona un empleado
   - Haz clic en "Aplicar Filtros"
   - Verifica los datos en la tabla y en Network

4. **Prueba Filtro 3 - Método de Pago:**
   - En el filtro de ventas, selecciona "Efectivo", "Tarjeta" o "Transferencia"
   - Aplica filtros
   - Verifica que solo muestre ventas con ese método

---

## 📊 Resultado Esperado

Si todos los filtros funcionan correctamente, deberías ver:

```
✓ Empleados: 5
✓ Productos: 20
✓ Categorías: 4
✓ Ventas: 50
✓ Inventario: 20
```

Si alguno muestra 0, es porque:
- No hay datos de ejemplo en la BD
- O la BD aún no se ha ejecutado

Para agregar datos de ejemplo, ejecuta:
```bash
php artisan db:seed
```

---

## 🐛 Si Algo No Funciona

1. **Abre la consola del navegador (F12)**
2. **Ve a Network**
3. **Aplica un filtro**
4. **Haz clic en la solicitud `/api/reportes/...`**
5. **Revisa:**
   - ✓ Status: debe ser 200
   - ✓ Response: debe tener datos

6. **Si ves error 500:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

7. **Si ves datos vacíos:**
   - Verifica que existan datos en la BD
   - Ejecuta los seeders nuevamente

