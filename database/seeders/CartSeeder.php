<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama (admin) atau buat kalau belum ada
        $user = User::first() ?? User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Ambil item pertama atau buat dummy
        $item1 = Item::first() ?? Item::create([
            'name' => 'Barang Dummy A',
            'code' => 'BRG001',
            'category_id' => 1,
            'stock' => 10,
            'id_supplier' => 1,
            'id_unit' => 1,
        ]);

        $item2 = Item::skip(1)->first() ?? Item::create([
            'name' => 'Barang Dummy B',
            'code' => 'BRG002',
            'category_id' => 1,
            'stock' => 5,
            'id_supplier' => 1,
            'id_unit' => 1,
        ]);

        // Buat cart dengan status approved
        $cart = Cart::create([
            'user_id' => $user->id,
            'guest_id' => null,
            'status' => 'approved',
            'picked_up_at' => null, // belum di-scan
        ]);

        // Tambahkan item ke cart
        CartItem::create([
            'cart_id' => $cart->id,
            'item_id' => $item1->id,
            'quantity' => 2,
            'scanned_at' => null,
        ]);

        CartItem::create([
            'cart_id' => $cart->id,
            'item_id' => $item2->id,
            'quantity' => 1,
            'scanned_at' => null,
        ]);
    }
}
