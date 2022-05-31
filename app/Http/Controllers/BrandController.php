<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(Brand $brand) {
        $this->brand = $brand;
    }

    public function index()
    {
        $brand = $this->brand->with('types')->get();
        return response()->json($brand, 200);
    }

    public function store(Request $request)
    {
        // Accept application/json para validações funcionarem nas APIs
        $request->validate($this->brand->rules(), $this->brand->feedback());

        $image = $request->file('image');
        $image_urn = $image->store('images', 'public');

        $brand = $this->brand->create([
            'name' => $request->name,
            'image' => $image_urn,
        ]);

        return response()->json($brand, 201);
    }
    public function show($id)
    {
        $brand = $this->brand->with('types')->find($id); //with com os relacionamentos
        if($brand === null) {
            return response()->json(['erro' => 'recurso pesquisado não existe'], 404);
        }
        return response()->json($brand, 200);
    }

    public function update(Request $request, $id)
    {
        // para atualizar quando for formdata uliliza-se POST e no front com _method no cabeçalho PUT ou PATCH
        // PUT tem o intuito semantico de atualizar todo conteudo //PATCH intuito semantico de atualizar parte do conteudo
        $brand = $this->brand->find($id);

        if ($brand === null) {
            return response()->json(['erro' => 'Não foi possível realizar a solicitaçaõ, o recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $dynamicRules = array();

            //  percorrendo todas as regras definidas no model
            foreach ($brand->rules() as $input => $rule) {

                // coletar apenas as regras aplicáveis aos paramentros parciais da reuisição
                if(array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }

            $request->validate($dynamicRules, $brand->feedback());

        } else {
            $request->validate($brand->rules(), $brand->feedback());
        }

        // remove um arquivo antigo caso tenha sido enviado uma imagem no request
        if ($request->file('image')) {
            Storage::disk('public')->delete($brand->image);
        }

        $image = $request->file('image');
        $image_urn = $image->store('images', 'public');

        $brand->update([
            'name' => $request->name,
            'image' => $image_urn,
        ]);

        return response()->json($brand, 200);
    }

    public function destroy($id)
    {
        $brand = $this->brand->find($id);

        if ($brand === null) {
            return response()->json(['erro' => 'Não foi possível realizar a exclusão, o recurso solicitado não existe'], 404);
        }

        // remove o arquivo
        Storage::disk('public')->delete($brand->image);

        $brand->delete();
        return response()->json(['msg' => 'A marca foi removida com sucesso!'], 200);
    }
}
