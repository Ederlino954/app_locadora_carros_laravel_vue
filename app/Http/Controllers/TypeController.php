<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
    public function __construct(Type $type) {
        $this->type = $type;
    }

    public function index(Request $request )
    {
        // dd($request->get('attributes')); // carregou os atributos de attributes na url ///http://127.0.0.1:8000/api/type?attribut=id,name,image
        //  http://127.0.0.1:8000/api/type?attribut=id,name,image,brand_id
        //  http://127.0.0.1:8000/api/type?attribut=id,name,image,places,brand_id&attributes_brand=name,image
        // http://127.0.0.1:8000/api/type?attributes_brand=image

        $models = array();

        if($request->has('attributes_brand')) {
            $attributes_brand = $request->attributes_brand;
            $models = $this->type->with('brand:id,'.$attributes_brand);
        } else {
            $models = $this->type->with('brand');
        }

        if($request->has('attribut')) {
            $attribut = $request->attribut;
            $models = $models->selectRaw($attribut)->get();
        } else {
            $models = $models->get();
        }

        //  $this->type->with('brand')->get()

        return response()->json($models , 200);
    }

    public function store(Request $request)
    {
        // Accept application/json para validações funcionarem nas APIs
        $request->validate($this->type->rules(), $this->type->feedback());

        $image = $request->file('image');
        $image_urn = $image->store('images/types', 'public');

        $type = $this->type->create([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'image' => $image_urn,
            'number_doors' => $request->number_doors,
            'places' => $request->places,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs,
        ]);

        return response()->json($type, 201);
    }

    public function show($id)
    {
        $type = $this->type->with('brand')->find($id);
        if($type === null) {
            return response()->json(['erro' => 'recurso pesquisado não existe'], 404);
        }
        return response()->json($type, 200);
    }

    public function update(Request $request, $id)
    {
        // para atualizar quando for formdata uliliza-se (POST) e no front com (_method) no cabeçalho (PUT ou PATCH)
        // PUT tem o intuito semantico de atualizar todo conteudo //PATCH intuito semantico de atualizar parte do conteudo
        $type = $this->type->find($id);

        if ($type === null) {
            return response()->json(['erro' => 'Não foi possível realizar a solicitaçaõ, o recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $dynamicRules = array();

            //  percorrendo todas as regras definidas no model
            foreach ($type->rules() as $input => $rule) {

                // coletar apenas as regras aplicáveis aos paramentros parciais da reuisição
                if(array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }

            $request->validate($dynamicRules, $type->feedback());

        } else {
            $request->validate($type->rules(), $type->feedback());
        }

        // remove um arquivo antigo caso tenha sido enviado uma imagem no request
        if ($request->file('image')) {
            Storage::disk('public')->delete($type->image);
        }

        $image = $request->file('image');
        $image_urn = $image->store('images/types', 'public');

        $type->fill($request->all());
        $type->image = $image_urn;

        $type->save();

        // $type->update([
        //     'brand_id' => $request->brand_id,
        //     'name' => $request->name,
        //     'image' => $image_urn,
        //     'number_doors' => $request->number_doors,
        //     'places' => $request->places,
        //     'air_bag' => $request->air_bag,
        //     'abs' => $request->abs,
        // ]);

        return response()->json($type, 200);
    }

    public function destroy($id)
    {
        $type = $this->type->find($id);

        if ($type === null) {
            return response()->json(['erro' => 'Não foi possível realizar a exclusão, o recurso solicitado não existe'], 404);
        }

        // remove o arquivo
        Storage::disk('public')->delete($type->image);

        $type->delete();
        return response()->json(['msg' => 'O modelo foi removido com sucesso!'], 200);
    }
}
