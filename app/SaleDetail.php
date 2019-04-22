<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [
        'cantidad',
        'inventory_id',
        'sale_id',
    ];
}
