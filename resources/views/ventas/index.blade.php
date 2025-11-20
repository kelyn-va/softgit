@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1 class="fw-bold">Listado de Ventas</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Gestión de Ventas</h3>
        <a href="{{ route('ventas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Registrar Venta
        </a>
    </div>

    <div class="card-body">

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
                    <thead class="table-dark">
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
                <h5><strong>Empleado:</strong> {{ $v->empleado->nombre }}</h5>
                <h5><strong>Método Pago:</strong> {{ ucfirst($v->metodo_pago) }}</h5>
                <h5><strong>Fecha:</strong> {{ $v->created_at->format('d/m/Y H:i') }}</h5>

                <hr>

                <h5><strong>Productos</strong></h5>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($v->detalles as $d)
                        <tr>
                            <td>{{ $d->producto->nombre }}</td>
                            <td>{{ $d->cantidad }}</td>
                            <td>${{ number_format($d->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h4 class="text-right mt-3">
                    <strong>Total: ${{ number_format($v->total, 2) }}</strong>
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
    setTimeout(() => { $('.alert').fadeOut('slow'); }, 5000);
</script>
@stop
