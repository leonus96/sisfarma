<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable= [
      'id',
      'stock',
      'precio_costo',
      'precio_publico',
    ];

    public function medicament() {
        return $this->hasOne(Medicament::class);
    }
}
