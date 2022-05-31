<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(Brand $brand) {
        $this->brand = $brand;
    }

    public function index()
    {
        // $brands = Brand::all();

        $brand = $this->brand->all();
        return response()->json($brand, 200);
    }

    public function store(Request $request)
    {
        // Accept application/json para validações funcionarem nas APIs
        $request->validate($this->brand->rules(), $this->brand->feedback());

        // dd($request->name);
        // dd($request->get('name'));
        // dd($request->input('name'));
        // dd($request->file('image'));
        // dd($request->image);

        $brand = $this->brand->create($request->all());
        return response()->json($brand, 201);
    }

    // public function show(Brand $brand)
    public function show($id)
    {
        $brand = $this->brand->find($id);
        if($brand === null) {
            return response()->json(['erro' => 'recurso pesquisado não existe'], 404);
        }
        return response()->json($brand, 200);
    }

    public function update(Request $request, $id)
    {
        // print_r($request->all()); // dado satualizados
        // echo '<hr>';
        // print_r($brand->getAttributes()); /// dados antigos
        // PUT tem o intuito semantico de atualizar todo conteudo //PATCH intuito semantico de atualizar parte do conteudo
        // $brand->update($request->all());

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


        $brand->update($request->all());
        return response()->json($brand, 200);
    }

    public function destroy($id)
    {
        // print_r($brand->getAttributes());
        // $brand->delete();

        $brand = $this->brand->find($id);

        if ($brand === null) {
            return response()->json(['erro' => 'Não foi possível realizar a exclusão, o recurso solicitado não existe'], 404);
        }

        $brand->delete();
        return response()->json(['msg' => 'A marca foi removida com sucesso!'], 200);
    }
}
