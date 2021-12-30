<?php

namespace App\Http\Controllers;

use App\Models\Arbitro;
use Illuminate\Http\Request;
use App\Models\Medico;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Medico::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->validate($request, [
            'dni' => 'required|string|unique:medicos|max:9',
            'nombre' => 'required|string|max:20',
            'apellidos' => 'required|string|max:40',
            'puesto' => 'required|string|max:255',
            'equipo' => 'required|integer',
        ]);
        $medicoAdd = new Medico;
        $medicoAdd->dni = $request->dni;
        $medicoAdd->nombre = $request->nombre;
        $medicoAdd->apellidos = $request->apellidos;
        $medicoAdd->puesto = $request->puesto;
        $medicoAdd->equipo = $request->equipo;
        $medicoAdd->save();
        return back()->with('alta', 'Medico dado de Alta');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Medico $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Medico $medico)
    {
        $medicos = Medico::all();
        return view('medico/listadoMedicos')->with('medicos', $medicos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Medico $medico
     * @return \Illuminate\Http\Response
     */
    public function edit(Medico $medico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Medico $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medico $medico)
    {
        $validator = $this->validate($request, [
            'dni' => 'required|string|unique:medicos|max:9',
            'nombre' => 'required|string|max:20',
            'apellidos' => 'required|string|max:40',
            'puesto' => 'required|string|max:255',
            'equipo' => 'required|integer',
        ]);
        $medico->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Medico $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medico)
    {
        $medico->delete();
    }
}
