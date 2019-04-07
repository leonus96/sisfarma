<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'nombre',
        'dni',
    ];

    public function sales() {
        return $this->hasMany('App\Sale');
    }
}
