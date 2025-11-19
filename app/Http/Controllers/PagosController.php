<?php

namespace App\Http\Controllers;

use App\Models\metodoPago;
use App\Models\pagos;
use App\Models\ventas;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = pagos::all();
        return view('pagos.index', compact('pagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $ventas = ventas::all();
        $metodoPago = metodoPago::all();
        return view('pagos.create',compact('ventas','metodoPago' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        pagos::create(
            $request->all()
        );

        return redirect()->route('pagos.index')->with('success', 'Pago creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(pagos $pagos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pagos = pagos::findorfail($id);
        return view('pagos.edit',compact('pagos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $pagos  = pagos::findorfail($id);
        $pagos ->update($request->all());
        return redirect()->route('pagos.index')->with('success', 'Pago actualizado exitosamente.'); 
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pagos = pagos::findorfail($id);
        $pagos -> delete();
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado correctamente.');
        
    }
}
