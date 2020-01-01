<?php

namespace App\Http\Controllers;

use App\Http\Resources\WalletResource;
use App\Wallet;
use Illuminate\Http\Request;

class WalletControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TEST Se da para retornar all ou se temos que fazer por paginaçao
        return WalletResource::collection(Wallet::all());
    }

    public function count()
    {
        return Wallet::all()->count();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $wallet = Wallet::where('email', $email)->first();
        if($wallet == null){
            return response()->json($wallet,404);
        }
        return response()->json($wallet, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
