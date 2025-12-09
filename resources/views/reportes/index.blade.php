@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <!-- Título -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 d-inline-block"> Reportes e Informes Visuales</h1>
            <button class="btn btn-primary float-end" onclick="exportarDatos()">
                <i class="fas fa-download"></i> Exportar
            </button>
        </div>
    </div>

    <!-- Panel de Filtros -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">🔍 Filtros</h5>
        </div>
        <div class="card-body">
            <form id="filtrosForm" class="row g-3">
                <div class="col-md-3">
                    <label for="tipoReporte" class="form-label">Tipo de Reporte</label>
                    <select class="form-select" id="tipoReporte" onchange="cambiarReporte()">
                        <option value="">-- Seleccionar --</option>
                        <option value="ventas">Ventas</option>
                        <option value="ventasCategoria">Ventas por Categoría</option>
                        <option value="ventasEmpleado">Ventas por Empleado</option>
                        
                    </select>
                </div>

                <div class="col-md-3" id="filtroFechaInicio" style="display: none;">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio">
                </div>

                <div class="col-md-3" id="filtroFechaFin" style="display: none;">
                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" id="fecha_fin">
                </div>

                <div class="col-md-3" id="filtroCategoria" style="display: none;">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select class="form-select" id="categoria_id">
                        <option value="">-- Todas las categorías --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3" id="filtroProducto" style="display: none;">
                    <label for="producto_id" class="form-label">Producto</label>
                    <select class="form-select" id="producto_id">
                        <option value="">-- Todos los productos --</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3" id="filtroEmpleado" style="display: none;">
                    <label for="empleado_id" class="form-label">Empleado</label>
                    <select class="form-select" id="empleado_id">
                        <option value="">-- Todos los empleados --</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3" id="filtroMetodoPago" style="display: none;">
                    <label for="metodo_pago" class="form-label">Método de Pago</label>
                    <select class="form-select" id="metodo_pago">
                        <option value="">-- Todos --</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="transferencia">Transferencia</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <button type="button" class="btn btn-success" onclick="aplicarFiltros()">
                        <i class="fas fa-filter"></i> Aplicar Filtros
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="limpiarFiltros()">
                        <i class="fas fa-redo"></i> Limpiar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cards de Resumen -->
    <div class="row mb-4" id="resumenCards">
        <div class="col-md-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1"><small><b>Total Ventas</b></small></div>
                    <div class="h3 mb-0" id="totalVentas">$0.00</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1"><small><b>Transacciones</b></small></div>
                    <div class="h3 mb-0" id="totalTransacciones">0</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h6 class="m-0">Gráfico de Ventas por Categoría</h6>
                </div>
                <div class="card-body">
                    <canvas id="chartCategoria"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h6 class="m-0">Gráfico de Ventas por Empleado</h6>
                </div>
                <div class="card-body">
                    <canvas id="chartEmpleado"></canvas>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Tabla de Datos -->
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            <h6 class="m-0">Detalle de Datos</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="datosTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center text-muted">Selecciona un reporte</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let chartCategoria, chartEmpleado, chartTendencia;

    function cambiarReporte() {
        const tipo = document.getElementById('tipoReporte').value;
        
        // Mostrar/ocultar filtros según el tipo de reporte
        document.getElementById('filtroFechaInicio').style.display = 
            ['ventas', 'ventasEmpleado', 'tendencia'].includes(tipo) ? 'block' : 'none';
        document.getElementById('filtroFechaFin').style.display = 
            ['ventas', 'ventasEmpleado', 'tendencia'].includes(tipo) ? 'block' : 'none';
        document.getElementById('filtroCategoria').style.display = 
            tipo === 'inventario' ? 'block' : 'none';
        document.getElementById('filtroProducto').style.display = 
            ['inventario', 'ventas'].includes(tipo) ? 'block' : 'none';
        document.getElementById('filtroEmpleado').style.display = 
            tipo === 'ventas' ? 'block' : 'none';
        document.getElementById('filtroMetodoPago').style.display = 
            tipo === 'ventas' ? 'block' : 'none';
    }

    function aplicarFiltros() {
        const tipo = document.getElementById('tipoReporte').value;

        if (!tipo) {
            alert('Por favor, selecciona un tipo de reporte');
            return;
        }

        switch(tipo) {
            case 'inventario':
                cargarInventario();
                break;
            case 'ventas':
                cargarVentas();
                break;
            case 'ventasCategoria':
                cargarVentasPorCategoria();
                break;
            case 'ventasEmpleado':
                cargarVentasPorEmpleado();
                break;
            case 'tendencia':
                cargarTendenciaVentas();
                break;
            case 'stockBajo':
                cargarStockBajo();
                break;
        }
    }

    function cargarInventario() {
        const params = new URLSearchParams({
            categoria_id: document.getElementById('categoria_id').value,
            producto_id: document.getElementById('producto_id').value
        });

        fetch(`/api/reportes/inventario?${params}`)
            .then(response => response.json())
            .then(data => {
                actualizarTabla(data, 'inventario');
                actualizarResumen(data, 'inventario');
            })
            .catch(error => console.error('Error:', error));
    }

    function cargarVentas() {
        const params = new URLSearchParams({
            fecha_inicio: document.getElementById('fecha_inicio').value,
            fecha_fin: document.getElementById('fecha_fin').value,
            empleado_id: document.getElementById('empleado_id').value,
            producto_id: document.getElementById('producto_id').value,
            metodo_pago: document.getElementById('metodo_pago').value
        });

        fetch(`/api/reportes/ventas?${params}`)
            .then(response => response.json())
            .then(data => {
                actualizarTabla(data, 'ventas');
                actualizarResumen(data, 'ventas');
            })
            .catch(error => console.error('Error:', error));
    }

    function cargarVentasPorCategoria() {
        const params = new URLSearchParams({
            fecha_inicio: document.getElementById('fecha_inicio').value,
            fecha_fin: document.getElementById('fecha_fin').value
        });

        fetch(`/api/reportes/ventas-categoria?${params}`)
            .then(response => response.json())
            .then(data => {
                crearGraficoCategoria(data);
                actualizarResumen(data, 'categoria');
            })
            .catch(error => console.error('Error:', error));
    }

    function cargarVentasPorEmpleado() {
        const params = new URLSearchParams({
            fecha_inicio: document.getElementById('fecha_inicio').value,
            fecha_fin: document.getElementById('fecha_fin').value
        });

        fetch(`/api/reportes/ventas-empleado?${params}`)
            .then(response => response.json())
            .then(data => {
                crearGraficoEmpleado(data);
                actualizarResumen(data, 'empleado');
            })
            .catch(error => console.error('Error:', error));
    }

    function cargarTendenciaVentas() {
        const params = new URLSearchParams({
            fecha_inicio: document.getElementById('fecha_inicio').value,
            fecha_fin: document.getElementById('fecha_fin').value
        });

        fetch(`/api/reportes/tendencia-ventas?${params}`)
            .then(response => response.json())
            .then(data => {
                crearGraficoTendencia(data);
            })
            .catch(error => console.error('Error:', error));
    }

    function cargarStockBajo() {
        fetch('/api/reportes/stock-bajo')
            .then(response => response.json())
            .then(data => {
                actualizarTabla(data, 'stock');
                actualizarResumen(data, 'stock');
            })
            .catch(error => console.error('Error:', error));
    }

    function actualizarTabla(data, tipo) {
        const tbody = document.querySelector('#datosTable tbody');
        let html = '';

        if (!data || data.length === 0) {
            html = '<tr><td colspan="5" class="text-center text-muted">No hay datos</td></tr>';
        } else {
            data.forEach((item, index) => {
                if (tipo === 'inventario') {
                    html += `<tr>
                        <td>${item.id}</td>
                        <td>${item.producto?.nombre || 'N/A'}</td>
                        <td>${item.cantidad}</td>
                        <td>${item.cantidad_minima}</td>
                        <td>${new Date(item.fecha_actualizacion).toLocaleDateString()}</td>
                    </tr>`;
                } else if (tipo === 'ventas') {
                    html += `<tr>
                        <td>${item.id}</td>
                        <td>${item.producto?.nombre || 'Venta'}</td>
                        <td>${item.detalles?.length || 1}</td>
                        <td>$${parseFloat(item.total).toFixed(2)}</td>
                        <td>${new Date(item.created_at).toLocaleDateString()}</td>
                    </tr>`;
                } else if (tipo === 'stock') {
                    html += `<tr>
                        <td>${index + 1}</td>
                        <td>${item.producto}</td>
                        <td>${item.cantidad}</td>
                        <td>Mínimo: ${item.minima}</td>
                        <td>Falta: ${item.diferencia}</td>
                    </tr>`;
                }
            });
        }

        tbody.innerHTML = html;
    }

    function actualizarResumen(data, tipo) {
        if (tipo === 'inventario') {
            document.getElementById('productosStock').textContent = data.length;
        } else if (tipo === 'ventas') {
            const total = data.reduce((sum, item) => sum + parseFloat(item.total), 0);
            document.getElementById('totalVentas').textContent = '$' + total.toFixed(2);
            document.getElementById('totalTransacciones').textContent = data.length;
        }
    }

    function crearGraficoCategoria(data) {
        const ctx = document.getElementById('chartCategoria').getContext('2d');
        
        if (chartCategoria) {
            chartCategoria.destroy();
        }

        const labels = Object.keys(data);
        const valores = Object.values(data).map(d => d.total);

        chartCategoria = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: valores,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#30d8d8ff', '#66d4ffff',
                        '#FF9F40', '#2ba3f3ff', '#C9CBCF'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    }

    function crearGraficoEmpleado(data) {
        const ctx = document.getElementById('chartEmpleado').getContext('2d');
        
        if (chartEmpleado) {
            chartEmpleado.destroy();
        }

        const labels = Object.keys(data);
        const valores = Object.values(data).map(d => d.total);

        chartEmpleado = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Ventas ($)',
                    data: valores,
                    backgroundColor: '#36A2EB'
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    function crearGraficoTendencia(data) {
        const ctx = document.getElementById('chartTendencia').getContext('2d');
        
        if (chartTendencia) {
            chartTendencia.destroy();
        }

        const labels = Object.keys(data);
        const valores = Object.values(data);

        chartTendencia = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventas Diarias ($)',
                    data: valores,
                    borderColor: '#63faffff',
                    backgroundColor: 'rgba(33, 201, 201, 0.62)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                }
            }
        });
    }

    function limpiarFiltros() {
        document.getElementById('filtrosForm').reset();
        document.getElementById('tipoReporte').value = '';
        cambiarReporte();
        document.querySelector('#datosTable tbody').innerHTML = 
            '<tr><td colspan="5" class="text-center text-muted">Selecciona un reporte</td></tr>';
    }

    function exportarDatos() {
        alert('Funcionalidad de exportación en desarrollo');
    }

    // Establecer fechas por defecto
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const startDate = new Date(today.getTime() - 30 * 24 * 60 * 60 * 1000);
        
        document.getElementById('fecha_fin').valueAsDate = today;
        document.getElementById('fecha_inicio').valueAsDate = startDate;
    });
</script>


<style>
    .border-left-primary {
        border-left: 0.25rem solid #69a2dfff;
    }
    .border-left-success {
        border-left: 0.25rem solid #108e92ff;
    }
    .border-left-warning {
        border-left: 0.25rem solid #169ed4ff;
    }
    .border-left-info {
        border-left: 0.25rem solid #17a2b8;
    }
    .text-primary { color: #007bff; }
    .text-success { color: #20a3a3ff; }
    .text-warning { color: #0dbfc5ff; }
    .text-info { color: #17a2b8; }
</style>
@endsection


