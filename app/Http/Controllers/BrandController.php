<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return $brands;
    }

    public function store(Request $request)
    {
        $brand = Brand::create($request->all());
        return $brand;
    }

    public function show(Brand $brand)
    {
        return $brand;
    }

    public function update(Request $request, Brand $brand)
    {
        // print_r($request->all()); // dado satualizados
        // echo '<hr>';
        // print_r($brand->getAttributes()); /// dados antigos

        // PUT tem o intuito semantico de atualizar todo conteudo //PATCH intuito semantico de atualizar parte do conteudo

        $brand->update($request->all());
        return $brand;
    }

    public function destroy(Brand $brand)
    {
        // print_r($brand->getAttributes());
        $brand->delete();
        return ['msg' => 'A marca foi removida com sucesso!'];
    }
}
