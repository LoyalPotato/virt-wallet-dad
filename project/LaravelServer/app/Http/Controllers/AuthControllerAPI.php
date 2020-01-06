<?php

namespace App\Http\Controllers;

/*
Estas variaveis devem vir do .env
define('YOUR_SERVER_URL', 'http://dad.prj.test');
define('CLIENT_ID', '2'); */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\User;
use App\Wallet;
use Illuminate\Http\File;

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

        $response = $http->post(env("YOUR_SERVER_URL") . '/oauth/token', [
            'form_params' => $form_params,
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
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        if ($request['photo']) {
            $image = $request->photo;  // your base64 encoded

            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);

            $imageName = \Str::random(10).'.png';

            \Storage::put(storage_path(). '/app/fotos' . $imageName, base64_decode($image));


            $validated['photo'] = $imageName;
        }


        $user = User::create($validated);
        //$user->wallet()->create();

        //$success['token'] =  $user->createToken('AppName')->accessToken;

        //return response()->json(['success'=>$success], $this->successStatus);
    }
}
