<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Jugador::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('altaJugador');
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
            'cod_ficha' => 'required|string|unique:jugadors',
            'nombre' => 'required|string|max:20',
            'apellidos' => 'required|string|max:40',
            'edad' => 'required|integer',
            'dorsal' => 'required|integer',
            'posicion' => 'required|string|max:40',
            'pie_dominante' => 'required|string|max:40',
            'altura' => 'required|integer',
            'peso' => 'required|decimal',
            'est_contrato' => 'required|date',
            'salario' => 'required|integer',
        ]);
        $jugadorAdd = new Jugador;
        $jugadorAdd->dni = $request->dni;
        $jugadorAdd->nombre = $request->nombre;
        $jugadorAdd->apellidos = $request->apellidos;
        $jugadorAdd->edad = $request->edad;
        $jugadorAdd->dorsal = $request->dorsal;
        $jugadorAdd->posicion = $request->posicion;
        $jugadorAdd->pie_dominante = $request->pie_dominante;
        $jugadorAdd->altura = $request->altura;
        $jugadorAdd->peso = $request->peso;
        $jugadorAdd->est_contrato = $request->est_contrato;
        $jugadorAdd->salario = $request->salario;
        $jugadorAdd->save();
        return back()->with('alta', 'Jugador dado de Alta');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Jugador $jugador
     * @return \Illuminate\Http\Response
     */
    public function show(Jugador $jugador)
    {
        $jugadors = Jugador::all();
        return view('listadoJugadores')->with('jugadores', $jugadors);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Jugador $jugador
     * @return \Illuminate\Http\Response
     */
    public function edit(Jugador $jugador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Jugador $jugador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jugador $jugador)
    {
        $validator = $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'edad' => 'required|integer',
            'dorsal' => 'required|integer',
            'posicion' => 'required|string|max:40',
            'pie_dominante' => 'required|string|max:40',
            'altura' => 'required|integer',
            'peso' => 'required|decimal',
            'est_contrato' => 'required|date',
            'salario' => 'required|integer',
        ]);
        $jugador->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Jugador $jugador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jugador $jugador)
    {
        $jugador->delete();
    }
}
