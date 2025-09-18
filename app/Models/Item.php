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
        'unit_id',
        'supplier_id',
        'expired_at',
        'created_by',
    ];

    public function getExpiredCountAttribute()
    {
        return $this->itemIn->where('expired_at', '<', now())->sum('quantity');
    }

    public function getNonExpiredCountAttribute()
    {
        return $this->itemIn->where('expired_at', '>=', now())->sum('quantity');
    }

    protected $casts = [
        'expired_at' => 'datetime',
    ];

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

    public function category()  { return $this->belongsTo(Category::class); }
    public function creator()   { return $this->belongsTo(User::class, 'created_by'); }
    public function cartItems() { return $this->hasMany(CartItem::class); }
    public function itemIn()    { return $this->hasMany(Item_in::class); }
    public function itemOut()   { return $this->hasMany(Item_out::class); }
    public function unit()      { return $this->belongsTo(Unit::class); }
    public function supplier()  { return $this->belongsTo(Supplier::class); }

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
}
