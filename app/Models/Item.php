<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'stock',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function itemIn()
    {
        return $this->hasMany(Item_in::class);
    }

    public function itemOut()
    {
        return $this->hasMany(Item_out::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    
    // Auto generate kode unik sebelum create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
        if (empty($item->code)) {
            $category = \App\Models\Category::find($item->category_id);
            $prefix = $category ? strtoupper(substr($category->name, 0, 3)) : "ITM"; 
            $item->code = self::generateUniqueCode($prefix);
        }
    });
    }

    private static function generateUniqueCode($categoryCode = "ITM")
    {
        $date = now()->format('Ymd'); // contoh: 20250906
        $random = strtoupper(substr(uniqid(), -4)); // 4 karakter unik
        return "{$categoryCode}-{$date}-{$random}";
    }

}