@extends('layouts.app')

@section('title', 'Crear Auditoría')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Registrar Auditoría</h1>
@endsection

@section('content')

<div class="overlay-modal">
    <div class="modal-card p-4">

        {{-- Botón de volver --}}
        <div class="mb-3 text-start">
            <a href="{{ route('Auditoria.index') }}" class="volverBtn d-inline-flex align-items-center gap-1">
                <i class="bi bi-arrow-left-circle"></i> Volver
            </a>
        </div>

        {{-- Tarjeta del formulario --}}
        <div class="card custom-card shadow-lg border-0">
            <div class="card-body p-4">

                <form action="{{ route('Auditoria.store') }}" method="POST">
                    @csrf

                    {{-- Campo Acción --}}
                    <div class="mb-3">
                        <label for="Accion" class="form-label fw-semibold">Acción</label>
                        <input type="text" id="Accion" name="Accion"
                            class="form-control @error('Accion') is-invalid @enderror"
                            placeholder="Ejemplo: Apertura de caja, cierre, modificación...">
                        @error('Accion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo Fecha --}}
                    <div class="mb-3">
                        <label for="fecha" class="form-label fw-semibold">Fecha</label>
                        <input type="date" id="fecha" name="fecha"
                            class="form-control @error('fecha') is-invalid @enderror">
                        @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo Cierre de Caja --}}
                    <div class="mb-3">
                        <label for="cierreCaja" class="form-label fw-semibold">Cierre de Caja</label>
                        <input type="number" step="0.01" id="cierreCaja" name="cierreCaja"
                            class="form-control @error('cierreCaja') is-invalid @enderror"
                            placeholder="Ejemplo: 250000.00">
                        @error('cierreCaja')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Campo ID Empleado --}}
                    <div class="mb-3">
                        <label for="idEmpleado" class="form-label fw-semibold">Empleado Responsable</label>
                        <select id="idEmpleado" name="idEmpleado"
                            class="form-select @error('idEmpleado') is-invalid @enderror">
                            <option value="" selected disabled>Seleccione un empleado</option>
                            @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}">{{ $empleado->Nombre }}</option>
                            @endforeach
                        </select>
                        @error('idEmpleado')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="crearBtn">
                            <i class="bi bi-journal-plus"></i> Registrar Auditoría
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection