<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueRecord extends Model
{
    use HasFactory;
    public $table = 'issue_records';

    protected $fillable = [
        'worker_id',
        'issue_date',
        'nfc_tag_id',
        'is_expired',
        'expire_date',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function nfcTag()
    {
        return $this->belongsTo(ItemNfcRel::class, 'nfc_tag_id');
    }
}
