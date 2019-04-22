<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    protected $fillable = [
        'nombre',
        'cod_minsa',
        'concentracion',
        'forma_farmaceutica',
        'forma_farmaceutica_simp',
        'presentacion',
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
