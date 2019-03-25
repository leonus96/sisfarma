<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    public const ID = 1;

    public function users() {
        return $this->hasMany('App\User');
    }
}
