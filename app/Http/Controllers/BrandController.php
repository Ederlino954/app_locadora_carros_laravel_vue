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
        return $brand;
    }

    public function store(Request $request)
    {
        // $brand = Brand::create($request->all());
        $brand = $this->brand->create($request->all());
        return $brand;
    }

    // public function show(Brand $brand)
    public function show($id)
    {
        $brand = $this->brand->find($id);
        if($brand === null) {
            return ['erro' => 'recurso pesquisado não existe'];
        }
        return $brand;
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
            return ['erro' => 'Não foi possível realizar a solicitaçaõ, o recurso solicitado não existe'];
        }

        $brand->update($request->all());
        return $brand;
    }

    public function destroy($id)
    {
        // print_r($brand->getAttributes());
        // $brand->delete();

        $brand = $this->brand->find($id);

        if ($brand === null) {
            return ['erro' => 'Não foi possível realizar a exclusão, o recurso solicitado não existe'];
        }

        $brand->delete();
        return ['msg' => 'A marca foi removida com sucesso!'];
    }
}
