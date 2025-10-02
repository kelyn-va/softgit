<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turnos= Turno::all();
        return view('Turnos.index',compact('turnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Turnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Turno::create(
            $request->all()
        );

        return redirect()->route('turno.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Turno $turno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $turnos= Turno::findorFail($id);
        return view('Turnos.edit',compact('turnos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $turnos = Turno::findorFail($id);
        $turnos->update($request->all());

        return redirect()->route('turno.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $turnos = Turno::findorFail($id);
        $turnos->delete();

        return redirect()->route('turno.index');
    }
}
