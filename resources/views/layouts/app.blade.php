@extends('adminlte::page')

@section('title', $title ?? 'Dashboard')

{{-- Header corto (título del módulo) --}}
@section('content_header')
    <h1 class="m-0">@yield('page-title', 'SOFTGIT')</h1>
@stop

{{-- Contenido principal --}}
@section('content')
    <div class="container-fluid">
        <div class="row">
            @yield('content')
        </div>
    </div>
@stop

{{-- Estilos personalizados --}}
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/pastel-style.css') }}">
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


<style>
    body {
        background-color: #ffffff;
        font-family: 'Poppins', sans-serif;
    }

    .encabezado-clientes {
        background: linear-gradient(90deg, #7daee8 0%, #5b9de6 100%);
        color: #fff;
        text-align: center;
        padding: 28px 0;
        border-radius: 0 0 18px 18px;
    }

    .encabezado-clientes h1 {
        font-weight: 700;
        font-size: 28px;
        margin: 0;
    }

    .encabezado-clientes p {
        margin: 6px 0 0;
        font-size: 13px;
        opacity: 0.95;
    }

    /* Botón crear */
    .crearBtn {
        background: linear-gradient(90deg, #7daee8, #5b9de6);
        color: #fff;
        border-radius: 10px;
        padding: 8px 14px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: transform .2s ease, box-shadow .2s ease;
        box-shadow: 0 4px 10px rgba(123,180,255,0.25);
    }

    .crearBtn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(91,157,230,0.25);
        background: linear-gradient(90deg, #5b9de6, #3a7edb);
        color: #fff;
    }

    .custom-card {
        background: linear-gradient(180deg, #f5f9ff 0%, #e3efff 100%);
        border-radius: 16px;
        border: 1px solid #c2dbff;
        overflow: hidden;
    }

    thead {
        background: linear-gradient(90deg, #7daee8 0%, #5b9de6 100%);
        color: #fff;
    }

    tbody tr:hover {
        background-color: #e8f2ff;
        transition: background 0.3s ease;
    }

    .btnActualizar, .btnEliminar {
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 13px;
        text-decoration: none;
        color: #fff;
        transition: all .2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btnActualizar {
        background: linear-gradient(90deg, #7daee8, #5b9de6);
    }

    .btnActualizar:hover {
        background: linear-gradient(90deg, #5b9de6, #3a7edb);
        transform: translateY(-2px);
    }

    .btnEliminar {
        background: linear-gradient(90deg, #ff8c8c, #e04f4f);
    }

    .btnEliminar:hover {
        background: linear-gradient(90deg, #e04f4f, #c0392b);
        transform: translateY(-2px);
    }

    footer {
        background: #fff;
        text-align: center;
        padding: 12px;
        color: #4b5563;
        font-size: 13px;
        border-top: 1px solid #e3f2fd;
        margin-top: 40px;
    }

    footer b { color: #5b9de6; }
</style>
@stack('styles')
@stop

{{-- Scripts --}}
@section('js')
<!-- ✅ SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ✅ Bootstrap Bundle JS (incluye Popper para modales) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   




<!-- ✅ Soporte para scripts específicos de las vistas -->
@stack('scripts')


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
@stop

{{-- Footer --}}
@section('footer')
    <div class="text-center custom-footer">
        <div>Realizado por <strong>Karen Julieth Sepulveda Sanchez</strong> - <strong>Vanessa Garcia Corzo</strong></div>
        <div><small>2025</small></div>
    </div>
@stop
