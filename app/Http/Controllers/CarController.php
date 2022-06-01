<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __construct(Car $car) {
        $this->car = $car;
    }

    public function index(Request $request)
    {
        $carRepository = new CarRepository($this->car);

        if($request->has('attributes_type')) {
            $attributes_type = 'types:id,'. $request->attributes_type;
            $carRepository->selectAttributesRelatedRecords($attributes_type);
        } else {
            $carRepository->selectAttributesRelatedRecords('type');
        }

        if ($request->has('filt')) {
            $carRepository->filt($request->filt);
        }

        if($request->has('attribut')) {
            $carRepository->selectAttribut($request->attribut);
        }

        return response()->json($carRepository->getResult(), 200);
    }

    public function store(Request $request)
    {
        // Accept application/json para validações funcionarem nas APIs
        $request->validate($this->car->rules(), $this->car->feedback());

        $car = $this->car->create([
            'type_id' => $request->type_id,
            'license_plate' => $request->license_plate,
            'available' => $request->available,
            'km' => $request->km,
        ]);

        return response()->json($car, 201);
    }

    public function show($id)
    {
        $car = $this->car->with('type')->find($id); //with com os relacionamentos
        if($car === null) {
            return response()->json(['erro' => 'recurso pesquisado não existe'], 404);
        }
        return response()->json($car, 200);
    }

    public function update(Request $request, $id)
    {
        // para atualizar quando for formdata uliliza-se POST e no front com _method no cabeçalho PUT ou PATCH
        // PUT tem o intuito semantico de atualizar todo conteudo //PATCH intuito semantico de atualizar parte do conteudo
        $car = $this->car->find($id);

        if ($car === null) {
            return response()->json(['erro' => 'Não foi possível realizar a solicitação, o recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $dynamicRules = array();

            //  percorrendo todas as regras definidas no model
            foreach ($car->rules() as $input => $rule) {

                // coletar apenas as regras aplicáveis aos paramentros parciais da reuisição
                if(array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }

            $request->validate($dynamicRules, $car->feedback());

        } else {
            $request->validate($car->rules(), $car->feedback());
        }

        // preencher o objetop brand com os dados do request
        $car->fill($request->all());
        $car->save();

        return response()->json($car, 200);
    }

    public function destroy($id)
    {
        $car = $this->car->find($id);

        if ($car === null) {
            return response()->json(['erro' => 'Não foi possível realizar a exclusão, o recurso solicitado não existe'], 404);
        }

        $car->delete();
        return response()->json(['msg' => 'O Carro foi removido com sucesso!'], 200);
    }
}
