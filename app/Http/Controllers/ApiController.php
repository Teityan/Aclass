<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function login() {
        $credentials = request(['hash_login_id', 'password']);
        $credentials['hash_login_id'] = hash('sha256', $credentials['hash_login_id']);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
            //return response()->json($credentials);
        }

        return $this->respondWithToken($token);
    }

    public function user()
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth("api")->factory()->getTTL() * 60
        ]);
    }
}
