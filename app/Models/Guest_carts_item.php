<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest_carts_item extends Model
{
    use HasFactory;

    protected $fillable = ['guest_cart_id', 'item_id', 'quantity'];

    public function cart()
    {
        return $this->belongsTo(Guest_carts::class, 'guest_cart_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}