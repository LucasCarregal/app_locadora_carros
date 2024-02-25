<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $token = auth('api')->attempt($request->all('email', 'password'));  

        return $token ? response()->json(['token' => $token], 200) : response()->json(['erro' => 'Usuário e/ou Senha inválidos '], 403);
    }

    public function logout(){
        auth('api')->logout();
        return response()->json(['message' => 'Deslogado com sucesso']);}

    public function refresh(){
        return response()->json(['token' => auth('api')->refresh()]);
    }

    public function me(){
        return response()->json(auth('api')->user());
    }
}
