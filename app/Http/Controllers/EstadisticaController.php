<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estadistica;

class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Estadistica::all();
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
            'partidos_jug' => 'required|integer',
            'goles' => 'required|integer',
            'asistencias' => 'required|integer',
            'ciclo_tarjetas' => 'required|integer',
            'jugadors' => 'required|integer',
        ]);
        $estadisticaAdd = new Estadistica;
        $estadisticaAdd->partidos_jug = $request->partidos_jug;
        $estadisticaAdd->goles = $request->goles;
        $estadisticaAdd->asistencias = $request->asistencias;
        $estadisticaAdd->ciclo_tarjetas = $request->ciclo_tarjetas;
        $estadisticaAdd->jugadors = $request->jugadors;
        $estadisticaAdd->save();
        return back()->with('alta', 'Estadistica Creada');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Estadistica $estadistica
     * @return \Illuminate\Http\Response
     */
    public function show(Estadistica $estadistica)
    {
        $estadisticas = Estadistica::all();
        return view('estadistica/listadoEstadisticas')->with('estadisticas', $estadisticas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Estadistica $estadistica
     * @return \Illuminate\Http\Response
     */
    public function edit(Estadistica $estadistica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadistica $estadistica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estadistica $estadistica)
    {
        $validator = $this->validate($request, [
            'partidos_jug' => 'required|integer',
            'goles' => 'required|integer',
            'asistencias' => 'required|integer',
            'ciclo_tarjetas' => 'required|integer',
            'jugadors' => 'required|integer',
        ]);
        $estadistica->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Estadistica $estadistica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estadistica $estadistica)
    {
        $estadistica->delete();
    }
}
