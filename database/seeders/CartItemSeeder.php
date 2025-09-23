<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\Item;
use App\Models\CartItem;

class CartItemSeeder extends Seeder
{
    public function run(): void
    {
        $cart = Cart::first() ?? Cart::factory()->create();
        $items = Item::take(3)->get();

        if ($items->isEmpty()) {
            $items = Item::factory()->count(3)->create();
        }

        foreach ($items as $item) {
            CartItem::create([
                'cart_id'  => $cart->id,
                'item_id'  => $item->id,
                'quantity' => rand(1, 10),
            ]);
        }
    }
}
