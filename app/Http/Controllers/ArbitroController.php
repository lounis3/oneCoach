<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arbitro;

class ArbitroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Arbitro::all();
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
            'cod_arbitro' => 'required|string|unique:arbitros',
            'nombre' => 'required|string|max:20',
            'apellidos' => 'required|string|max:40',
            'partido' => 'required|integer',
            ]);
        $arbitroAdd = new Arbitro;
        $arbitroAdd->cod_arbitro = $request->cod_arbitro;
        $arbitroAdd->nombre = $request->nombre;
        $arbitroAdd->apellidos = $request->apellidos;
        $arbitroAdd->partido = $request->partido;
        $arbitroAdd->save();
        return back()->with('alta', 'Arbitro dado de Alta');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Arbitro $arbitro
     * @return \Illuminate\Http\Response
     */
    public function show(Arbitro $arbitro)
    {
        $arbitros = Arbitro::all();
        return view('arbitro/listadoArbitros')->with('arbitros', $arbitros);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Arbitro $arbitro
     * @return \Illuminate\Http\Response
     */
    public function edit(Arbitro $arbitro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Arbitro $arbitro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arbitro $arbitro)
    {
        $validator = $this->validate($request, [
            'cod_arbitro' => 'required|string|unique:arbitros',
            'nombre' => 'required|string|max:20',
            'apellidos' => 'required|string|max:40',
            'partido' => 'required|integer',
        ]);
        $arbitro->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Arbitro $arbitro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arbitro $arbitro)
    {
        $arbitro->delete();
    }
}
