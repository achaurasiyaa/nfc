<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $table = 'items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $fillable = [
        'name',
        'supplier_name',
        'quantity',
        'ageing_in_days',
        'created_at',
        'updated_at',
        'category_id',
    ];
    public function nfcTags()
{
    return $this->hasMany(ItemNfcRel::class);
}

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'category_id');
    }

    public function nfcRel()
    {
        return $this->hasOne(ItemNfcRel::class);
    }

}
