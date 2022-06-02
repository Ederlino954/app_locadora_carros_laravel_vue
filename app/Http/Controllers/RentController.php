<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Repositories\RentRepository;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function __construct(Rent $rent) {
        $this->rent = $rent;
    }

    public function index(Request $request)
    {
        $rentRepository = new RentRepository($this->rent);

        if ($request->has('filt')) {
            $rentRepository->filt($request->filt);
        }

        if($request->has('attribut')) {
            $rentRepository->selectAttribut($request->attribut);
        }

        return response()->json($rentRepository->getResult(), 200);
    }

    public function store(Request $request)
    {
        // Accept application/json para validações funcionarem nas APIs
        $request->validate($this->rent->rules(), $this->rent->feedback());

        $rent = $this->rent->create([
            'client_id' => $request->client_id,
            'car_id' => $request->car_id,
            'period_start_date' => $request->period_start_date, // inicio
            'expected_end_date_period' => $request->expected_end_date_period, // data final prevista
            'end_date_performed_period' => $request->end_date_performed_period, // data final realizada
            'daily_value' => $request->daily_value,
            'initial_km' => $request->initial_km,
            'km_final' => $request->km_final
        ]);

        return response()->json($rent, 201);
    }

    public function show($id)
    {
        $rent = $this->rent->find($id); //with com os relacionamentos
        if($rent === null) {
            return response()->json(['erro' => 'recurso pesquisado não existe'], 404);
        }
        return response()->json($rent, 200);
    }

    public function update(Request $request, $id)
    {
        // para atualizar quando for formdata uliliza-se POST e no front com _method no cabeçalho PUT ou PATCH
        // PUT tem o intuito semantico de atualizar todo conteudo //PATCH intuito semantico de atualizar parte do conteudo
        $rent = $this->rent->find($id);

        if ($rent === null) {
            return response()->json(['erro' => 'Não foi possível realizar a solicitação, o recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $dynamicRules = array();

            //  percorrendo todas as regras definidas no model
            foreach ($rent->rules() as $input => $rule) {

                // coletar apenas as regras aplicáveis aos paramentros parciais da reuisição
                if(array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }

            $request->validate($dynamicRules, $rent->feedback());

        } else {
            $request->validate($rent->rules(), $rent->feedback());
        }

        // preencher o objetop rent com os dados do request
        $rent->fill($request->all());
        $rent->save();

        return response()->json($rent, 200);
    }

    public function destroy($id)
    {
        $rent = $this->rent->find($id);

        if ($rent === null) {
            return response()->json(['erro' => 'Não foi possível realizar a exclusão, o recurso solicitado não existe'], 404);
        }

        $rent->delete();
        return response()->json(['msg' => 'A locação foi removida com sucesso!'], 200);
    }
}
