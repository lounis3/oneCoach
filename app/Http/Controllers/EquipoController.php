<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Equipo::all();
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
            'cod_equipo' => 'required|string|unique:equipos|max:4',
            'nombre' => 'required|string|max:40',
            'ciudad' => 'required|string|max:40',
            'presupuesto' => 'required|integer',
        ]);
        $equipoAdd = new Equipo();
        $equipoAdd->cod_equipo = $request->cod_equipo;
        $equipoAdd->nombre = $request->nombre;
        $equipoAdd->ciudad = $request->ciudad;
        $equipoAdd->presupuesto = $request->presupuesto;
        $equipoAdd->save();
        return back()->with('alta', 'Equipo dado de Alta');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Equipo $equipo
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Equipo $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Equipo $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipo $equipo)
    {
        $validator = $this->validate($request, [
            'cod_equipo' => 'required|string|unique:equipos|max:4',
            'nombre' => 'required|string|max:40',
            'ciudad' => 'required|string|max:40',
            'presupuesto' => 'required|integer',
        ]);
        $equipo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Equipo $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
    }
}
