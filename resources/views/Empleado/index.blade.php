@extends('layouts.app')

@section('title', 'Administrar Empleados')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Empleados</h1>
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
            🔙 <i class="bi bi-arrow-left-circle iconBtn"></i> Volver
        </a>

        <form action="{{ route('empleados.index') }}" method="GET" class="d-flex search-box">

        </form>

        <a href="{{ route('empleados.create') }}" class="crearBtn d-flex align-items-center gap-2">
            ➕<i class="bi bi-plus-circle"></i> Crear Empleado
        </a>
    </div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle text-center mb-0">
                <thead style="background: #a8dadc; color:#fff;">
                    <tr>
                        <th>ID</th>
                        <th>nombre</th>
                        <th>cargo</th>
                        <th>usuario</th>
                        <th>contraseña</th>
                        <th>idTurno</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)


                    <tr>
                        <td>{{ $empleado->id }}</td>
                        <td>{{ $empleado->nombre }}</td>
                        <td>{{ $empleado->cargo }}</td>
                        <td>{{ $empleado->usuario }}</td>
                        <td>{{ $empleado->contraseña }}</td>
                        <td>{{ $empleado->idTurno }}</td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('empleados.edit', $empleado->id) }}" class="btnActualizar d-flex gap-2 align-items-center">
                                    ✏️ <i class="bi bi-pencil-square"></i> Actualizar
                                </a>

                                <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
                                    @csrf

                                    <button type="submit" class="btnEliminar d-flex gap-2 align-items-center">
                                        🗑️ <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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