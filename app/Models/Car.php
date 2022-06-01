<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['type_id','license_plate', 'available', 'km'];

    public function rules()
    {
        return [ // Accept application/json para validações funcionarem nas APIs

            'type_id' => ['exists:types,id'],
            'license_plate' => ['required', 'string', 'max:8'],
            'available' => ['required', 'boolean'],
            'km' => ['required', 'integer'],
        ];

    }

    public function feedback()
    {
        return [

            'type_id.exists' => 'O campo Modelo deve ser válido',
            'license_plate.required' => 'O campo placa é obrigatório',
            'license_plate.string' => 'O campo placa deve ser uma string',
            'license_plate.max' => 'O campo placa deve ter no máximo 8 caracteres',
            'available.required' => 'O campo disponibilidade é obrigatório',
            'available.boolean' => 'O campo disponibilidade deve ser booleano',
            'km.required' => 'O campo km é obrigatório',
            'km.integer' => 'O campo km deve ser um inteiro',
        ];

    }

    public function type() // um carro possui um Modelo
    {
        return $this->belongsTo('App\Models\Type');
    }


}
