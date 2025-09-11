<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'description',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function carts()
    {
        return $this->hasMany(Guest_carts::class);
    }

    public function itemOuts()
    {
        return $this->hasMany(Item_out_guest::class);
    }
}