<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [
        'cantidad',
        'inventory_id',
        'sale_id',
        'created_at',
    ];

    public function inventory() {
        return $this->belongsTo(Inventory::class);
    }
}
