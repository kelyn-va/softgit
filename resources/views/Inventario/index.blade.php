@extends('layouts.app')

@section('title', 'Administrar Inventario')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Inventario</h1>
@endsection

@section('Content')

<style>
    /* Fondo degradado animado */
    body {
        background: linear-gradient(-45deg, 
            #a8edea,   /* azul pastel */
            #fed6e3,   /* rosa pastel */
            #cfd9df,   /* gris pastel */
            #d7fbe8,   /* verde menta pastel */
            #e0c3fc    /* lila pastel */
        );
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Estilo tarjeta */
    .custom-card {
        transition: all 0.3s ease-in-out;
        border-radius: 20px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.08);
        background-color: #ffffffcc;
        backdrop-filter: blur(8px);
    }

    .custom-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 18px rgba(0,0,0,0.12);
    }

    /* Botón crear */
    .crearBtn {
        border-radius: 12px;
        font-weight: 500;
        background-color: #a8dadc;
        color: #fff;
        padding: 8px 14px;
        text-decoration: none;
        transition: 0.3s;
    }
    .crearBtn:hover {
        background-color: #457b9d;
        color: #fff;
    }

    /* Botón actualizar */
    .btnActualizar {
        border-radius: 12px;
        font-weight: 500;
        background-color: #ffd166;
        color: #333;
        padding: 6px 12px;
        text-decoration: none;
        transition: 0.3s;
    }
    .btnActualizar:hover {
        background-color: #f4a261;
        color: #fff;
    }

    /* Botón eliminar */
    .btnEliminar {
        border-radius: 12px;
        font-weight: 500;
        background-color: #ef476f;
        color: #fff;
        padding: 6px 12px;
        border: none;
        transition: 0.3s;
    }
    .btnEliminar:hover {
        background-color: #d62828;
    }

    /* Icono regresar */
    .iconBack {
        font-size: 1.8rem;
        color: #333;
        transition: 0.3s;
    }
    .iconBack:hover {
        color: #457b9d;
        transform: scale(1.1);
    }

    /* Tabla personalizada */
    .custom-table thead {
        background: linear-gradient(90deg, #a8edea, #e0c3fc, #fed6e3);
        color: #333;
        font-weight: bold;
        border-radius: 12px 12px 0 0;
    }
    .custom-table th {
        padding: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .custom-table tbody tr {
        transition: background-color 0.3s ease;
    }
    .custom-table tbody tr:hover {
        background-color: rgba(168, 237, 234, 0.3);
    }
    .custom-table td {
        padding: 12px;
        vertical-align: middle;
    }
</style>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
        <a href="{{route('welcome')}}" >
            🔙<i class="bi bi-arrow-left iconBack">Volver </i>
        </a>

        <a href="{{route('inventario.create')}}" class="crearBtn">
            ➕<i class="bi bi-plus-circle"></i> Crear Inventario
        </a>

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
    </div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-hover align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>cantidad</th>
                        <th>fecha de Actualizacion</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inventarios as $Inventario)
                        <tr>
                            <td>{{ $Inventario->id }}</td>
                            <td>{{ $Inventario->Cantidad }}</td>
                            <td>{{ $Inventario->FechaActualizacion }}</td>
                            
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{route('inventario.edit', $Inventario->id)}}" class="btnActualizar d-flex gap-2 align-items-center">
                                        <i class="bi bi-pencil-square"></i> Actualizar
                                    </a>

                                    <form action="{{route('inventario.destroy', $Inventario->id)}}" method="POST" onclick="confirmarEliminacion(event)">
                                        @csrf
                                        <button type="submit" class="btnEliminar d-flex gap-2 align-items-center">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">No hay inventarios registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

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