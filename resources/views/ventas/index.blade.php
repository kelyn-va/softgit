@extends('adminlte::page')

@section('title', 'Ventas')

{{-- Estilos personalizados para el look limpio y azul pastel --}}
@section('css')
<style>
    /* --- VARIABLES DE ESTILO LIMPIO Y AZUL PASTEL --- */
    :root {
        --primary-soft-blue: #007bff; /* Azul primario de AdminLTE (Mantenido) */
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
        background-color: white !important; /* Fondo blanco para el encabezado de la tarjeta */
        border-bottom: 1px solid var(--card-border) !important;
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
        color: var(--text-dark);
        font-weight: 700;
    }

    /* Estilo del botón principal (Registrar Venta) */
    .btn-action-primary {
        background-color: var(--primary-soft-blue) !important;
        border-color: var(--primary-soft-blue) !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 8px 15px !important;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }
    .btn-action-primary:hover {
        background-color: #0056b3 !important;
        border-color: #0056b3 !important;
    }

    /* Estilo de la tabla */
    #ventasTable thead {
        background-color: var(--header-bg) !important; /* Azul pastel para la cabecera */
        color: var(--text-dark) !important;
    }
    #ventasTable thead th {
        border-color: #c4daee !important;
        font-weight: 600;
        text-transform: uppercase;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: var(--light-blue-bg) !important; /* Rayas sutiles */
    }

    /* Estilo de los Badges (Método de Pago) */
    .badge-info {
        background-color: #66b3ff !important; /* Azul más claro para el badge */
        color: white !important;
        font-weight: 600;
    }

    /* Estilo del Modal de Detalle */
    .modal-header {
        background-color: var(--primary-soft-blue) !important;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .modal-header .close {
        color: white !important;
        opacity: 1;
    }
    .table-bordered {
        border-color: var(--card-border) !important;
    }
    .table-light {
        background-color: var(--header-bg) !important;
    }
    
    /* Pequeña corrección al alert de AdminLTE para que se vea más limpio */
    .alert-success {
        background-color: #e6ffed !important;
        border-color: #b3e6c6 !important;
        color: #155724 !important; /* Color de texto verde oscuro */
    }
</style>
@stop

@section('content_header')
    <h1 class="fw-bold text-dark">Listado de Ventas</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Gestión de Ventas</h3>
        <a href="{{ route('ventas.create') }}" class="btn btn-action-primary d-inline-flex align-items-center gap-2">
            <i class="fas fa-plus"></i> Registrar Venta
        </a>
    </div>

    <div class="card-body">

        {{-- Mensaje de Éxito adaptado al nuevo estilo --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        @if($ventas->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> No hay ventas registradas
            </div>
        @else

            <div class="table-responsive">
                <table class="table table-striped table-hover" id="ventasTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Empleado</th>
                            <th>Método Pago</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ventas as $v)
                        <tr>
                            <td>#{{ $v->id }}</td>
                            <td>{{ $v->empleado->nombre }}</td>

                            <td>
                                <span class="badge badge-info">{{ ucfirst($v->metodo_pago) }}</span>
                            </td>

                            <td>${{ number_format($v->total, 2) }}</td>

                            <td>
                                {{ $v->created_at->format('d/m/Y') }} <br>
                                <small class="text-muted">{{ $v->created_at->format('H:i') }}</small>
                            </td>

                            <td class="text-center">
                                <button class="btn btn-info btn-sm"
                                        data-toggle="modal"
                                        data-target="#detalleVenta{{ $v->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif

    </div>
</div>

{{-- =============================
    MODALES DE DETALLE (fuera de la tabla)
    ============================= --}}
@foreach($ventas as $v)
<div class="modal fade" id="detalleVenta{{ $v->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-receipt"></i> Detalle de Venta #{{ $v->id }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p><strong><i class="fas fa-user-tie"></i> Empleado:</strong> {{ $v->empleado->nombre }}</p>
                <p><strong><i class="fas fa-money-check-alt"></i> Método Pago:</strong> {{ ucfirst($v->metodo_pago) }}</p>
                <p><strong><i class="fas fa-calendar-alt"></i> Fecha:</strong> {{ $v->created_at->format('d/m/Y H:i') }}</p>

                <hr>

                <h5><strong><i class="fas fa-shopping-basket"></i> Productos Vendidos</strong></h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($v->detalles as $d)
                            <tr>
                                <td>{{ $d->producto->nombre }}</td>
                                <td>{{ $d->cantidad }}</td>
                                <td class="text-right">${{ number_format($d->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h4 class="text-right mt-3">
                    <strong>Total Final: ${{ number_format($v->total, 2) }}</strong>
                </h4>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>
@endforeach

@stop

@section('js')
<script>
    // Configuración opcional para DataTables si la estás usando
    // $('#ventasTable').DataTable(); 
    
    // Ocultar la alerta de éxito después de 5 segundos
    setTimeout(() => { $('.alert').fadeOut('slow'); }, 5000);
</script>
@stop