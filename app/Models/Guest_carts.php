<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest_carts extends Model
{
    use HasFactory;

    protected $fillable = ['session_id'];

    public function items()
    {
        return $this->hasMany(Guest_carts_item::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}