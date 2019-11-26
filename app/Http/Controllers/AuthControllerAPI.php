<?php

namespace App\Http\Controllers;

define('YOUR_SERVER_URL', 'http://dad.prj.test');
define('CLIENT_ID', '2');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthControllerAPI extends Controller
{
    public function login(Request $request)
    {

        $http = new \GuzzleHttp\Client;
        $response = $http->post(YOUR_SERVER_URL . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => CLIENT_ID,
                'client_secret' => env("PASSWORD_SECRET"),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => ''
            ],
            'exceptions' => false,
        ]);
        $responseCode = $response->getStatusCode();
        if ($responseCode == '200') {
            return json_decode((string) $response->getBody(), true);
        } else {
            return response()->json(
                ['msg' => 'User credentials are invalid'],
                $responseCode
            );
        }
    }

    public function logout()
    {
        \Auth::guard('api')->user()->token()->revoke();
        \Auth::guard('api')->user()->token()->delete();
        return response()->json(['msg' => 'Token revoked'], 200);
    }

    public function register(Request $request)
    {
        //TODO: Alter to required fields
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'alpha', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);
        //TODO: Criar uma wallet 
        //NOTE: Aqui é preciso por mais algum campo ou eles sao auto-filled? O que é o remember token?
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'photo' => $request->photo,
            'nif' => $request->nif,
        ]);
    }
}
