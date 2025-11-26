@extends('adminlte::page')

@section('title', 'Registrar Venta')

@section('css')
<style>
    /* --- VARIABLES DE ESTILO LIMPIO Y AZUL PASTEL --- */
    :root {
        --primary-soft-blue: #007bff; /* Azul primario */
        --light-blue-bg: #f0f7ff; /* Fondo de card muy claro/tabla */
        --header-bg: #d0e7ff; /* Azul pastel para encabezados de tabla */
        --text-dark: #344767; /* Color de texto oscuro */
        --card-border: #daeafc; /* Borde sutil */
    }

    /* Adaptar el Card de AdminLTE al estilo clean */
    .card {
        border-radius: 12px !important;
        border: 1px solid var(--card-border) !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    .card-header {
        background-color: white !important;
        border-bottom: 1px solid var(--card-border) !important;
        color: var(--text-dark);
        font-weight: 700;
    }
    
    /* Estilo de campos de formulario (limpio) */
    .form-control, .input-group-text, .custom-select {
        border-radius: 8px !important;
        border: 1px solid var(--card-border) !important;
        color: var(--text-dark);
    }
    .form-control:focus, .custom-select:focus {
        border-color: var(--primary-soft-blue) !important;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Botón Principal (Guardar Venta) - Verde */
    .btn-action-success {
        background-color: #28a745 !important; 
        border: none !important;
        color: white !important;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }
    .btn-action-success:hover {
        background-color: #1e7e34 !important;
    }

    /* Botón Agregar Producto (Azul) */
    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        border: none !important;
        color: white !important;
        border-radius: 8px;
        padding: 8px 15px;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }
    .btn-action-primary:hover {
        background-color: #0069d9 !important;
    }

    /* Tabla de productos agregados */
    #tablaProductos thead {
        background-color: var(--header-bg) !important;
        color: var(--text-dark) !important;
    }
    #tablaProductos thead th {
        border-color: #c4daee !important;
        font-weight: 600;
    }

    /* Botón de eliminar fila (Rojo) */
    .btn-danger {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
        border-radius: 6px !important;
        font-weight: 700;
    }
</style>
@stop

