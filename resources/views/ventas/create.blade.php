@extends('adminlte::page')

@section('title', 'Registrar Venta')

@section('content_header')
    <h1>Registrar Venta</h1>
@stop

@section('content')

<form action="{{ route('ventas.store') }}" method="POST">
    @csrf

    <!-- EMPLEADO -->
    <div class="form-group">
        <label>Empleado</label>
        <select name="idempleado" class="form-control" required>
            <option value="">Seleccione</option>
            @foreach($empleados as $e)
                <option value="{{ $e->id }}">{{ $e->nombre }}</option>
            @endforeach
        </select>
    </div>

    <!-- PRODUCTO -->
    <div class="form-group mt-3">
        <label>Producto</label>
        <select id="productoSelect" class="form-control">
            <option value="">Seleccione</option>
            @foreach($productos as $p)
                <option value="{{ $p->id }}" data-precio="{{ $p->precio }}">
                    {{ $p->nombre }} - ${{ number_format($p->precio,2) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- CANTIDAD -->
    <div class="form-group mt-2">
        <label>Cantidad</label>
        <input type="number" id="cantidadInput" class="form-control" min="1" disabled>
    </div>

    <!-- BOTÓN AGREGAR -->
    <button type="button" id="agregarProducto" class="btn btn-primary mt-2" disabled>
        Agregar Producto
    </button>

    <hr>

    <!-- TABLA PRODUCTOS AGREGADOS -->
    <h4>Productos agregados</h4>

    <table class="table table-bordered" id="tablaProductos">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <!-- MÉTODO DE PAGO -->
    <div class="form-group mt-3">
        <label>Método de Pago</label>
        <select name="metodo_pago" class="form-control" required>
            <option value="efectivo">Efectivo</option>
            <option value="tarjeta">Tarjeta</option>
            <option value="transferencia">Transferencia</option>
        </select>
    </div>

    <button class="btn btn-success mt-4">Guardar Venta</button>

</form>

@stop

@section('js')
<script>
    let productos = @json($productos);

    // Cuando selecciona un producto → habilitar cantidad
    document.getElementById('productoSelect').addEventListener('change', function() {
        document.getElementById('cantidadInput').disabled = (this.value === "");
        document.getElementById('agregarProducto').disabled = (this.value === "");
    });

    // Agregar producto a la tabla
    document.getElementById('agregarProducto').addEventListener('click', function() {
        let id = document.getElementById('productoSelect').value;
        let cantidad = document.getElementById('cantidadInput').value;

        if (!id || cantidad <= 0) return;

        let producto = productos.find(p => p.id == id);
        let subtotal = producto.precio * cantidad;

        // Construir fila
        let fila = `
            <tr>
                <td>${producto.nombre}</td>
                <td>${cantidad}</td>
                <td>$${subtotal.toFixed(2)}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm eliminar">
                        X
                    </button>
                </td>

                <!-- Inputs ocultos para enviar al backend -->
                <input type="hidden" name="productos[${id}][id]" value="${id}">
                <input type="hidden" name="productos[${id}][cantidad]" value="${cantidad}">
            </tr>
        `;

        document.querySelector('#tablaProductos tbody').insertAdjacentHTML('beforeend', fila);

        // Reiniciar selección
        document.getElementById('productoSelect').value = "";
        document.getElementById('cantidadInput').value = "";
        document.getElementById('cantidadInput').disabled = true;
        document.getElementById('agregarProducto').disabled = true;
    });

    // Eliminar producto de la tabla
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('eliminar')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@stop
