<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetodoPagoRequest;
use App\Models\metodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodoPago = metodoPago::all();
        return view ('metodoPago.index', compact('metodoPago'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metodoPago.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MetodoPagoRequest $request)
    {
        metodoPago::create(
            $request->all()
        );

        return redirect()->route('metodoPago.index')->with('success', 'Método de pago creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(metodoPago $metodoPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $metodoPago = metodoPago::findorfail($id);
        return view('metodoPago.edit',compact('metodoPago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MetodoPagoRequest $request,  $id)
    {
        $metodoPago = metodoPago::findorfail($id);
        $metodoPago -> update($request->all());
        return redirect()->route('metodoPago.index')->with('success', 'Método de pago actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $metodoPago= metodoPago::findorfail($id);
        $metodoPago->delete();

        return redirect()->route('metodoPago.index')->with('success', 'Método de pago eliminado correctamente.');
    }
}
