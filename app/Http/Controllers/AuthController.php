<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $token = auth('api')->attempt($credentials);

        if ($token) {
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => 'Usuário ou senha inválido!'], 403);
            // 401 = Unauthorized
            // 403 = Forbidden -> proibido (login inválido!)
        }

        return 'login';
    }


    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Deslogado com sucesso!']);
    }

    public function refresh()
    {
        $token = auth('api')->refresh(); // cllient encaminha um JWT válido // gerou um novo token
        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

}
