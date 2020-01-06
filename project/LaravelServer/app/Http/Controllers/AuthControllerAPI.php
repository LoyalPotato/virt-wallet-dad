<?php

namespace App\Http\Controllers;


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
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        if ($request['photo']) {
            $image = $request->photo;

            preg_match('~/(.*?);~', $image, $output);
            $imageExtension = $output[1];

            $imageName = \Str::random(10).'.'.$imageExtension;

            $image = trim( str_replace('data:image/'.$imageExtension.';base64,', "", $image ) ); /* Replace with an empty string */

            \Storage::put(storage_path(). '/app/fotos' . $imageName, base64_decode($image));


            $validated['photo'] = $imageName;
        }


        $user = User::create($validated);
        Wallet::create(['id' => $user['id'],'email' => $user['email'], 'balance' => 0]);

        //$success['token'] =  $user->createToken('AppName')->accessToken;

        //return response()->json(['success'=>$success], $this->successStatus);
    }

    public function updateUser(StoreUserRequest $request) { //StoreUserRequest ou so Request?
        $user = User::where('email', $request->email)->first();

        $user->name = $request->name;
        $user->save();

        return response()->json(['msg' => 'Entered Auth APi'], 200);
    }
}
