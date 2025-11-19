@extends('layouts.app')

@section('title', 'Administrar Pagos')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Pagos Registrados</h1>
@endsection

@section('content')

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonText: 'Aceptar',
            timer: 3000
        });
    });
</script>
@endif

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
        <a href="{{ route('welcome') }}" class="volverBtn d-flex align-items-center gap-2">
             <i class="bi bi-arrow-left-circle iconBtn"></i> Volver
        </a>

        <form action="{{ route('pagos.index') }}" method="GET" class="d-flex search-box">
            </form>

        <a href="{{ route('pagos.create') }}" class="crearBtn d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> Crear Pago
        </a>
    </div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center mb-0">
                    <thead style="background: #a8dadc; color:#fff;">
                        <tr>
                            <th>ID</th>
                            <th>Monto</th>
                            <th>Venta (ID)</th>
                            <th>Método de Pago</th>
                            <th>Fecha de Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pagos as $pago)
                        <tr>
                            <td>{{ $pago->id }}</td>
                            <td>$ {{ number_format($pago->monto, 2) }}</td>
                            <td>
                                @if ($pago->venta)
                                    {{ $pago->idventa }} ({{ $pago->venta->id ?? 'N/A' }})
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($pago->metodopagos)
                                    {{ $pago->metodopagos->nombre ?? 'Método Desconocido' }}
                                @else
                                    Método Desconocido
                                @endif
                            </td>
                            <td>{{ $pago->created_at->format('d/m/Y') }}</td> 
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('pagos.edit', $pago->id) }}" class="btnActualizar d-flex gap-2 align-items-center">
                                         <i class="bi bi-pencil-square"></i> Actualizar
                                    </a>

                                    <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                        @csrf
                                      
                                             <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No se encontraron pagos.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    {{-- <div class="d-flex justify-content-center mt-4">
        {{ $pagos->links() }}
    </div> --}}

</div>

<script>
  
     
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target;

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection