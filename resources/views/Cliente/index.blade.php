@extends('layouts.app')

@section('title', 'Administrar Clientes')

@section('titleContent')
    <header class="encabezado-clientes shadow-sm">
        <h1>Gestión de Clientes</h1>
        <p>Administra los datos de tus clientes fácilmente</p>
    </header>
@endsection

@section('content')
{{-- 🔍 FORMULARIO DE FILTROS --}}
    <form method="GET" action="{{ route('clientes.index') }}" class="card card-body mb-4">

        <div class="row g-3">

            {{-- Búsqueda general --}}
            <div class="col-md-4">
                <label class="form-label">Buscar</label>
                <input type="text" name="search" class="form-control"
                       value="{{ request('search') }}"
                       placeholder="Nombre, teléfono, email, dirección...">
            </div>

            {{-- Teléfono --}}
            <div class="col-md-4">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control"
                       value="{{ request('telefono') }}">
            </div>

            {{-- Dirección --}}
            <div class="col-md-4">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control"
                       value="{{ request('direccion') }}">
            </div>

            {{-- Dominio del correo --}}
            <div class="col-md-4">
                <label class="form-label">Dominio del correo</label>
                <input type="text" name="correoDominio" class="form-control"
                       placeholder="ej: gmail.com"
                       value="{{ request('correoDominio') }}">
            </div>

            {{-- Fecha inicio --}}
            <div class="col-md-4">
                <label class="form-label">Fecha Inicio</label>
                <input type="date" name="fechaInicio" class="form-control"
                       value="{{ request('fechaInicio') }}">
            </div>

            {{-- Fecha fin --}}
            <div class="col-md-4">
                <label class="form-label">Fecha Fin</label>
                <input type="date" name="fechaFin" class="form-control"
                       value="{{ request('fechaFin') }}">
            </div>

        </div>

        <div class="mt-3 d-flex gap-2">
            <button class="btn btn-primary">
                <i class="bi bi-funnel"></i> Filtrar
            </button>

            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Limpiar
            </a>
        </div>

    </form>

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

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('clientes.create') }}" class="crearBtn"> Crear Cliente</a>
    </div>

    <div class="card custom-card shadow-lg border-0">
        <div class="card-body">
            <table id="myTable" class="table table-striped table-hover align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->Nombre }}</td>
                            <td>{{ $cliente->Telefono }}</td>
                            <td>{{ $cliente->Email }}</td>
                            <td>{{ $cliente->Direccion }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btnActualizar">
                                         Actualizar
                                    </a>

                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onclick="confirmarEliminacion(event)">
                                        @csrf
                                      
                                        <button type="submit" class="btnEliminar">
                                             Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">No hay clientes registrados</td>
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

{{-- DataTables con Bootstrap 4 --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
{{-- DataTables con Bootstrap 4 --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

<!-- script de datatables -->
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            responsive: true,
            autoWidth: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
            }
        });
    });
</script>
@endsection
