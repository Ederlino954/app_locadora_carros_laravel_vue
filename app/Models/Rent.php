<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'car_id','period_start_date', 'expected_end_date_period',
        'end_date_performed_period','daily_value','initial_km', 'km_final'
    ];

    public function rules()
    {
        return [
            'client_id' => 'exists:clients,id',
            'car_id' => 'exists:cars,id',
            'period_start_date' => 'required|date',
            'expected_end_date_period' => 'required|date',
            'end_date_performed_period' => 'required|date',
            'daily_value' => 'required',
            'initial_km' => 'required|integer',
            'km_final' => 'required|integer'
        ];
    }

    public function feedback()
    {
        return [
            'client_id.exists' => 'O campo cliente não existe',
            'car_id.exists' => 'O campo carro não existe',
            'period_start_date.required' => 'O campo data inicial é obrigatório',
            'expected_end_date_period.required' => 'O campo data final é obrigatório',
            'end_date_performed_period.required' => 'O campo data final realizada é obrigatório',
            'initial_km.required' => 'O campo km inicial é obrigatório',
            'km_final.required' => 'O campo km final é obrigatório',
            'initial_km.integer' => 'O campo km inicial deve ser um número inteiro',
            'km_final.integer' => 'O campo km final deve ser um número inteiro',
            'period_start_date.date' => 'O campo data inicial deve ser uma data válida',
            'expected_end_date_period.date' => 'O campo data final deve ser uma data válida',
            'end_date_performed_period.date' => 'O campo data final realizada deve ser uma data válida',
            'daily_value.required' => 'O campo valor diário é obrigatório'
        ];
    }
    
}
