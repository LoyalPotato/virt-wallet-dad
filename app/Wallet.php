<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';

    public function movements()
    {
        return $this->hasMany('App\Movement');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