@section('content_header')
    <h1 class="fw-bold text-dark">Registrar Nueva Venta</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-group">
                        <label for="idempleado" class="fw-semibold">Empleado</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                            </div>
                            <select name="idempleado" id="idempleado" class="form-control custom-select" required>
                                <option value="">Seleccione el empleado</option>
                                @foreach($empleados as $e)
                                    <option value="{{ $e->id }}" {{ old('idempleado') == $e->id ? 'selected' : '' }}>
                                        {{ $e->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('idempleado')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="form-group">
                        <label for="metodo_pago" class="fw-semibold">Método de Pago</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
                            </div>
                            <select name="metodo_pago" id="metodo_pago" class="form-control custom-select" required>
                                <option value="efectivo" {{ old('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                <option value="tarjeta" {{ old('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                <option value="transferencia" {{ old('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                            </select>
                        </div>
                        @error('metodo_pago')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <h4 class="fw-bold text-dark mb-3"><i class="fas fa-cart-plus"></i> Añadir Productos</h4>
            <div class="row align-items-end mb-4">
                
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="productoSelect">Producto</label>
                        <select id="productoSelect" class="form-control custom-select">
                            <option value="">Seleccione un producto</option>
                            @foreach($productos as $p)
                                <option value="{{ $p->id }}" data-precio="{{ $p->precio }}">
                                    {{ $p->nombre }} - ${{ number_format($p->precio, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cantidadInput">Cantidad</label>
                        <input type="number" id="cantidadInput" class="form-control" min="1" disabled value="1" placeholder="Mínimo 1">
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="button" id="agregarProducto" class="btn btn-action-primary w-100" disabled>
                        <i class="fas fa-plus"></i> Agregar
                    </button>
                </div>
            </div>

            <h4 class="fw-bold text-dark mb-3 mt-5"><i class="fas fa-list"></i> Resumen del Pedido</h4>

            <div class="table-responsive mb-4">
                <table class="table table-bordered table-striped" id="tablaProductos">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th style="width: 15%">Cantidad</th>
                            <th style="width: 20%">Subtotal</th>
                            <th style="width: 10%">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Filas de productos inyectadas por JS --}}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-right fw-bold">TOTAL VENTA:</td>
                            <td colspan="2" class="fw-bold"><span id="totalVentaDisplay">$0.00</span></td>
                            <input type="hidden" name="total" id="totalVentaInput" value="0.00">
                        </tr>
                    </tfoot>
                </table>
            </div>


            <div class="text-right">
                <button type="submit" class="btn btn-action-success d-inline-flex align-items-center gap-2">
                    <i class="fas fa-money-bill-wave"></i> Finalizar y Guardar Venta
                </button>
            </div>

        </form>
    </div>
</div>

@stop

@section('js')
<script>
    let productos = @json($productos);
    let totalVenta = 0;

    function actualizarTotal() {
        totalVenta = 0;
        document.querySelectorAll('#tablaProductos tbody tr').forEach(row => {
            // El subtotal se puede calcular del input oculto, o se puede parsear directamente del TD
            const subtotalText = row.querySelector('td:nth-child(3)').textContent;
            // Quitamos el '$' y parseamos
            const subtotal = parseFloat(subtotalText.replace('$', '')); 
            totalVenta += subtotal;
        });

        // Actualizar el display y el input oculto
        document.getElementById('totalVentaDisplay').textContent = `$${totalVenta.toFixed(2)}`;
        document.getElementById('totalVentaInput').value = totalVenta.toFixed(2);
    }

    // Cuando selecciona un producto → habilitar cantidad
    document.getElementById('productoSelect').addEventListener('change', function() {
        const selected = this.value !== "";
        document.getElementById('cantidadInput').disabled = !selected;
        document.getElementById('agregarProducto').disabled = !selected;
        if(selected) {
            document.getElementById('cantidadInput').focus();
        }
    });

    // Agregar producto a la tabla
    document.getElementById('agregarProducto').addEventListener('click', function() {
        let id = document.getElementById('productoSelect').value;
        let cantidad = parseInt(document.getElementById('cantidadInput').value);

        // Buscar si el producto ya está en la lista (para actualizar cantidad/subtotal)
        let existingRow = document.querySelector(`#tablaProductos tbody tr[data-product-id="${id}"]`);

        if (!id || cantidad <= 0 || isNaN(cantidad)) {
            alert("Por favor, selecciona un producto e introduce una cantidad válida.");
            return;
        }

        let producto = productos.find(p => p.id == id);
        let precioUnitario = producto.precio;
        
        let subtotalCalculado = precioUnitario * cantidad;

        if (existingRow) {
            // Producto ya existe, actualizar cantidad y subtotal
            let oldCantidadInput = existingRow.querySelector(`input[name*="[cantidad]"]`);
            let oldCantidad = parseInt(oldCantidadInput.value);
            let newCantidad = oldCantidad + cantidad;
            
            let newSubtotal = precioUnitario * newCantidad;

            // Actualizar la fila visible
            existingRow.querySelector('td:nth-child(2)').textContent = newCantidad;
            existingRow.querySelector('td:nth-child(3)').textContent = `$${newSubtotal.toFixed(2)}`;
            
            // Actualizar inputs ocultos para el backend
            oldCantidadInput.value = newCantidad;

        } else {
            // Producto es nuevo, crear nueva fila
            let fila = `
                <tr data-product-id="${id}">
                    <td>${producto.nombre}</td>
                    <td>${cantidad}</td>
                    <td>$${subtotalCalculado.toFixed(2)}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm eliminar" data-id="${id}">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>

                    <input type="hidden" name="productos[${id}][id]" value="${id}">
                    <input type="hidden" name="productos[${id}][cantidad]" value="${cantidad}">
                </tr>
            `;
            document.querySelector('#tablaProductos tbody').insertAdjacentHTML('beforeend', fila);
        }

        // Actualizar total
        actualizarTotal();

        // Reiniciar selección
        document.getElementById('productoSelect').value = "";
        document.getElementById('cantidadInput').value = "1"; // Dejar en 1 para la siguiente
        document.getElementById('cantidadInput').disabled = true;
        document.getElementById('agregarProducto').disabled = true;
    });

    // Eliminar producto de la tabla
    document.addEventListener('click', function(e) {
        if (e.target.closest('.eliminar')) {
            e.preventDefault();
            const row = e.target.closest('tr');
            row.remove();
            
            // Actualizar total después de eliminar
            actualizarTotal();
        }
    });
    
    // Inicializar total al cargar por si hay viejos datos (aunque no se espera en create)
    document.addEventListener('DOMContentLoaded', actualizarTotal);
</script>
@stop