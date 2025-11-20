# 📊 Documentación - Replanteo del Sistema de Gestión de Ventas

## Cambios Realizados

### ❌ Tablas Eliminadas
Se han eliminado las siguientes tablas y sus migraciones asociadas:
- **clientes** - Datos de clientes (estructura de solo lectura)
- **metodo_pagos** - Métodos de pago
- **pagos** - Registro de pagos
- **auditorias** - Registros de auditoría

### ✅ Tablas Mantidas y Optimizadas
1. **users** - Usuarios del sistema
2. **turnos** - Turnos de trabajo
3. **empleados** - Empleados/vendedores
4. **categorias** - Categorías de productos
5. **proveedor** - Proveedores
6. **productos** - Catálogo de productos
7. **inventario** - Control de inventario (REDISEÑADO)
8. **ventas** - Registro de ventas (REDISEÑADO)
9. **detalle_ventas** - Detalles de cada venta
10. **devolucions** - Devoluciones de productos (MEJORADO)

---

## 🔗 Diagrama de Relaciones

```
┌─────────────────────────────────────────────────────────────────┐
│                       SISTEMA DE VENTAS                         │
├─────────────────────────────────────────────────────────────────┤

TABLA: users
├── id (PK)
├── name
├── email
└── password
    
TABLA: turnos
├── id (PK)
├── InicioTurno
├── FinTurno
└── timestamps
    └─ 1:N ──> empleados

TABLA: empleados
├── id (PK)
├── nombre
├── cargo
├── usuario
├── contraseña
├── idTurno (FK) ──> turnos.id
└── timestamps
    └─ 1:N ──> ventas

TABLA: categorias
├── id (PK)
├── nombre
└── timestamps
    └─ 1:N ──> productos

TABLA: proveedor
├── id (PK)
├── nombre
├── contacto
├── telefono
├── direccion
└── timestamps
    └─ 1:N ──> productos

TABLA: productos
├── id (PK)
├── nombre
├── descripcion
├── precio
├── stock
├── codigoBarras (UNIQUE, NULLABLE)
├── idCategoria (FK) ──> categorias.id
├── idProveedor (FK) ──> proveedor.id
└── timestamps
    ├─ 1:1 ──> inventario
    └─ 1:N ──> detalle_ventas

TABLA: inventario
├── id (PK)
├── idProducto (FK, UNIQUE) ──> productos.id
├── cantidad
├── cantidad_minima
├── fecha_actualizacion
├── nota
└── timestamps

TABLA: ventas
├── id (PK)
├── fecha
├── total
├── cliente_nombre (STRING 100)
├── cliente_telefono (STRING 15, NULLABLE)
├── cliente_email (STRING 100, NULLABLE)
├── idempleado (FK) ──> empleados.id
└── timestamps
    ├─ 1:N ──> detalle_ventas
    └─ 1:N ──> devolucions

TABLA: detalle_ventas
├── id (PK)
├── cantidad
├── precio_unitario
├── subtotal
├── idventa (FK) ──> ventas.id
├── idProducto (FK) ──> productos.id
└── timestamps

TABLA: devolucions
├── id (PK)
├── idventa (FK) ──> ventas.id (CASCADE DELETE)
├── cantidad
├── motivo (NULLABLE)
├── fecha_devolucion
├── estado (enum: 'pendiente', 'aprobada', 'rechazada')
└── timestamps
```

---

## 📋 Estructura de Relaciones Elegram

### **One-to-Many (1:N)**
- `turnos` 1→N `empleados`
- `empleados` 1→N `ventas`
- `categorias` 1→N `productos`
- `proveedor` 1→N `productos`
- `productos` 1→N `detalle_ventas`
- `ventas` 1→N `detalle_ventas`
- `ventas` 1→N `devolucions`

### **One-to-One (1:1)**
- `productos` 1↔1 `inventario`

### **Sin tabla de relación (datos embebidos)**
- Información de cliente directamente en `ventas`:
  - `cliente_nombre`
  - `cliente_telefono`
  - `cliente_email`

