<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuditoriaRequest;
use App\Models\Auditoria;
use App\Models\Empleado;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auditorias = Auditoria::all();
        $empleados = Empleado::all();
        return view('Auditoria.index', compact('auditorias', 'empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    $empleados = Empleado::all(); // Trae todos los empleados
    return view('Auditoria.create', compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuditoriaRequest $request)

    {

        Auditoria::create(
            $request->all()
        );

        return redirect()->route('Auditoria.index')->with('success', 'Auditoría creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Auditoria $auditoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $auditoria = Auditoria::findorfail($id);
        return  view('Auditoria.index', compact('auditoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuditoriaRequest $request, $id)
    {
        $auditoria = Auditoria::findorfail($id);
        $auditoria->update($request->all());

        return redirect()->route('Auditoria.index')->with('success', 'Auditoría actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $auditoria = Auditoria::findorfail($id);
        $auditoria->delete();

        return redirect()->route('Auditoria.index')->with('success', 'Auditoría eliminada correctamente.');
    }
}
