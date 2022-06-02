<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function index(Request $request)
    {
        $clientRepository = new ClientRepository($this->client);

        if ($request->has('filt')) {
            $clientRepository->filt($request->filt);
        }

        if($request->has('attribut')) {
            $clientRepository->selectAttribut($request->attribut);
        }

        return response()->json($clientRepository->getResult(), 200);
    }

    public function store(Request $request)
    {
        // Accept application/json para validações funcionarem nas APIs
        $request->validate($this->client->rules(), $this->client->feedback());

        $client = $this->client->create([
            'name' => $request->name,
        ]);

        return response()->json($client, 201);
    }

    public function show($id)
    {
        $client = $this->client->find($id); //with com os relacionamentos
        if($client === null) {
            return response()->json(['erro' => 'recurso pesquisado não existe'], 404);
        }
        return response()->json($client, 200);
    }

    public function update(Request $request, $id)
    {
        // para atualizar quando for formdata uliliza-se POST e no front com _method no cabeçalho PUT ou PATCH
        // PUT tem o intuito semantico de atualizar todo conteudo //PATCH intuito semantico de atualizar parte do conteudo
        $client = $this->client->find($id);

        if ($client === null) {
            return response()->json(['erro' => 'Não foi possível realizar a solicitação, o recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $dynamicRules = array();

            //  percorrendo todas as regras definidas no model
            foreach ($client->rules() as $input => $rule) {

                // coletar apenas as regras aplicáveis aos paramentros parciais da reuisição
                if(array_key_exists($input, $request->all())) {
                    $dynamicRules[$input] = $rule;
                }
            }

            $request->validate($dynamicRules, $client->feedback());

        } else {
            $request->validate($client->rules(), $client->feedback());
        }

        $client->fill($request->all());
        $client->save();

        return response()->json($client, 200);
    }

    public function destroy($id)
    {
        $client = $this->client->find($id);

        if ($client === null) {
            return response()->json(['erro' => 'Não foi possível realizar a exclusão, o recurso solicitado não existe'], 404);
        }

        $client->delete();
        return response()->json(['msg' => 'O cliente foi removido com sucesso!'], 200);
    }
}
