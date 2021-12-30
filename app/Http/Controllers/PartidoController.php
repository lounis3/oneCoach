<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partido;

class PartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Partido::all();
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
            'fecha' => 'required|date',
            'jornada' => 'required|integer',
            'adversario' => 'required|string|max:40',
            'resultado' => 'required|string|max:5',
            'estadio' => 'required|string|max:40',
            'equipo' => 'required|integer',
        ]);
        $partidoAdd = new Partido();
        $partidoAdd->fecha = $request->fecha;
        $partidoAdd->jornada = $request->jornada;
        $partidoAdd->adversario = $request->adversario;
        $partidoAdd->resultado = $request->resultado;
        $partidoAdd->estadio = $request->estadio;
        $partidoAdd->equipo = $request->equipo;
        $partidoAdd->save();
        return back()->with('alta', 'Partido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Partido $partido
     * @return \Illuminate\Http\Response
     */
    public function show(Partido $partido)
    {
        $partidos = Partido::all();
        return view('partido/listadoPartidos')->with('partidos', $partidos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Partido $partido
     * @return \Illuminate\Http\Response
     */
    public function edit(Partido $partido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Partido $partido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partido $partido)
    {
        $validator = $this->validate($request, [
            'fecha' => 'required|date',
            'jornada' => 'required|integer',
            'adversario' => 'required|string|max:40',
            'resultado' => 'required|string|max:5',
            'estadio' => 'required|string|max:40',
            'equipo' => 'required|integer',
        ]);
        $partido->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Partido $partido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partido $partido)
    {
        $partido->delete();
    }
}
