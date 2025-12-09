# 🚀 Guía Rápida de Inicio - Reportes Visuales

## ⚡ En 5 Minutos

### Paso 1: Verifica que todo esté en su lugar
```bash
# Verificar que el controlador existe
ls app/Http/Controllers/ReportesController.php

# Verificar que la vista existe
ls resources/views/reportes/index.blade.php

# Verificar que las rutas están agregadas
php artisan route:list | grep reportes
```

### Paso 2: Accede a la vista
1. Inicia tu servidor Laravel: `php artisan serve`
2. Abre en el navegador: `http://localhost:8000/reportes`
3. ¡Deberías ver el panel de reportes!

### Paso 3: Prueba un reporte
1. Selecciona "Inventario" en el dropdown
2. Haz clic en "Aplicar Filtros"
3. Deberías ver datos en la tabla

---

## 📋 Checklist Rápido

- [ ] El archivo `ReportesController.php` existe en `app/Http/Controllers/`
- [ ] El archivo `index.blade.php` existe en `resources/views/reportes/`
- [ ] Las rutas fueron agregadas a `routes/web.php`
- [ ] Puedes acceder a `/reportes` sin errores
- [ ] Los gráficos se cargan correctamente
- [ ] La tabla muestra datos

---

## 🐛 Si algo no funciona

### Opción 1: Limpiar caché
```bash
php artisan cache:clear
php artisan route:cache
```

### Opción 2: Verificar logs
```bash
tail -f storage/logs/laravel.log
```

### Opción 3: Buscar en TROUBLESHOOTING.md
Consulta el archivo `TROUBLESHOOTING.md` para soluciones detalladas.

---

## 🎯 Próximos Pasos

1. **Agregar al menú**: Ver `AGREGAR_AL_MENU.html`
2. **Personalizar**: Ver `PERSONALIZACION_AVANZADA.php`
3. **Exportar datos**: Buscar exportación PDF/Excel
4. **Agregar más reportes**: Ver `ReportesAdvancedController.php`

---

## 🌐 URLs Disponibles

| URL | Descripción |
|-----|-------------|
| `/reportes` | Panel principal |
| `/api/reportes/inventario` | API de inventario |
| `/api/reportes/ventas` | API de ventas |
| `/api/reportes/ventas-categoria` | Ventas por categoría |
| `/api/reportes/ventas-empleado` | Ventas por empleado |
| `/api/reportes/tendencia-ventas` | Tendencia de ventas |
| `/api/reportes/stock-bajo` | Stock bajo |

---

## 💡 Tips Útiles

### Ver qué datos hay en la BD
```bash
php artisan tinker
>>> Inventario::count()  # Ver cantidad de inventarios
>>> ventas::count()      # Ver cantidad de ventas
```

### Crear datos de prueba
```bash
php artisan tinker
>>> $venta = new \App\Models\ventas(['total' => 100, 'metodo_pago' => 'efectivo']);
>>> $venta->save()
```

### Verificar relaciones
```bash
php artisan tinker
>>> $inv = Inventario::first()
>>> $inv->producto  # Debería retornar el producto
```

---

## ❓ Preguntas Frecuentes

### P: ¿Dónde agrego el enlace en el menú?
R: Ver `AGREGAR_AL_MENU.html` - tienes varias opciones según tu diseño

### P: ¿Los gráficos no cargan?
R: Verifica que Chart.js esté disponible y que haya datos en la BD

### P: ¿Cómo agrego más filtros?
R: 1. Agrega campo HTML, 2. Modifica la consulta en el controlador, 3. Actualiza JavaScript

### P: ¿Cómo exporto a PDF?
R: Ver `PERSONALIZACION_AVANZADA.php` sección 4

### P: ¿Puedo cambiar los colores?
R: Sí, en las funciones `crearGrafico*` de la vista, modifica `backgroundColor`

---

## 🎓 Estructura del Proyecto

```
reportes/
├── Controlador: app/Http/Controllers/ReportesController.php
├── Vista: resources/views/reportes/index.blade.php
├── Rutas: routes/web.php (actualizado)
├── Docs: GUIA_REPORTES.md
├── Ejemplos: PERSONALIZACION_AVANZADA.php
└── Ayuda: TROUBLESHOOTING.md
```

---

## 🔍 Depuración Paso a Paso

### 1. ¿Llega a la vista?
```bash
# Verifica que la ruta esté en web.php
grep -n "reportes" routes/web.php
```

### 2. ¿Se cargan los datos?
```bash
# Abre DevTools (F12) → Network → aplica filtros
# Debería ver solicitudes GET a /api/reportes/*
# Verifica el status (200 = bien, 404 = ruta no existe, 500 = error en servidor)
```

### 3. ¿Los gráficos renderean?
```javascript
// En consola (F12 → Console)
console.log(Chart);  // Debería mostrar objeto Chart.js
console.log(chartCategoria);  // Debería mostrar la instancia del gráfico
```

---

## 📚 Documentación Completa

- **GUIA_REPORTES.md** - Guía completa de uso
- **RESUMEN_REPORTES.md** - Resumen técnico
- **TROUBLESHOOTING.md** - Solución de problemas
- **AGREGAR_AL_MENU.html** - Ejemplos de menú
- **PERSONALIZACION_AVANZADA.php** - Funcionalidades extras

---

## 🆘 Soporte Rápido

Si nada funciona:
1. Abre `TROUBLESHOOTING.md`
2. Busca tu problema específico
3. Sigue los pasos indicados
4. Verifica logs: `storage/logs/laravel.log`

---

## ✅ Estado del Proyecto

✓ Controlador creado  
✓ Vista creada  
✓ Rutas agregadas  
✓ Modelos actualizados  
✓ Documentación completa  
✓ Listo para usar

---

**¡Ya puedes empezar a usar tu sistema de reportes!**

Accede a: `http://tu-app/reportes`

