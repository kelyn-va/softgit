@extends('layouts.app')

@section('title', 'Crear Empleado')

@section('titleContent')
<h1 class="text-center my-4 fw-bold text-dark">Crear Empleado</h1>
@endsection

@section('content')


<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            {{-- Botón de volver --}}
            <div class="mb-3 text-start">
                <a href="{{ route('empleados.index') }}" class="volverBtn d-inline-flex align-items-center gap-1">
                    🔙 <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>

            {{-- Tarjeta del formulario --}}
            <div class="card custom-card shadow-lg border-0">
                <div class="card-body p-4">

                    <form action="{{ route('empleados.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold">nombre</label>
                            <input type="text" id="nombre" name="nombre"
                                class="form-control @error('nombre') is-invalid @enderror">
                            @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cargo" class="form-label fw-semibold">cargo</label>
                            <input type="text" id="cargo" name="cargo"
                                class="form-control @error('cargo') is-invalid @enderror">
                            @error('cargo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="usuario" class="form-label fw-semibold">usuario</label>
                            <input type="text" id="usuario" name="usuario"
                                class="form-control @error('usuario') is-invalid @enderror">
                            @error('usuario')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contraseña" class="form-label fw-semibold">contraseña</label>
                            <input type="text" id="contraseña" name="contraseña"
                                class="form-control @error('contraseña') is-invalid @enderror">
                            @error('contraseña')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="mb-3">
                            <label for="idTurno" class="form-label fw-semibold">idTurno</label>
                            <select id="idTurno" name="idTurno"
                                class="form-select @error('idTurno') is-invalid @enderror">
                                <option value="">-- Selecciona un turno --</option>
                                @foreach ( $turnos as  $turno)
                                    
                                <option value=" {{$turno->id }}">{{$turno->id }}</option>
                              @endforeach
                            </select>
                                
                                
                            @error('idTurno')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>





                        <div class="text-end">
                            <button type="submit" class="crearBtn">
                                ➕ <i class="bi bi-person-plus"></i> Crear Empleado
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection