@extends('layouts.app')

@section('title')
    Bienvenido
@endsection

@section('titleContent')
    <div class="text-center my-5">
        <h1 class="fw-bold display-4 text-dark"> Bienvenido a Softgit</h1>
        <p class="text-muted">Accede fácilmente a las secciones principales del sistema</p>
    </div>
@endsection

@section('Content')

<style>
    body {
        background: linear-gradient(-45deg, 
            #a8edea,
            #fed6e3,
            #cfd9df,
            #d7fbe8,
            #e0c3fc
        );
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .custom-card {
        transition: all 0.3s ease-in-out;
        border-radius: 20px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.08);
        background-color: #ffffffcc;
        backdrop-filter: blur(8px);
    }

    .custom-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 20px rgba(0,0,0,0.15);
    }

    .custom-btn {
        border-radius: 12px;
        font-weight: 500;
        background-color: #a8dadc;
        color: #fff;
        border: none;
    }

    .custom-btn:hover {
        background-color: #457b9d;
        color: #fff;
    }
</style>

<div class="container py-4">
    <div class="row g-4 justify-content-center">

        {{-- Inventario --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card custom-card h-100 border-0">
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <h6 class="card-title fw-bold text-dark">🧺 Inventario</h6>
                    <p class="card-text text-muted">Administra el stock y niveles de productos disponibles.</p>
                    <a href="{{route('inventario.index')}}" class="btn custom-btn w-100 mt-auto">Ver Inventario</a>
                </div>
            </div>
        </div>

        {{-- Clientes --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card custom-card h-100 border-0">
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <h6 class="card-title fw-bold text-dark">👥 Clientes</h6>
                    <p class="card-text text-muted">Gestiona los datos y relaciones con tus clientes.</p>
                    <a href="{{route('Cliente.index')}}" class="btn custom-btn w-100 mt-auto">Ver Clientes</a>
                </div>
            </div>
        </div>

        {{-- Proveedores --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card custom-card h-100 border-0">
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <h6 class="card-title fw-bold text-dark">📦 Proveedores</h6>
                    <p class="card-text text-muted">Controla y administra tus proveedores.</p>
                    <a href="" class="btn custom-btn w-100 mt-auto">Ver Proveedores</a>
                </div>
            </div>
        </div>

        {{-- Productos --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card custom-card h-100 border-0">
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <h6 class="card-title fw-bold text-dark">🛍️ Productos</h6>
                    <p class="card-text text-muted">Administra el catálogo de productos disponibles.</p>
                    <a href="" class="btn custom-btn w-100 mt-auto">Ver Productos</a>
                </div>
            </div>
        </div>

        {{-- Categorías --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card custom-card h-100 border-0">
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <h6 class="card-title fw-bold text-dark">🗂️ Categorías</h6>
                    <p class="card-text text-muted">Clasifica tus productos por categorías.</p>
                    <a href="{{route('categorias.index')}}" class="btn custom-btn w-100 mt-auto">Ver Categorías</a>
                </div>
            </div>
        </div>

        {{-- Ventas --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card custom-card h-100 border-0">
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <h6 class="card-title fw-bold text-dark">💰 Ventas</h6>
                    <p class="card-text text-muted">Consulta y administra tus ventas.</p>
                    <a href="" class="btn custom-btn w-100 mt-auto">Ver Ventas</a>
                </div>
            </div>
        </div>

        {{-- Pagos --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card custom-card h-100 border-0">
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <h6 class="card-title fw-bold text-dark">💳 Pagos</h6>
                    <p class="card-text text-muted">Gestiona pagos realizados y pendientes.</p>
                    <a href="" class="btn custom-btn w-100 mt-auto">Ver Pagos</a>
                </div>
            </div>
        </div>

        {{-- turnos --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card custom-card h-100 border-0">
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <h6 class="card-title fw-bold text-dark"> 🕒 turnos</h6>
                    <p class="card-text text-muted">Controla los turnos del personal de tu empresa.</p>
                    <a href="{{route('turno.index')}}" class="btn custom-btn w-100 mt-auto">Ver turnos</a>
                </div>
            </div>
        </div>




        {{-- Empleados --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card custom-card h-100 border-0">
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <h6 class="card-title fw-bold text-dark">👨‍💼 Empleados</h6>
                    <p class="card-text text-muted">Controla los datos del personal de tu empresa.</p>
                    <a href="" class="btn custom-btn w-100 mt-auto">Ver Empleados</a>
                </div>
            </div>
        </div>

        {{-- Auditoría --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card custom-card h-100 border-0">
                <div class="card-body d-flex flex-column align-items-center text-center p-4">
                    <h6 class="card-title fw-bold text-dark">🕵️‍♂️ Auditoría</h6>
                    <p class="card-text text-muted">Consulta los registros de cambios del sistema.</p>
                    <a href="" class="btn custom-btn w-100 mt-auto">Ver Auditoría</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection