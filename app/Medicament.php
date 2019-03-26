<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    protected $fillable = [
        'descripcion',
        'unidad',
        'laboratory_id',
        'active_principle_id',
    ];

    public function activePrinciple() {
        return $this->belongsTo('App\ActivePrinciple');
    }

    public function laboratory() {
        return $this->belongsTo('App\Laboratory');
    }
}
