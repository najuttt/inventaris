<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item_in extends Model
{
    protected $table = 'item_in';

    protected $fillable = [
        'item_id',
        'quantity',
        'supplier',
        'received_by',
        'received_at',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}