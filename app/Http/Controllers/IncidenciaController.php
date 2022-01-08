<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Incidencia::all();
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
            'tarjeta_amarilla' => 'required|integer',
            'tarjeta_roja' => 'required|integer',
            'gol' => 'required|integer',
            'partido' => 'required|integer',
        ]);
        $incidenciaAdd = new Incidencia;
        $incidenciaAdd->tarjeta_amarilla = $request->tarjeta_amarilla;
        $incidenciaAdd->tarjeta_roja = $request->tarjeta_roja;
        $incidenciaAdd->gol = $request->gol;
        $incidenciaAdd->partido = $request->partido;
        $incidenciaAdd->save();
        return back()->with('creada', 'Hoja Incidencias creada');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Incidencia $incidencia
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencia $incidencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Incidencia $incidencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Incidencia $incidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Incidencia $incidencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencia $incidencia)
    {
        $validator = $this->validate($request, [
            'tarjeta_amarilla' => 'required|integer',
            'tarjeta_roja' => 'required|integer',
            'gol' => 'required|integer',
            'partido' => 'required|integer',
        ]);
        $incidencia->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Incidencia $incidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencia $incidencia)
    {
        $incidencia->delete();
    }
}
