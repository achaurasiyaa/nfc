<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{

    protected $table = 'item_categories';

    protected $fillable = [
        'name',
        'description',
        'image',
        'expected_life_in_days'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
