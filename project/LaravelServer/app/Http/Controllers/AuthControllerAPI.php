<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use  App\Http\Requests\StoreUserRequest;
use App\User;
use App\Wallet;

class AuthControllerAPI extends Controller
{
    public function login(Request $request)
    {

        $http = new \GuzzleHttp\Client;
        $response = $http->post(env("YOUR_SERVER_URL") . '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => env("CLIENT_ID"),
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
                401
            );
        }
    }

    public function logout()
    {
        \Auth::guard('api')->user()->token()->revoke();
        \Auth::guard('api')->user()->token()->delete();
        return response()->json(['msg' => 'Token revoked'], 200);
    }

    public function register(StoreUserRequest $request)
    {
        // NOTE: Being done by Alex
        // //TODO: Alter to required fields @StoreUserRequest file
        // $validated = $request->validated();
        
        // $newUser = User::create($validated);
        // //NOTE: Aqui é preciso por mais algum campo ou eles sao auto-filled? O que é o remember token?
        // return [$newUser
        //     // QUESTION: Como é que posso ir buscar o id deste user registado? Ou funciona com o email?
        // , User::find($request->email)->wallet()->save(new Wallet([[
        //     'email'=> $request->email,
        //     'balance'=> 0.0,
        // ]]))];
    }
}
