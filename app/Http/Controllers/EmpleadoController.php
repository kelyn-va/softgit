<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpleadoRequest;
use App\Models\Empleado;
use App\Models\Turno;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados=Empleado::all();
        
        return view('Empleado.index',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $turnos=Turno::all();
        return view('Empleado.create',compact('turnos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpleadoRequest $request)
    {
        Empleado::create(
            $request->all()
        );

        return redirect()->route('empleados.index')->with('success', 'Empleado registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $empleados=Empleado::findorFail($id);
        $turnos=Turno::all();
        return view('Empleado.edit',compact('empleados','turnos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpleadoRequest $request,  $id)
    {
        $empleados = Empleado::findorFail($id);
        $empleados->update($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado  Actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $empleados=Empleado::findorFail($id);
        $empleados->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado  eliminado  correctamente.');
    }
}