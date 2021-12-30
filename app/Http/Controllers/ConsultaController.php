<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use App\Models\Consulta;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Consulta::all();
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
            'jugador' => 'required|integer',
            'medico' => 'required|integer',

        ]);
        $consultaAdd = new Consulta;
        $consultaAdd->fecha = $request->fecha;
        $consultaAdd->jugador = $request->jugador;
        $consultaAdd->medico = $request->medico;
        $consultaAdd->save();
        return back()->with('alta', 'Consulta Creada');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Consulta $consulta
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consulta)
    {
        $consultas = Consulta::all();
        return view('consulta/listadoConsultas')->with('consultas', $consultas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Consulta $consulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Consulta $consulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consulta $consulta)
    {
        $validator = $this->validate($request, [
            'fecha' => 'required|date',
            'jugador' => 'required|integer',
            'medico' => 'required|integer',
        ]);
        $consulta->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Consulta $consulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consulta $consulta)
    {
        $consulta->delete();
    }
}
