<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorRequest;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores= Proveedor::all();
        return view('Proveedor.index',compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProveedorRequest $request)
    {
        Proveedor::create($request->all());


        return redirect()->route('proveedor.index')->with('success', 'Proveedor creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $Proveedor=Proveedor::findorFail($id);

        return view('Proveedor.edit',compact('Proveedor'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProveedorRequest $request,$id)
    {
        $proveedores = Proveedor::findorFail($id);
        $proveedores->update($request->all());

        return redirect()->route('proveedor.index')>with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proveedores = Proveedor::findorFail($id);
        $proveedores->delete();

        return redirect()->route('proveedor.index')>with('success', 'Proveedor eliminado  correctamente.');
    }
}