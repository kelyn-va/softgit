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
    public function index()
    {
        $clientes = Clientes::all();
        return view('Cliente.index',compact('clientes'));
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
    public function update(  ClienteRequest $request,$id)
    {
        $cliente = Clientes::findorfail($id);
        $cliente->update($request->all());
        return redirect()->route('Cliente.index')->with('success', 'Cliente  Actualizado  correctamente.');
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