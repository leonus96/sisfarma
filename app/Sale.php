<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'fecha',
        'cantidad',
        'customer_id',
    ];

    /*public function saleDetails() {
        return $this->hasMany(SaleDatail::class);
    }*/
}
