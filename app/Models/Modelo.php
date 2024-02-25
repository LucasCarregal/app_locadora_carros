<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;
    protected $fillable = ['marca_id', 'nome', 'imagem', 'numero_portas', 'lugares', 'air_bag', 'abs'];

    public function rules(){
        return [
            'marca_id' => 'required|exists:marcas,id',
            'nome' => "required|unique:modelos,nome,$this->id|min:3",
            'imagem' => 'required|file|mimes:png,jpg,jpeg',
            'numero_portas' => 'required|integer|digits_between:1,5',
            'lugares' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'nome.unique' => 'O nome do modelo já está cadastrado!',
            'nome.min' => 'O nome do modelo deve ter no mínimo 3 caracteres!',
            'imagem.mimes' => 'A imagem deve ser do tipo PNG, JPG ou JPEG!',
            'numero_portas.integer' => 'O número de portas deve ser um número inteiro!',
            'numero_portas.digits_between' => 'O número de portas deve estar entre 1 e 5!',
            'lugares.integer' => 'O número de lugares deve ser um número inteiro!',
            'lugares.digits_between' => 'O número de lugares deve estar entre 1 e 20!',
            'air_bag.boolean' => 'O campo air bag deve ser verdadeiro ou falso!',
            'abs.boolean' => 'O campo abs deve ser verdadeiro ou falso!'
        ];
    }

    public function marca(){
        return $this->belongsTo('App\Models\Marca');
    }
}
