<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GuestCartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guestCarts = DB::table('guest_carts')->pluck('id');
        $items = DB::table('items')->pluck('id');

        if ($guestCarts->isEmpty() || $items->isEmpty()) {
            $this->command->warn("⚠️ Seeder GuestCartItemSeeder: guest_carts atau items masih kosong.");
            return;
        }

        foreach (range(1, 30) as $i) {
            DB::table('guest_cart_items')->insert([
                'guest_cart_id' => $guestCarts->random(),
                'item_id' => $items->random(),
                'quantity' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("✅ Seeder GuestCartItemSeeder berhasil menambahkan 30 data dummy.");
    }
}
