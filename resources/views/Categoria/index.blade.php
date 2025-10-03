@extends('layouts.app')

@section('title', 'Administrar Categorias')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Categorias</h1>
@endsection

@section('Content')

<style>
    /* Fondo degradado animado */
    body {
        background: linear-gradient(-45deg,
                #a8edea,
                /* azul pastel */
                #fed6e3,
                /* rosa pastel */
                #cfd9df,
                /* gris pastel */
                #d7fbe8,
                /* verde menta pastel */
                #e0c3fc
                /* lila pastel */
            );
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    /* Estilo tarjeta */
    .custom-card {
        transition: all 0.3s ease-in-out;
        border-radius: 20px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        background-color: #ffffffcc;
        backdrop-filter: blur(8px);
    }

    .custom-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 18px rgba(0, 0, 0, 0.12);
    }

    /* Botones */
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

    .volverBtn {
        border-radius: 12px;
        font-weight: 500;
        background-color: #8ecae6;
        color: #fff;
        padding: 6px 12px;
        text-decoration: none;
        transition: 0.3s;
        font-size: 0.85rem;
    }

    .volverBtn:hover {
        background-color: #219ebc;
        color: #fff;
    }

    .iconBtn {
        font-size: 1rem;
    }

    .search-box {
        max-width: 300px;
    }
</style>


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

        <form action="{{ route('categorias.index') }}" method="GET" class="d-flex search-box">

        </form>

        <a href="{{ route('categorias.create') }}" class="crearBtn d-flex align-items-center gap-2">
            ➕<i class="bi bi-plus-circle"></i> Crear Categoria
        </a>
    </div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle text-center mb-0">
                <thead style="background: #a8dadc; color:#fff;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)


                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btnActualizar d-flex gap-2 align-items-center">
                                    ✏️ <i class="bi bi-pencil-square"></i> Actualizar
                                </a>

                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirmarEliminacion(event)">
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