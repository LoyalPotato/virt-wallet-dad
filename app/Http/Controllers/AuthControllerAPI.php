<?php

namespace App\Http\Controllers;

/*
Estas variaveis devem vir do .env
define('YOUR_SERVER_URL', 'http://dad.prj.test');
define('CLIENT_ID', '2'); */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Wallet;
use App\Http\Requests\StoreUserRequest;

class AuthControllerAPI extends Controller
{
    public function login(Request $request)
    {

        $http = new \GuzzleHttp\Client;
        $form_params=[
                'grant_type' => 'password',
                'client_id' => env("CLIENT_ID"),
                'client_secret' => env("PASSWORD_SECRET"),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => ''
            ];
            /* dd($form_params); */
        $response = $http->post(env("YOUR_SERVER_URL") . '/oauth/token', [
            'form_params' => $form_params,
            'exceptions' => false,
        ]);
        /* dd($response); */
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
        $validated = $request->validated();

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        $success['token'] =  $user->createToken('AppName')->accessToken;

        return response()->json(['success'=>$success], $this->successStatus);

        //TODO: Criar uma wallet
        //NOTE: Aqui é preciso por mais algum campo ou eles sao auto-filled? O que é o remember token?
        /* return [$newUser
            // QUESTION: Como é que posso ir buscar o id deste user registado? Ou funciona com o email?
        , User::find($request->email)->wallet()->save(new Wallet([[
            'email'=> $request->email,
            'balance'=> 0.0,
        ]]))]; */
    }
}
