<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id','name', 'image', 'number_doors', 'places', 'air_bag', 'abs'];

    public function rules()
    {
        return [ // Accept application/json para validações funcionarem nas APIs

            'brand_id' => ['exists:brands,id'],
            'name' => ['required','string','min:3','max:30','unique:types,name,'.$this->id.'','max:30'],
            'image' => ['required','max:100','file','mimes:png,jpg,jpeg'], // mines, serie de extensões possiveis
            'number_doors' => ['required','integer','digits_between:1,4'],
            'places' => ['required','integer','digits_between:1,5'],
            'air_bag' => ['required','boolean'],
            'abs' => ['required','boolean'], // true, false, 1, 0, "1", "0"

        ];

        /**
         * UNIQUE()
         * 1 - tabela
         * 2 - nome da coluna que será verificada
         * 3 - id que será desconsiderado na pesquisa
         */
    }

    public function feedback() // feedback de erros
    {
        return [
            'brand_id.exists' => 'O campo marca não existe',
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser uma string',
            'name.min' => 'O campo nome deve ter no mínimo 1 caracteres',
            'name.max' => 'O campo nome deve ter no máximo 30 caracteres',
            'name.unique' => 'O campo nome deve ser único',
            'image.required' => 'O campo imagem é obrigatório',
            'image.max' => 'O campo imagem deve ter no máximo 255 caracteres',
            'image.file' => 'O campo imagem deve ser um arquivo',
            'image.mimes' => 'O campo imagem deve ter extensões válidas, png, jpg, jpeg',
            'number_doors.required' => 'O campo número de portas é obrigatório',
            'number_doors.integer' => 'O campo número de portas deve ser um número inteiro',
            'number_doors.digits_between' => 'O campo número de portas deve ter no mínimo 1 digito e no máximo 4 dígitos',
            'places.required' => 'O campo número de lugares é obrigatório',
            'places.integer' => 'O campo número de lugares deve ser um número inteiro',
            'places.digits_between' => 'O campo número de lugares deve ter no mínimo 1 digito e no máximo 5 dígitos',
            'air_bag.required' => 'O campo air_bag é obrigatório',
            'air_bag.boolean' => 'O campo air_bag deve ser um booleano',
            'abs.required' => 'O campo ABS é obrigatório',
            'abs.boolean' => 'O campo ABS deve ser um booleano',
        ];
    }

    public function brand()  // um TYPE pertence a uma Brand // Tabela TYPE é a mais fraca do relacionamento
    {
        // return $this->belongsTo(Brand::class);
        return $this->belongsTo('App\Models\Brand');
    }

}
