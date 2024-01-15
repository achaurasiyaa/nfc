<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supplier_name',
        'quantity',
        'ageing_in_days',
        'created_at',
        'updated_at'
    ];
}
