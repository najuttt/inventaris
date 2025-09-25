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

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function itemOut()
    {
        return $this->hasMany(Item_out::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'cart_items', 'cart_id', 'item_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}