---

## 🎯 Cambios en Modelos

### Modelo `Empleado`
- ✅ Relación con `Turno`
- ✅ Relación con `Ventas`
- ❌ Removida relación con Auditorías

### Modelo `Producto`
- ✅ Cambio: relación de `inventario` de belongsTo a hasOne
- ❌ Removida: campo `idInventario` de fillable
- ✅ Relaciones correctas con Categoría y Proveedor

### Modelo `Inventario`
- ✅ REDISEÑADO: Ahora tiene FK a `productos`
- ✅ Campos mejorados: `cantidad`, `cantidad_minima`, `fecha_actualizacion`, `nota`
- ✅ Cast correcto para datetime

### Modelo `Ventas`
- ✅ Removida relación con tabla `clientes`
- ✅ Agregados campos directos:
  - `cliente_nombre`
  - `cliente_telefono`
  - `cliente_email`
- ❌ Removida relación con `pagos`
- ✅ Nueva relación: `devoluciones()`

### Modelo `Devolucion`
- ✅ CREADO: Estructura completa
- ✅ Campos: `cantidad`, `motivo`, `fecha_devolucion`, `estado`
- ✅ Estados: 'pendiente', 'aprobada', 'rechazada'
- ✅ Relación con `ventas`

---

## 🚀 Próximos Pasos Recomendados

1. **Ejecutar migraciones:**
   ```bash
   php artisan migrate:reset
   php artisan migrate
   ```

2. **Crear seeders para datos iniciales:**
   - Seeders para categorías, proveedores, turnos
   - Datos de prueba para empleados

3. **Actualizar Controladores:**
   - `VentasController` - Ajustar para trabajar con datos de cliente embebidos
   - `ProductoController` - Manejar inventario correctamente
   - `DevolucionController` - Implementar lógica de devoluciones

4. **Crear Solicitudes (Requests):**
   - `StoreVentaRequest`
   - `StoreDevolucioRequest`
   - `UpdateProductoRequest`

5. **Rutas API/Web:**
   - Revisar y actualizar rutas en `routes/web.php`
   - Crear endpoints para gestión de ventas y devoluciones

6. **Validaciones:**
   - Validar cantidad de inventario en devoluciones
   - Verificar stock disponible antes de ventas
   - Alertas cuando cantidad mínima se alcance

---

## 📝 Ejemplos de Uso

### Crear una venta:
```php
$venta = ventas::create([
    'fecha' => now(),
    'total' => 1500.50,
    'cliente_nombre' => 'Juan Pérez',
    'cliente_telefono' => '3001234567',
    'cliente_email' => 'juan@email.com',
    'idempleado' => 1
]);

// Agregar detalles
$venta->detalleVentas()->create([
    'idProducto' => 5,
    'cantidad' => 2,
    'precio_unitario' => 750.25,
    'subtotal' => 1500.50
]);
```

### Registrar una devolución:
```php
$devolucion = Devolucion::create([
    'idventa' => 1,
    'cantidad' => 1,
    'motivo' => 'Defecto de fabricación',
    'fecha_devolucion' => now(),
    'estado' => 'pendiente'
]);
```

### Obtener inventario de un producto:
```php
$producto = Producto::find(5);
$inventario = $producto->inventario;
echo "Stock: " . $inventario->cantidad;
echo "Mínimo: " . $inventario->cantidad_minima;
```

---

## ✨ Ventajas del Nuevo Diseño

1. **Simplificación**: Eliminación de tablas innecesarias
2. **Flexibilidad**: Datos de cliente embebidos permiten registrar ventas sin depender de una tabla de clientes
3. **Mejor Control de Inventario**: Relación uno-a-uno clara entre productos e inventario
4. **Gestión de Devoluciones**: Sistema completo de devoluciones con estados
5. **Trazabilidad**: Cada venta vinculada a un empleado específico
6. **Auditoría mejorada**: Timestamps automáticos en todas las tablas

---

**Última actualización**: 19 de noviembre de 2025
