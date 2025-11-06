<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventarioRequest;
use App\Models\inventario;
use App\Models\Iventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventarios= Inventario::all();
        return view('inventario.index',compact('inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventarioRequest $request)
    {
        Inventario::create(
            $request->all()
        );

        return redirect()->route('inventario.index') ->with('success', 'Inventario registrado correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(inventario $iventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $inventarios= inventario::findorFail($id);
        return view('inventario.edit',compact('inventarios'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(InventarioRequest $request,$id)
    {
        $inventarios = Inventario::findorFail($id);
        $inventarios->update($request->all());

        return redirect()->route('inventario.index')->with('success', 'inventario Actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $inventarios = Inventario::findorFail($id);
        $inventarios->delete();

        return redirect()->route('inventario.index')->with('success', 'Inventario eliminado  correctamente.');
    }
}
