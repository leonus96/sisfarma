<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable= [
        'stock',
        'precio_costo',
        'precio_publico',
        'lote',
        'medicament_id',
        'pharmacy_id',
    ];

    public function medicament() {
        return $this->belongsTo(Medicament::class);
    }
}
