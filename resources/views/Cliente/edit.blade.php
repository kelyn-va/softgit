@extends('layouts.app')

@section('title', 'Actializar Cliente')

@section('titleContent')
    <h1 class="text-center my-4 fw-bold text-dark">Actualizar Cliente</h1>
@endsection

@section('content')


<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

           
            <div class="mb-3 text-start">
                <a href="{{ route('clientes.index') }}" class="volverBtn d-inline-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left-circle"></i>  🔙 Volver
                </a>
            </div>

         
            <div class="card custom-card shadow-lg border-0">
                <div class="card-body p-4">

                    <form action="{{route('clientes.update',$cliente->id)}}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="Nombre" class="form-label fw-semibold">  Nombre</label>
                            <input type="text" id="Nombre" name="Nombre" 
                                   class="form-control @error('Nombre') is-invalid @enderror" value="{{$cliente->Nombre}}">
                            @error('Nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Telefono" class="form-label fw-semibold"> Teléfono</label>
                            <input type="text" id="Telefono" name="Telefono" 
                                   class="form-control @error('Telefono') is-invalid @enderror" value="{{$cliente->Telefono}}">
                            @error('Telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Email" class="form-label fw-semibold">Email</label>
                            <input type="text" id="Email" name="Email" 
                                   class="form-control @error('Email') is-invalid @enderror" value="{{$cliente->Email}}">
                            @error('Email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Direccion" class="form-label fw-semibold">  Dirección</label>
                            <input type="text" id="Direccion" name="Direccion" 
                                   class="form-control @error('Direccion') is-invalid @enderror" value="{{$cliente->Direccion}}">
                            @error('Direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="crearBtn">
                                <i class="bi bi-person-plus"></i> Actualizar Cliente
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection