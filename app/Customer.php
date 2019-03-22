<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'dni',
    ];

    public function sales() {
        return $this->hasMany('App\Sale');
    }
}
