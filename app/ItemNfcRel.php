<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use App\Item;
use App\Worker;

class ItemNfcRel extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'item_nfc_rel';

    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $fillable = [
        'nfc_serial_number',
        'item_id',
        'status',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
