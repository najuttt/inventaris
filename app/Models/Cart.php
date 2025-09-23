<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'guest_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function itemOut()
    {
        return $this->hasMany(Item_out::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
}