<?php

namespace App\Http\Controllers;

use App\Movement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\MovementResource;
use App\Http\Requests\StoreMovementRequest;

class MovementControllerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MovementResource::collection(Movement::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovementRequest $request)
    {
        /*TODO 
        Create movement
        Validation & store
        category_id	categories(id)	RESTRICT	RESTRICT	Alter
        transfer_movement_id	movements(id)	RESTRICT	RESTRICT	Alter
        transfer_wallet_id	wallets(id)	RESTRICT	RESTRICT	Alter
        wallet_id	wallets(id)	RESTRICT	RESTRICT	Alter

        from email get user get wallet generate new movement
        update balance
        */
        
        //NOTE: Caso haja algum valor que n esteja correto, o laravel vai automaticamente devolver resposta json com o erro e stat code respetivo
        $request->validate([
            'email' => ['email', 'exists:wallets,email'],
            'value' => ['min:0.01', 'max:5000.00'],
            'type' => [Rule::in(['e', 'i'])],
            'type_payment' => [Rule::in(["c", "bt"])],
            'iban' => [Rule::requiredIf($request->type_payment == "bt"),'iban']
        ]);
        
        return response()->json(
            ['msg' => 'Movement created'],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function show(Movement $movement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movement $movement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movement $movement)
    {
        //
    }
}
