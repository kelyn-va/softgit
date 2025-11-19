<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\Clientes;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class ClienteController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    // Filtros
    $search = $request->get('search');
    $telefono = $request->get('telefono');
    $direccion = $request->get('direccion');
    $correoDominio = $request->get('correoDominio');
    $fechaInicio = $request->get('fechaInicio');
    $fechaFin = $request->get('fechaFin');
    $sort = $request->get('sort', 'Nombre');
    $direction = $request->get('direction', 'asc');

    // Consulta base
    $query = Clientes::query();

    // Búsqueda general
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('Nombre', 'LIKE', "%{$search}%")
              ->orWhere('Telefono', 'LIKE', "%{$search}%")
              ->orWhere('Email', 'LIKE', "%{$search}%")
              ->orWhere('Direccion', 'LIKE', "%{$search}%");
        });
    }

    // Teléfono
    if ($telefono) {
        $query->where('Telefono', 'LIKE', "%{$telefono}%");
    }

    // Dirección
    if ($direccion) {
        $query->where('Direccion', 'LIKE', "%{$direccion}%");
    }

    // Dominio correo
    if ($correoDominio) {
        $query->where('Email', 'LIKE', "%@{$correoDominio}%");
    }

    // Fechas
    if ($fechaInicio && $fechaFin) {
        $query->whereBetween('created_at', [$fechaInicio, $fechaFin]);
    } elseif ($fechaInicio) {
        $query->whereDate('created_at', '>=', $fechaInicio);
    } elseif ($fechaFin) {
        $query->whereDate('created_at', '<=', $fechaFin);
    }

    // Orden
    $query->orderBy($sort, $direction);

    // Paginación (YA NO LO REEMPLACES)
    $clientes = $query->paginate(10)->appends($request->query());

    return view('Cliente.index', compact('clientes'));
}  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteRequest $request)
    {
        Clientes::create(
            $request->all()

        );
        return redirect()->route('clientes.index')->with('success','cliente  creado correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Clientes::findorfail($id);
        return view('Cliente.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request,$id)
    {
        $cliente = Clientes::findorfail($id);
        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente  Actualizado  correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente =Clientes::findorfail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente  eliminado  correctamente.');

    }
}