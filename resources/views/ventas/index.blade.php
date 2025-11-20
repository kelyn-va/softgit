@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1>Listado de Ventas</h1>
@stop

@section('content')
    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">Registrar Venta</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Empleado</th>
                <th>Método Pago</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>
            @foreach($ventas as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->producto->nombre }}</td>
                <td>{{ $v->empleado->nombre }}</td>
                <td>{{ ucfirst($v->metodo_pago) }}</td>
                <td>${{ number_format($v->total, 2) }}</td>
                <td>{{ $v->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
