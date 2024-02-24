<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    protected Modelo $modelo;

    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelos = $this->modelo->all();
        return response()->json($modelos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $modelo = $this->modelo->create($request->all());
        return response()->json($modelo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $modelo = $this->modelo->find($id);
        
        if($modelo === null)
            return response()->json(['erro' => 'Modelo nao encontrado!'], 404);

        return response()->json($modelo, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $modelo = $this->modelo->find($id);

        if($modelo === null)
            return response()->json(['erro' => 'Modelo nao encontrado!'], 404);
        
        $modelo->update($request->all());
        return response()->json($modelo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $modelo = $this->modelo->find($id);

        if($modelo === null)
            return response()->json(['erro' => 'Modelo nao encontrado!'], 404);

        $modelo->delete();
        return  response()->json(['msg' => 'Modelo deletado com sucesso!'], 200);
    }
}
