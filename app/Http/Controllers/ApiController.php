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
        $user = auth()->user();
        $user["name"] = decryptData($user["name"],"USER_KEY");
        $user["email"] = decryptData($user["email"],"USER_KEY");
        $user["login_id"] = decryptData($user["login_id"],"USER_KEY");
        unset($user["hash_login_id"],$user["hash_email"],$user["twofactor"],$user["temporary"],$user["email_verified_at"],$user["created_at"],$user["updated_at"]);
        return response()->json($user);
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
