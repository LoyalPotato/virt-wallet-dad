<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';

    protected $guarded = [];

    public function movements()
    {
        return $this->hasMany('App\Movement');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
