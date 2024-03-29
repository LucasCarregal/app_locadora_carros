<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function index(Request $request)
    {
        $modelo = [];

        if($request->has('atributos_marca')){
            $atributos_marca = $request->atributos_marca;
            $modelo = $this->modelo->with('marca:id,'.$atributos_marca);
        } else {
            $modelo = $this->modelo->with('marca');
        }

        if($request->has('filtro')){
            foreach($request->filtro as $condicao){
                $c = explode(':', $condicao);
                $modelo = $modelo->where($c[0], $c[1], $c[2]);
            }
        }

        if($request->has('atributos')){
            $atributos = $request->atributos;
            $modelo = $modelo->selectRaw($atributos)->get();
        } else {
            $modelo = $modelo->get();
        }

        return response()->json($this->modelo->with('marca')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate($this->modelo->rules(), $this->modelo->feedback());

        $path = $request->file('imagem')->store('imagens/modelos', 'public');

        $modelo = $request->all();        
        $modelo['imagem'] = $path;

        $modelo = $this->modelo->create($modelo);
        return response()->json($modelo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $modelo = $this->modelo->with('marca')->find($id);
        
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


        if($request->method() === 'PATCH'){
            $regrasDinamicas = array();

            foreach($modelo->rules() as $input => $regra){
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $modelo->feedback());
        } else {
            $request->validate($modelo->rules(), $modelo->feedback());
        }

        $novo_modelo = $request->all();

        if($request->file('imagem')){
            Storage::disk('public')->delete($modelo->imagem);
            $path = $request->file('imagem')->store('imagens/modelos', 'public');
            $novo_modelo['imagem'] = $path;
        }

        $modelo->update($novo_modelo);
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

        if($modelo->imagem){
            Storage::disk('public')->delete($modelo->imagem);
        }

        $modelo->delete();
        return  response()->json(['msg' => 'Modelo deletado com sucesso!'], 200);
    }
}
