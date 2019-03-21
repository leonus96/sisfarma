<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function medicaments() {
        return $this->hasMany('App\Medicament');
    }
}
