<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Milon\Barcode\DNS1D;

class Item extends Model
{
    protected $fillable = [
        'name',
        'code',
        'category_id',
        'stock',
        'price',
        'unit_id',
        'supplier_id',
        'expired_at',
        'created_by',
        'image',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    // === relasi ===
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'item_id');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items', 'item_id', 'cart_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function itemIns()
    {
        return $this->hasMany(Item_in::class, 'item_id');
    }

    public function itemOuts()
    {
        return $this->hasMany(Item_out::class, 'item_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // === accessor/helper ===
    public function getExpiredCountAttribute()
    {
        return $this->itemIns->where('expired_at', '<', now())->sum('quantity');
    }

    public function getNonExpiredCountAttribute()
    {
        return $this->itemIns->where('expired_at', '>=', now())->sum('quantity');
    }

    public function getPriceRupiahAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getBarcodeHtmlAttribute()
    {
        return \Milon\Barcode\Facades\DNS1DFacade::getBarcodeHTML($this->code, 'C128', 2, 60);
    }

    public function getBarcodePngBase64Attribute()
    {
        $dns1d = new DNS1D();
        $png = $dns1d->getBarcodePNG($this->code, 'C128', 2, 60);

        return 'data:image/png;base64,' . $png;
    }

    public function getStatusAttribute()
    {
        if (!$this->expired_at) {
            return 'no expired';
        }
        return $this->expired_at->isFuture() ? 'no expired' : 'expired';
    }

    // === auto generate code ===
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
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        return "{$categoryCode}-{$date}-{$random}";
    }

    public function guestCartItems()
    {
        return $this->hasMany(Guest_carts_item::class, 'item_id');
    }

    public function guestCarts()
    {
        return $this->belongsToMany(Guest_carts::class, 'guest_cart_items', 'item_id', 'guest_cart_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
