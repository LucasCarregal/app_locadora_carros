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
        return $modelos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $modelo = $this->modelo->create($request->all());
        return $modelo;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $modelo = $this->modelo->find($id);
        
        if($modelo === null)
            return ['msg' => 'Modelo nao encontrado!'];

        return $modelo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $modelo = $this->modelo->find($id);

        if($modelo === null)
            return ['msg' => 'Modelo nao encontrado!'];
        
        $modelo->update($request->all());
        return $modelo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $modelo = $this->modelo->find($id);

        if($modelo === null)
            return ['msg' => 'Modelo nao encontrado!'];

        $modelo->delete();
        return ['msg' => 'Modelo deletado com sucesso!'];
    }
}
