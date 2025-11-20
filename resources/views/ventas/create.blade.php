@extends('adminlte::page')

@section('title', 'Registrar Venta')

@section('content_header')
    <h1>Registrar Venta</h1>
@stop

@section('content')
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Empleado</label>
            <select name="idempleado" class="form-control" required>
                <option value="">Seleccione</option>
                @foreach($empleados as $e)
                    <option value="{{ $e->id }}">{{ $e->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Producto</label>
            <select name="idproducto" class="form-control" required>
                <option value="">Seleccione</option>
                @foreach($productos as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->nombre }} - ${{ number_format($p->precio,2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-2">
            <label>Método de Pago</label>
            <select name="metodo_pago" class="form-control" required>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="transferencia">Transferencia</option>
            </select>
        </div>

        <button class="btn btn-success mt-3">Guardar Venta</button>
    </form>
@stop
