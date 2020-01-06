<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{

    
    protected $guarded = []; //NOTE: Check if this is correct

    protected $table = 'movements';

    public function wallet()
    {
        return $this->belongsTo('App\Wallet');
    }

  

}
