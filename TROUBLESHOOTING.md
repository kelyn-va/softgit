# 🔧 Solución de Problemas - Reportes

## ❌ Problema: "No se cargan los gráficos"

**Posibles causas:**
1. Chart.js no está cargando
2. Los datos no llegan del servidor
3. Error en JavaScript

**Solución:**
```bash
# Verificar en la consola del navegador (F12 → Console)
# Debería ver logs de las llamadas AJAX

# Si Chart.js no carga, agregar en la vista:
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
```

---

## ❌ Problema: "Error 404 en las rutas de API"

**Posible causa:** Las rutas no fueron agregadas correctamente

**Solución:**
```bash
# Verificar que las rutas existan
php artisan route:list | grep reportes

# Limpiar caché de rutas
php artisan route:cache
php artisan route:clear
```

---

## ❌ Problema: "La tabla de datos no muestra nada"

**Posibles causas:**
1. Los datos en la base de datos no coinciden con los filtros
2. Las relaciones entre modelos no están bien
3. Los campos de las columnas no existen

**Solución:**
```php
// Verificar en tinker que los datos existan
php artisan tinker
>>> Inventario::count()
>>> ventas::count()
>>> DetalleVenta::count()
```

---

## ❌ Problema: "Los filtros no funcionan"

**Posible causa:** JavaScript error

**Solución:**
1. Abrir consola del navegador (F12)
2. Buscar errores en rojo
3. Verificar que `aplicarFiltros()` se ejecuta

```javascript
// Agregar en consola para debug
console.log(document.getElementById('tipoReporte').value);
```

---

## ❌ Problema: "Base de datos no tiene datos"

**Solución:** Crear datos de prueba

```bash
# Usar tinker para crear datos
php artisan tinker

>>> $venta = new \App\Models\ventas();
>>> $venta->total = 100;
>>> $venta->metodo_pago = 'efectivo';
>>> $venta->idempleado = 1;
>>> $venta->save();
```

---

## ❌ Problema: "Error CORS (Cross-Origin)"

**Solución:** Si las rutas de API están en otro dominio

```php
// Agregar en app/Http/Middleware/HandleCors.php o instalar CORS
composer require fruitcake/laravel-cors
```

---

## ❌ Problema: "Los datos tardan mucho en cargar"

**Soluciones:**
1. Agregar índices a la base de datos
2. Usar caching
3. Reducir el rango de fechas

```php
// Agregar índices
// En el archivo de migración
$table->index('created_at');
$table->index('idProducto');
$table->index('idempleado');
```

---

## ❌ Problema: "No puedo ver el botón de Reportes en el menú"

**Solución:** Verificar que el archivo de layout se actualizó

```bash
# Buscar dónde está el layout principal
grep -r "route('inventario.index')" resources/views/

# Debería estar en resources/views/layouts/app.blade.php o similar
# Agregar el enlace a reportes en ese archivo
```

---

## ❌ Problema: "Los gráficos no se destruyen cuando cambio de reporte"

**Solución:** Ya está implementado, pero si no funciona:

```javascript
// Asegurar que se destruyen los gráficos anteriores
if (chartCategoria) {
    chartCategoria.destroy();
}
```

---

## ❌ Problema: "Las fechas no se filtran correctamente"

**Solución:** Verificar formato de fecha

```javascript
// Debug: Ver qué valor tiene el campo fecha
console.log(document.getElementById('fecha_inicio').value);

// Debería ser formato YYYY-MM-DD
```

---

## ✅ Checklist de Instalación

- [ ] Se creó `ReportesController.php`
- [ ] Se creó `resources/views/reportes/index.blade.php`
- [ ] Se agregaron rutas en `web.php`
- [ ] Se actualizó modelo `Categorias.php`
- [ ] Se puede acceder a `/reportes`
- [ ] Los gráficos se cargan correctamente
- [ ] Los filtros funcionan
- [ ] La tabla muestra datos

---

## 🧪 Pruebas Rápidas

### Verificar que todo está cargado
```bash
# En la terminal
php artisan tinker

# Ejecutar estos comandos
>>> app('App\Http\Controllers\ReportesController')
>>> \App\Models\Inventario::count()
>>> \App\Models\ventas::count()
```

### Verificar que las rutas existen
```bash
php artisan route:list | grep reportes
```

### Limpiar caché si hay cambios
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

---

## 📞 Errores Comunes

### "Class not found"
```bash
# Ejecutar composer dump-autoload
composer dump-autoload
```

### "View not found"
```bash
# Verificar que la vista existe
ls resources/views/reportes/
```

### "Method not found"
```bash
# Verificar que el controlador se guardó correctamente
php artisan make:controller ReportesController
```

---

## 🔍 Debug Avanzado

### Habilitar SQL logging
```php
// En AppServiceProvider.php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

public function boot()
{
    DB::listen(function($query) {
        Log::info($query->sql);
    });
}
```

### Usar Network tab del navegador
1. Abrir DevTools (F12)
2. Ir a tab "Network"
3. Aplicar filtros
4. Ver solicitudes HTTP
5. Verificar respuestas

---

## 📝 Logs

Revisar logs si hay errores:
```bash
tail -f storage/logs/laravel.log
```

---

## 🆘 Si todo falla

1. Limpiar todo:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload
```

2. Reiniciar servidor:
```bash
php artisan serve
```

3. Limpiar navegador:
   - Vaciar cache
   - Borrar cookies
   - Recargar con Ctrl+Shift+R

---

**Última actualización**: Noviembre 2025
