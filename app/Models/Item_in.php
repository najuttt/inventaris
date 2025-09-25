<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_in extends Model
{
    use HasFactory;

    protected $table = 'item_ins';

    protected $fillable = [
        'item_id',
        'quantity',
        'supplier_id',
        'expired_at',
        'created_by',
    ];

    protected $casts = [
    'expired_at' => 'datetime',
    ];

    public function getStatusAttribute()
    {
        if ($this->expired_at && $this->expired_at->isFuture()) {
            return 'no expired';
        }
        return 'expired';
    }

    public function getTotalValueRupiahAttribute()
    {
        return 'Rp ' . number_format($this->quantity * $this->item->price, 0, ',', '.');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
