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
            // return response()->json([
            //     'token' => $token,
            //     'user' => auth('api')->user(),
            // ]);
        } else {
            return response()->json(['error' => 'Usuário ou senha inválido!'], 403);

            // 401 = Unauthorized
            // 403 = Forbidden -> proibido (login inválido!)
        }

        dd($token);

        return 'login';
    }


    public function logout()
    {
        return 'logout';
    }

    public function refresh()
    {
        return 'refresh';
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

}
