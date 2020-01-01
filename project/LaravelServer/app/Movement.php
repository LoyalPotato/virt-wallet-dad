<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{

    
    protected $guarded = ['id', 'wallet_id']; //NOTE: Check if this is correct

    protected $table = 'movements';
    //TODO: Relaçao com wallet table N:1 wallet

    public function wallet()
    {
        return $this->belongsTo('App\Wallet');
    }

  

}
