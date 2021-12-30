<?php

namespace App\Http\Controllers;

use App\Models\Entrenador;
use Illuminate\Http\Request;

class EntrenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Entrenador::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entrenador/altaEntenador');
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
            'dni' => 'required|string|unique:entrenadors|max:9',
            'nombre' => 'required|string|max:20',
            'apellidos' => 'required|string|max:40',
            'puesto' => 'required|string|max:20',
            'equipo' => 'required|integer',
        ]);
        $entrenadorAdd = new Entrenador;
        $entrenadorAdd->dni = $request->dni;
        $entrenadorAdd->nombre = $request->nombre;
        $entrenadorAdd->apellidos = $request->apellidos;
        $entrenadorAdd->puesto = $request->puesto;
        $entrenadorAdd->equipo = $request->equipo;
        $entrenadorAdd->save();
        return back()->with('alta', 'Entrenador dado de Alta');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Entrenador $entrenadore
     * @return \Illuminate\Http\Response
     */
    public function show(Entrenador $entrenadore)
    {
        $entrenadores = Entrenador::all();
        return view('entrenador/listadoEntrenadores')->with('entrenadores', $entrenadores);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Entrenador $entrenadore
     * @return \Illuminate\Http\Response
     */
    public function edit(Entrenador $entrenadore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Entrenador $entrenadore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrenador $entrenadore)
    {
        $validator = $this->validate($request, [
            'dni' => 'required|string|unique:entrenadors|max:9',
            'nombre' => 'required|string|max:20',
            'apellidos' => 'required|string|max:40',
            'puesto' => 'required|string|max:20',
            'equipo' => 'required|integer',
        ]);
        $entrenadore->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Entrenador $entrenadore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrenador $entrenadore)
    {
        $entrenadore->delete();
    }
}
