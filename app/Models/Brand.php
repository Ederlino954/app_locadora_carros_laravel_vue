<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image'];

    public function rules()
    {
        return [ // Accept application/json para validações funcionarem nas APIs
            'name' => ['required','string','min:3','max:30','unique:brands,name,'.$this->id.'','max:30'],
            'image' => ['required','max:100','mimes:png,jpg,jpeg'], // mines, serie de extensões possiveis

        ];
        /**
         * UNIQUE()
         * 1 - tabela
         * 2 - nome da coluna que será verificada
         * 3 - id que será desconsiderado na pesquisa
         */
    }

    public function feedback()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.string' => 'O campo nome deve ser uma string',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O campo nome deve ter no máximo 30 caracteres',
            'name.unique' => 'O campo nome deve ser único',
            'image.required' => 'O campo imagem é obrigatório',
            'image.max' => 'O campo imagem deve ter no máximo 100 caracteres',
            'image.mimes' => 'O campo imagem deve ter extensões válidas, png, jpg, jpeg',
        ];
    }



}
