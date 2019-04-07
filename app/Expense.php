<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'descripcion',
        'monto_total',
        'fecha',
        'pharmacy_id',
    ];
}
